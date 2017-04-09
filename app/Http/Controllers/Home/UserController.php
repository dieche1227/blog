<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Tools\Common;
use App\Http\Requests\StoreUserPost;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public static $user;
    public $sms;

    public function __construct(UserService $userService)
	  {
          self::$user = $userService;

	  }
    /**
     * Display login.html
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * 用户注册页
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //或许上一次访问页面
        $path = url()->previous();
        return view('home.account.register',['path'=>$path]);
    }

    /**
     * 创建用户
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPost $request)
    {
        //接受经过验证的数据
        $userdata = $request->all();
        //判断用户是否存在
        $res = self::$user->checkIfExist(['cellphone'=>$userdata['cellphone']]);
        //判断图形验证码是否正确
        if($res){
            return back()->withInput()->with("msg","手机号码已注册！");
        }

        $mycode = $request->input("verify");
        $mycode = strtolower($mycode);
       
        $yanzhengma = $request->session()->get('graphcode');
        $yanzhengma = strtolower($yanzhengma);
       
       
        if($mycode !== $yanzhengma){
            return back()->withInput()->with("msg","验证码错误！".$mycode.":".$yanzhengma);
        }
        //判断手机验证码是否正确

        $mycode = $request->input("msgcode");
        $mycode = strtolower($mycode);

        /*$yanzhengma = $request->session()->get('sms');
*/

        $yanzhengma = Session::get('sms');
       dd($yanzhengma);
        $yanzhengma = strtolower($yanzhengma);


        if($mycode !== $yanzhengma){
            return back()->withInput()->with("msg","手机验证码错误!");
        }

        //处理数据
        
        $path = $userdata['path'];
        $userdata['reg_ip'] = $request->ip();
        //添加用户
        $guid = self::$user->createUser($userdata);

        //登录
        if(empty($guid)){
             return back()->with("msg","注册失败,请稍后再试!");
        }else{
            $loginUserInfo = self::$user->getSingleUserInfo($guid);
            Session::set('loginUserInfo', $loginUserInfo);
            return redirect("$path");
        }   
       
    }

    /**
     * 展示个人中心
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($guid)
    {
        $userInfo = self::$user->getSingleUserInfo($guid);
        return view("home.user.personal",['userInfo'=>$userInfo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * 更改用户信息
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>"required",
            'email'=>"required",
            'cellphone'=>"required",
            'birthday'=>"required"
        ]);
        self::$user->updateUserInfo($request->all(),$id);
        return redirect("/home/user/$id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * 手机验证码
     * @param Request $request
     */
    public function code(Request $request)
    {
        $phone = $request->input("phone");
        $code = Common::code($phone);
        if($code == true) {
            return response(json_encode(['status' => true, 'msg' => '发送成功']));
        }else{
            return response(json_encode(['status' => false, 'msg' => '发送失败']));
        }
    }

    /**
     * 验证手机验证码是否正确
     * @param $code
     * @return bool
     */
    public function testCode($code){
        if($code == session('code')){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 判断用户是否注册
     * @param $phone
     * @return bool
     */
    public function testUser($phone)
    {
        $user = self::$user->getUserInfo($phone);
        if($user) {
            return false;
        }else{
            return true;
        }
    }
}
