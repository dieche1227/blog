<?php

namespace App\Http\Controllers\Home;

use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserPost;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    protected static $userServer = null;

    public function __construct(UserService $userService)
    {
        self::$userServer = $userService;
    }
    /**
     * 用户登录页.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        $path = url()->previous();
        return view('home.account.login',['path'=>$path]);
    }

    /**
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * 用户登录验证
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request,[
        //     'cellphone'=>"required",
        //     'password'=>"required",
        // ]);


        //判断验证码是否正确
        $data = $request->all();
        $tmp =  $request->session()->get('graphcode');
        if($tmp != $data['graphcode']){
            return response(json_encode(['ststus'=>false,
                                         'msg'=>'验证码错误',
                ]));
        }
        $res = self::$userServer->getUserInfo($data['cellphone']);
    
        $tmp =  md5(md5($data['password']).($res->salt));

       
        if($tmp == $res->password){
            Session::set('loginUserInfo',$res);
            return response(json_encode(['ststus'=>false,
                                         'msg'=>'用户名或密码错',
                                         'jumpUrl'=>$data['path'],
                ]));

        }else{
            return response(json_encode(['ststus'=>false,
                                         'msg'=>'用户名或密码错',
                ]));
        }
        
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

}
