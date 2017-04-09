<?php
namespace App\Tools;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Crypt;
use Flc\Alidayu\Client;  
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;

class Common{
    /**
     * 加密算法
     * @param string  $user
     * @param string  $pwd
     * $param integer $position
     * @return string
     */
    public static function cryptString($user, $pwd, $position = 5)
    {
        $subUser   = substr(Crypt::encrypt($user), 0, $position);
        $cryptPwd  = md5($pwd);
        return md5(md5($cryptPwd . $subUser));
    }

    /**
     * 返回uuid
     * @return string
     */
    public static function getUuid()
    {
        $uuid = Uuid::uuid1();
        return $uuid->getHex();
    }

    /**
     * 验证码生成
     *
     */
    public static function captcha($tmp)
    {
        $phrase = new PhraseBuilder;
        // 设置验证码位数
        $code = $phrase->build(4);
        // 生成验证码图片的Builder对象,配置相应属性
        $builder = new CaptchaBuilder($code, $phrase);
        // 设置背景颜色
        $builder->setBackgroundColor(220, 210, 230);
        $builder->setMaxAngle(25);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        // 可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        // 获取验证码的内容
        $phrase = $builder->getPhrase();
        // 把内容存入session
        Session::flash('code', $phrase);
        // 生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();
    }



    /**
     *  获取本月第一天和最后一天
     * @param $date
     * @return array
     */
    public static function getMonth($date)
    {
        $firstday = date("Y-m-01",strtotime($date));
        $lastday = date("Y-m-d",strtotime("$firstday +1 month -1 day"));
        return array($firstday,$lastday);
    }


    /**
     *  获取上个月第一天和最后一天
     * @param $date
     * @return array
     */
    public static function getlastMonthDays($date)
    {
        $timestamp=strtotime($date);
        $firstday=date('Y-m-01',strtotime(date('Y',$timestamp).'-'.(date('m',$timestamp)-1).'-01'));
        $lastday=date('Y-m-d',strtotime("$firstday +1 month -1 day"));
        return array($firstday,$lastday);
    }


    /**
     *  获取下个月第一天和最后一天
     * @param $date
     * @return array
     */
    public static function getNextMonthDays($date)
    {
        $timestamp=strtotime($date);
        $arr=getdate($timestamp);
        if($arr['mon'] == 12){
            $year=$arr['year'] +1;
            $month=$arr['mon'] -11;
            $firstday=$year.'-0'.$month.'-01';
            $lastday=date('Y-m-d',strtotime("$firstday +1 month -1 day"));
        }else{
            $firstday=date('Y-m-01',strtotime(date('Y',$timestamp).'-'.(date('m',$timestamp)+1).'-01'));
            $lastday=date('Y-m-d',strtotime("$firstday +1 month -1 day"));
        }
        return array($firstday,$lastday);
    }

    /**
     * 判断并返回当前页码
     * @param  array $data
     * @param  ingeter
     * @return mixed(false | array)
     * @author 郭鹏超
     */
    public static function getNowPage($nowPage, $count)
    {
        if(empty($count)) return false;
        $totalPage = ceil($count / PAGENUM);
        if($nowPage < 1) $nowPage = 1;
        if($nowPage > $totalPage) $nowPage = $totalPage;
        return ['nowPage' => (int)$nowPage, 'totalPage' => (int)$totalPage];
    }

    /**
     * 获取分页的URL
     * @param  array $pageData
     * @param  array $result
     * @param  string $url
     * @param  array $param
     * @return mixed(array)
     * @author 郭鹏超
     */
    public static function getPageUrl($nowPage, $totalPage, $url, $param = '')
    {
        if(!empty($nowPage) && !empty($totalPage) && !empty($url)) {
            $pages = CustomPage::getSelfPageView($nowPage, $totalPage, url($url), $param);
            if($pages) return $pages;
        }
        return false;
    }

    /**
     * 产生cookie
     * @return string
     * @author 郭鹏超
     */
    public static function generateCookie($key)
    {
        if(empty($key)) return false;
        $value = md5(REGISTER_SIGNATURE . $key);
        return cookie($key, $value, COOKIE_LIFETIME);
    }
    /**
       * 用户注册生成随机串
       * @param  int 生成长度
       * @return string 生成的字条串
       */
    public static function random($length)
    {
        $hash = '';
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
        $max = strlen($chars) - 1;
        PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
          for($i = 0; $i < $length; $i++) {
              $hash .= $chars[mt_rand(0, $max)];
          }
          return $hash;
    }

     /**
       * send telephone code
       * @param  int cellphonenumber
       * @return bool
       */
    public static function sendSms($cellphone)
    {
        $config = [
        'app_key'    => '23665066',
        'app_secret' => 'cb4b7812c3b78b739b99bf91ba901689',
        ];

        $client = new Client(new App($config));
        $req= new  AlibabaAliqinFcSmsNumSend;

        $req->setRecNum('13752330108')
        ->setSmsParam([
        'code' => rand(100000, 999999)
         ])
        ->setSmsFreeSignName('买相同')
        ->setSmsTemplateCode('SMS_55905019');

        $resp = $client->execute($req);

        
    }




}