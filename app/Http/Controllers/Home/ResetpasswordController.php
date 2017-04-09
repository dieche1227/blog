<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Tools\Common;
use Illuminate\Support\Facades\Session;

class ResetpasswordController extends Controller
{
    public static $user;
    public $sms;

    public function __construct(UserService $userService)
	  {
          self::$user = $userService;

	  }
    /**
     * Display reset1.html
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("home.account.reset1");
    }
    /**
     * 显示重置密码第二部页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $cellphone = $request->session()->get('cellphone');
        return view("home.account.reset2",['cellphone'=>$cellphone]);
    }

    /**
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mycode = $request->input("graphcode");
        $mycode = strtolower($mycode);
        $yanzhengma = $request->session()->get('graphcode');
        $yanzhengma = strtolower($yanzhengma);
        if($mycode !== $yanzhengma){
            return response(json_encode(['status'=>false,
                                         'msg'=>'验证码错误！',
                                        ]));
        }

        $cellphone = $request->input("cellphone");
        //判断用户是否存在
        $res = self::$user->checkIfExist($cellphone);
        //返回结果 跳转reset2页面
        if($res){
            Session::set('cellphone',$cellphone);
            return response(json_encode(['status'=>true,
                                         'jumpUrl'=>"/resetpassword/create",
                                        ]));
        }else{
            return response(json_encode(['status'=>false,
                                         'msg'=>'该账户不存在',
                                        ]));
        }
    }

    /**
     * 展示新密码第三部
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        return view("home.account.reset3");
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
     * 修改用户密码
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cellphone = $request->session()->get('cellphone');
        $password = $request->input('password');
        $repassword = $request->input('repassword');
        if($password != $repassword){
            return response(json_encode(['status'=>false,
                                         'msg'=>'密码和确认密码不一致',
                                        ]));
        }else{
            $res = self::$user->changePassword($cellphone, $password);
            if($res){
                return response(json_encode(['status'=>true,
                                              'msg'=>'修改密码成功',
                                              'jumpUrl'=>'/login',
                                        ]));
            }else{
                return response(json_encode(['status'=>flase,
                                              'msg'=>'修改密码失败，请稍后再试',
                                            ]));

            }
        }
    }

    /**
     * 修改密码第三部表单提交
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
       
        $mycode = $request->input("msgcode");
        $mycode = strtolower($mycode);
        $yanzhengma = $request->session()->get('msgcode');
        $yanzhengma = strtolower($yanzhengma);
        if($mycode !== $yanzhengma){
            return response(json_encode(['status'=>false,
                                         'msg'=>'手机验证码错误！',
                                        ]));
        }else{
            return response(json_encode(['status'=>true,
                                         'msg'=>'',
                                         'jumpUrl'=>"/resetpassword/1",
                                        ])); 
        }
    }






}
