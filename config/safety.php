<?php
/**
 * Created by PhpStorm.
 * User: wangt
 * Date: 2016/12/14
 * Time: 13:52
 */

return [
    //// 黑名单前缀
    'BLACKLIST' => 'BLACKLIST:',
    //// 防止快速刷新前缀
    'PREVEN_TFAST_REFRESH' => 'PREVENT_FAST_REFRESH:',
    'PREVEN_TFAST_REFRESH_TIME' => 'PREVENT_FAST_REFRESH_TIME:',
    // 设定判断 指定时间段内的，以及指定次数
    'PREVEN_TFAST_REFRESH_HOLD_TIME' => 20,
    'PREVEN_TFAST_REFRESH_HOLD_NUM' => 20,

    // 某IP的请求验证码次数
    'PREVEN_TFAST_REFRESH_SMS_VAL' => 'PREVEN_TFAST_REFRESH_SMS_VAL:',
    'PREVEN_TFAST_REFRESH_SMS_NUM' => 'PREVEN_TFAST_REFRESH_SMS_NUM:',
    // 验证码超时时间
    'SMS_OVERTIME' => 60,
    // 限制三次验证码时间
    'SMS_REQUEST_TIME' => 3600,
    // 限制验证码输出次数  IP
    'SMS_LIMIT_NUM_IP' => 100,
    // 手机
    'SMS_LIMIT_NUM_PHONE' => 10,

    // 评论时间间隔
    'COMMENT_TIME' => 1,
];
