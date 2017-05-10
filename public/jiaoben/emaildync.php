<?php
 
include_once "sql.php";


//会员注册，未完成邮箱验证 增加 动态，新站上线前使用
set_time_limit(0);
date_default_timezone_set('PRC');
error_reporting(E_ALL ^ E_NOTICE);
if(substr(PHP_SAPI_NAME(),0,3)!=='cli') die('error');
$begintime= time();
$begindate= date("Y-m-d h:i:s");
  
            
		 $db = new manyi();
	   $where = array('emailactive'=>0);
	   $i = 0;
     $sum = 0;
     $currenttime = time();

      do{
      	$limit = $i.',200';
        $ures = $db->select('new_web_user',$where,'*',$limit);
        foreach ($ures as $key => $value) {
        	$adddata = array('touserid'=>$value['id'],'objectid'=>$value['id'],'senduserid'=>1,'ntype'=>14,'dateline'=>$currenttime);
          $count = $db->add('new_web_user_notification',$adddata);
          echo $count;
          $sum = $sum + $count; 
        }
        $i+=200;
        
      } while($ures);

            $logstr = '共增加 email 验证动态'.$sum.'条!';
            $tab = new CtbClass();
            $filename='/data/jiaoben/manyi/log/'.date('y-m').'.txt';
            if(!file_exists($filename)){
              $tab->file = $filename;
              $tab->null_write($logstr);
            }else{
              $tab->file = $filename;
              $tab->add_write($logstr);
            }






