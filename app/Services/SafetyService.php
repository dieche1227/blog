<?php
/**
 * Created by PhpStorm.
 * User: wangt
 * Date: 2016/12/13
 * Time: 21:48
 */

namespace App\Services;

use App\Redis\BaseRedis;
use Illuminate\Support\Facades\Log;
use Storage;

class SafetyService
{

    /**
     * 把IP写入指定的set中
     * @param $ip
     * @return bool false代表写入失败，黑名单中已存在，true代表成功
     * @author 王通
     */
    public function saveIpInSet($setKey, $ip)
    {

        return BaseRedis::addSet($setKey, $ip);
    }
    /**
     * 检查IP有没有存在于set中
     * @param $ip 要判断的ip
     * @return bool    true 代表已经被加入黑名单，false，没有被加入黑名单
     * @author 王通
     */
    public function checkIpInSet($setKey, $ip)
    {

        $date = $setKey;

        if (BaseRedis::checkSet($date, $ip)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 得到string的值
     * @param $key
     * @return bool|string
     * @author 王通
     */
    public function getString($key)
    {
        if (empty($key)) return false;
        return BaseRedis::getRedis($key);
    }

    /**
     * 得到list记录条数
     * @param $key
     * @return bool|int
     * @author 王通
     */
    public function getLLen ($key)
    {
        if (empty($key)) return false;
        return BaseRedis::getLLen($key);
    }

    /**
     * 指定键自增一
     * @param $key
     * @return bool
     */
    public function getCount($key)
    {
        if (empty($key)) return false;
        $k = BaseRedis::incrRedis($key);
        return $k;

    }
    /**
     * 设置同一个IP访问多少次显示验证码
     * @param $key
     * @return bool
     * @author 王通
     */
    public function getCountIp($key)
    {
        if (empty($key)) return false;
        if (!BaseRedis::existsRedis($key)) {
            BaseRedis::expireRedis($key, LOGIN_ERROR_NUM_TIME);
        }
        $k = BaseRedis::incrRedis($key);
        return $k;

    }
    /**
     * 请求数量，以及通过sessionID验证
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author 王通
     */
    public static function session_number($tmp)
    {
        if (md5(session()->getId()) != substr($tmp, 0, 32)) {
            return true;
        }
        return false;

    }

    /**
     * 通过IP请求数量验证
     * @param $ip
     * @return bool  false代表可以请求，true代表疑似攻击，不能请求
     * @author 王通
     */
    public static function number($ip, $num, $name = '接口名')
    {

        $k = BaseRedis::incrRedis($ip . date('Y-m-d'));

        if ($k > $num) {
            self::addIpBlackList($ip);
            Log::warning('!!!' . $name . '来自于'. $ip .'请求次数达到警戒线，'. $num  . '次！！');
            return true;
        } else {
            return false;
        }
    }



    /**
     * 把IP加入黑名单
     * @param $ip
     * @return bool false代表写入失败，黑名单中已存在，true代表成功
     * @author 王通
     */
    public static function addIpBlackList($ip)
    {
        $date = config('safety.BLACKLIST') . date('Y-m-D',time());
        return BaseRedis::addSet($date, $ip);
    }

    /**
     * 防止快速刷新
     * @param $ip
     * @return bool  false代表可以请求，true代表疑似攻击，不能请求
     * @author 王通
     */
    public static function preventFastRefresh($ip)
    {
        $key = config('safety.PREVEN_TFAST_REFRESH') . $ip;
        // 当前时间
        $time = time();
        // 存储当前时间参数
        $time_key = config('safety.PREVEN_TFAST_REFRESH_TIME') . $key;
        // 持续时间
        $time_n =  config('safety.PREVEN_TFAST_REFRESH_HOLD_TIME');
        $num_n =  config('safety.PREVEN_TFAST_REFRESH_HOLD_NUM');
        // 二十秒之内，访问次数超过二十次的话，让他进入本地回环
        if (!BaseRedis::existsRedis($key)) {

            // 这是累加键，判断访问次数
            BaseRedis::setexRedis($key, 1, $time_n);
            // 设置存储时间键值，顺便设置超时时间。
            BaseRedis::setexRedis($time_key, time(), $time_n);

        } else {
            $num = BaseRedis::incrRedis($key);
            // 判断请求数量有没有超过要求
            if ((BaseRedis::getRedis($time_key) + $num_n) < (BaseRedis::getRedis($time_key) + $num)) {
                Log::warning('!!! 在'.$time_n . '秒内，来自于' . $ip .'请求次数达到超过警戒线，'. $num_n .'，'. $num  . '次！！');
                // 加入黑名单
                self::addIpBlackList($ip);
                header(sprintf('Location:%s', 'http://127.0.0.1'));
                exit('Access Denied');
            }
        }

        return false;
    }

    /**
     * 检查手机验证码请求是否合法
     * @param $ip
     * @param $code
     * @return bool  false代表可以请求，true代表疑似攻击，不能请求
     * @author 王通
     */
    public static function checkIpSMSCode($ip, $code)
    {
        // 某IP的请求验证码
        $SMSVal = config('safety.PREVEN_TFAST_REFRESH_SMS_VAL') . $ip;
      
        // 某IP的请求验证码次数
        $SMSNum = config('safety.PREVEN_TFAST_REFRESH_SMS_NUM') . $ip;
        // 验证码超时时间
        $overtime = config('safety.SMS_OVERTIME');
        // 限制三次验证码时间
        $requestTime = config('safety.SMS_REQUEST_TIME');
        // 限制验证码输出次数
        $smsLimitNum = config('safety.SMS_LIMIT_NUM_IP');

        // 判断固定IP指定时间段内，请求次数有没有达到限制
        // 如果没有开始累计，则把验证码存到Redis里
        if (!BaseRedis::existsRedis($SMSNum)) {
            // 当前验证码
            BaseRedis::setexRedis($SMSVal, $code, $overtime);
            // 这是累加键，判断访问次数
            BaseRedis::setexRedis($SMSNum, 1, $requestTime);
            return false;
        } else {
//            // 判断一分钟之内，有没有请求过验证码
//            if (BaseRedis::existsRedis($SMSVal)) {
//                Log::warning('!!! 在'.$overtime . '秒内，来自于' . $ip .'请求次数超过两次，疑似短信接口被攻击。');
//                return true;
//            }
            // 判断指定时间段，请求次数有没有超过三次
            if (BaseRedis::getRedis($SMSNum) < $smsLimitNum) {
                // 当前验证码
                BaseRedis::setexRedis($SMSVal, $code, $overtime);

                BaseRedis::incrRedis($SMSNum);
                return false;
            } else {
                Log::warning('!!! 在'.$requestTime . '秒内，来自于' . $ip .'短信接口请求次数达到超过警戒线，'. $smsLimitNum .'次！！');
                self::addIpBlackList($ip);
                return true;
            }

        }
    }
    /**
     * 检查手机验证码请求是否合法 每个手机号单位时间段发送短信次数
     * @param $ip
     * @param $code
     * @return bool  false代表可以请求，true代表疑似攻击，不能请求
     * @author 王通
     */
    public static function checkPhoneSMSCode($ip, $code)
    {
        // 某IP的请求验证码
        $SMSVal = config('safety.PREVEN_TFAST_REFRESH_SMS_VAL') . $ip;
        // 某IP的请求验证码次数
        $SMSNum = config('safety.PREVEN_TFAST_REFRESH_SMS_NUM') . $ip;
        // 验证码超时时间
        $overtime = config('safety.SMS_OVERTIME');
        // 限制三次验证码时间
        $requestTime = config('safety.SMS_REQUEST_TIME');
        // 限制验证码输出次数
        $smsLimitNum = config('safety.SMS_LIMIT_NUM_PHONE');

        // 判断固定IP指定时间段内，请求次数有没有达到限制
        // 如果没有开始累计，则把验证码存到Redis里
        if (!BaseRedis::existsRedis($SMSNum)) {
            // 当前验证码
            BaseRedis::setexRedis($SMSVal, $code, $overtime);
            // 这是累加键，判断访问次数
            BaseRedis::setexRedis($SMSNum, 1, $requestTime);
            return false;
        } else {
            // 判断一分钟之内，有没有请求过验证码
            if (BaseRedis::existsRedis($SMSVal)) {
                Log::warning('!!! 在'.$overtime . '秒内，来自于' . $ip .'请求次数超过两次，疑似短信接口被攻击。');
                return true;
            }
            // 判断指定时间段，请求次数有没有超过三次
            if (BaseRedis::getRedis($SMSNum) < $smsLimitNum) {
                // 当前验证码
                BaseRedis::setexRedis($SMSVal, $code, $overtime);

                BaseRedis::incrRedis($SMSNum);
                return false;
            } else {
                Log::warning('!!! 在'.$requestTime . '秒内，来自于' . $ip .'短信接口请求次数达到超过警戒线，'. $smsLimitNum .'次！！');
                self::addIpBlackList($ip);
                return true;
            }

        }
    }

    /**
     * 监视SQL语句执行的数量
     * @param $key          请求接口的名称
     * @param $content      请求的内容
     * @param $number       限制请求的数量
     * @author 王通
     */
    public static function checkSqlNum($key, $content, $number)
    {
        $result = BaseRedis::incrRedis($key);

        if ($result > $number) {
            Storage::append($key . '.log', ': >>>' .$content . '<<<');
            if ($result % 1000 ) {
                Log::warnige($key . '接口请求超过' . $result . '次');
            }
            return true;
        } else {
            return false;
        }
    }

}