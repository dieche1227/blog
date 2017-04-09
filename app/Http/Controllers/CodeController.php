<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Session;
use App\Tools\Common;
use App\Services\SendService;

class CodeController extends Controller
{
 
    // 短信验证码
    public function msgCode(Request $request)
    {
        $phone = $request->tel;
        //验证数据，手机号校验
        $preg = '/^(1(([3578][0-9])|(47)|[8][0126789]))\d{8}$/';
        if(!preg_match($preg,$request->tel)) return response()->json(['StatusCode' => '400','ResultData' => '请输入正确的手机号!']);
        if ($request->verify != session('verify')) {
            return response()->json(['StatusCode' => '400','ResultData' => '请输入正确的验证码!']);
        } else {
            session(['verify' => '']);
        }
        $res = SendService::sendSmsCode($phone);
        return response(json_encode($res));
    }
    // 图形验证码
    public function graphCode()
    {
        $builder = new CaptchaBuilder;
        $builder->build(150,32);
        Session::set('graphcode',$builder->getPhrase()); //存储验证码
        return response($builder->output())->header('Content-type','image/jpeg');    
    }

}
