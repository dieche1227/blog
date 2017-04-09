<?php

namespace App\Services;

use App\Tools\Common;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Services\SafetyService;

class SendService {
 	
 	/**
     * 发送短信，时间间隔验证
     * @param $phone
     * @return string
     * @author 刘峻廷
     * @modify 王通
     */
    public static function sendSmsCode($phone)
    {
        // 获取当前时间戳
        $nowTime = $_SERVER['REQUEST_TIME'];
        // 判断该号码两分中内是否发过短信
        $sms = Session::get('sms');
        $code = mt_rand(100000, 999999);
        $content = ['phone' => $phone,'code' => $code];
      
        $resIp = SafetyService::checkIpSMSCode(\Request::getClientIp(), $code);
        $resPhoto = SafetyService::checkPhoneSMSCode($phone, $code);
        if ($resIp || $resPhoto) {
            return ['StatusCode' => '400','ResultData' => '获取验证码过于频繁，请稍后再试!!'];
        }

        //校验
        if(!empty($sms['phone']) && $sms['phone'] == $phone){
            // 两分之内，不在发短信
            if(($sms['time'] + 60)> $nowTime ) return ['StatusCode' => '400','ResultData' => '短信已发送，请等待！'];
            // 两分钟之后，可以再次发送
            $resp = Common::sendSms($phone, $content);

            // 发送失败
            if(!$resp) return ['StatusCode' => '400','ResultData' => '短信发送失败，请重新发送！'];
            // 成功，保存信息到session里，为了下一次校验
            $arr = ['phone' => $phone,'time' => $nowTime,'smsCode' => $number];
            Session::put('sms',$arr);
            Log::info(date('Y-m-d', $nowTime) . \Request::getClientIp() . '请求短信' . '手机号' . $phone);
            return ['StatusCode' => '200','ResultData' => '发送成功，请注意查收！'];
        }else{
            $resp =  Common::sendSms($phone, $content);
            // 发送失败
            if(!$resp) return ['StatusCode' => '400','ResultData' => '短信发送失败，请重新发送!！'];
            $arr = ['phone' => $phone,'time' => $nowTime,'smsCode' => $number];
            Session::put('sms',$arr);
            Log::info(date('Y-m-d', $nowTime) . \Request::getClientIp() . '请求短信' . '手机号' . $phone);
            return ['StatusCode' => '200','ResultData' => '发送成功，请注意查收！'];
        }
    }

}