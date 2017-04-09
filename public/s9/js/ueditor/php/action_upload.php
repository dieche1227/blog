<?php
/**
 * 上传附件和上传视频
 * User: Jinqn
 * Date: 14-04-09
 * Time: 上午10:17
 */
include "Uploader.class.php";

/* 上传配置 */
$base64 = "upload";
switch (htmlspecialchars($_GET['action'])) {
    case 'uploadimage':
        require_once('stronger.php');
        define('BUCKET','test'); 
        define('AK','-P-cxT6CrT_4KeBPfsH7AeLoKM_bYzGw3pjhndeY');
        define('SK','qw55WLtoDYPjjCGlORPheQ_Mxwtlv8F_BnJ8m66k');
        break;
    case 'uploadscrawl':
        $config = array(
            "pathFormat" => $CONFIG['scrawlPathFormat'],
            "maxSize" => $CONFIG['scrawlMaxSize'],
            "allowFiles" => $CONFIG['scrawlAllowFiles'],
            "oriName" => "scrawl.png"
        );
        $fieldName = $CONFIG['scrawlFieldName'];
        $base64 = "base64";
        break;
    case 'uploadvideo':
        $config = array(
            "pathFormat" => $CONFIG['videoPathFormat'],
            "maxSize" => $CONFIG['videoMaxSize'],
            "allowFiles" => $CONFIG['videoAllowFiles']
        );
        $fieldName = $CONFIG['videoFieldName'];
        break;
    case 'uploadfile':
    default:
        $config = array(
            "pathFormat" => $CONFIG['filePathFormat'],
            "maxSize" => $CONFIG['fileMaxSize'],
            "allowFiles" => $CONFIG['fileAllowFiles']
        );
        $fieldName = $CONFIG['fileFieldName'];
        break;
}

if(htmlspecialchars($_GET['action'])=='uploadimage'){
        $fieldName = $CONFIG['imageFieldName'];
        $file = $_FILES[$fieldName];

        #得到图片的后缀
        $type = exif_imagetype($file['tmp_name']);
        $ext = image_type_to_extension($type);

       

        $savename = 'data/upload/'.date('Ym').'/'.time().'_'.mt_rand(100,999).$ext; 

        $resposn = qupload($file['tmp_name'],$savename);
        if($resposn['state']){
            return json_encode(array('state'=>'SUCCESS','url'=>'http://7u2mpt.com2.z0.glb.qiniucdn.com/'.$savename,'title'=>'http://7u2mpt.com2.z0.glb.qiniucdn.com/'.$savename,'original'=>'http://7u2mpt.com2.z0.glb.qiniucdn.com/'.$savename));
        }

}else{
    $up = new Uploader($fieldName, $config, $base64);
    /* 返回数据 */
    return json_encode($up->getFileInfo());
}

/* 生成上传实例对象并完成上传 */


/**
 * 得到上传文件所对应的各个参数,数组结构
 * array(
 *     "state" => "",          //上传状态，上传成功时必须返回"SUCCESS"
 *     "url" => "",            //返回的地址
 *     "title" => "",          //新文件名
 *     "original" => "",       //原始文件名
 *     "type" => ""            //文件类型
 *     "size" => "",           //文件大小
 * )
 */

 function qupload($file,$newname){
 
    /************************配置文件******************************/

    $key1 = $newname;
    $file = $file;
 
    //签名认证
    Qiniu_setKeys(AK, SK);

    //实例客户端
    $client = new Qiniu_MacHttpClient(null);

    //-------------上传凭证------
    $putPolicy = new Qiniu_RS_PutPolicy(BUCKET);
    $upToken = $putPolicy->Token(null);

    #上传本地文件
        $putExtra = new Qiniu_PutExtra();
        $putExtra->Crc32 = 1;
        list($ret, $err) = Qiniu_PutFile($upToken, $key1, $file, $putExtra);
        
        //返回上传结果
        if ($err !== null) {
            return (array)$err;
        } else {
            $ret['state'] = 1;
            return $ret;  //array('hash'=>,'key'=>七牛存放地址)
        }


    }


