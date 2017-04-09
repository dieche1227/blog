<?php
/**
 * Created by dmy
 */
namespace App\Services;

use Qiniu\Auth;  
use Qiniu\Storage\UploadManager;

class QiniuService
{

    public static function returnToken()
    {

         // 需要填写你的 Access Key 和 Secret Key
        $accessKey = env('QINIU_ACCESSKEY');
        $secretKey = env('QINIU_SECRETKEY');
        
        // 构建鉴权对象
        $auth = new Auth($accessKey, $secretKey);
       
        // 要上传的空间
        $bucket = env('QINIU_BUCKET');
       
        // 生成上传 Token
        $token = $auth->uploadToken($bucket);
        
        return $token;

    }
   



}