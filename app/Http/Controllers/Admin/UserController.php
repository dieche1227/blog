<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //
    public function index()
    {			
			return "后退会员管理";    
    }
    
    public function login()
    {
			return view("admin.login");    
    }
    
    public function doLogin(Request $request)
    {
	     //执行验证码判断
        $this->validate($request, [
            'email' => 'required|email',
            'pass' => 'required',
        ]);

        $mycode = $request->input("code");
        $yanzhengma = $request->session()->get('mycode');
        if($mycode !== $yanzhengma){
            return back()->with("msg","验证码错误！".$mycode.":".$yanzhengma);
        }
        
        //执行登陆判断
        $email = $request->input("email");
        $password = $request->input("pass");
        //获取对应用户信息
        $user = \DB::table("weixin_user")->where("email",$email)->first();
        if(!empty($user)){
            //判断密码
            if(md5($password)==$user->password){
                //存储session跳转页面
                session()->set("adminuser",$user);
         		 return redirect("admin");
               //echo "测试成功!";
            }
        }
        return back()->with("msg","账号或密码错误！");          
    }
    
    public function code()
    {
		$builder = new CaptchaBuilder;
        $builder->build(150,32);
        Session::set('mycode',$builder->getPhrase()); //存储验证码
        return response($builder->output())->header('Content-type','image/jpeg');    
    }
    
    //执行退出
    public function logout(Request $request)
    {
       $request->session()->forget('adminuser');
       return redirect("admin/login");
    }
}
