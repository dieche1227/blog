<?php
 
include_once "sql.php";//
//文件操作类
//小米站老动态表 转成新动态表，新站上线前使用

set_time_limit(0);
date_default_timezone_set('PRC');
error_reporting(E_ALL ^ E_NOTICE);
if(substr(PHP_SAPI_NAME(),0,3)!=='cli') die('error');

      $db = new manyi();
      //以前为主题点赞    
      $where['id'] = ['gt',28313];  
      $i = 0;
      $sum = 0;
      do{
        $limit = $i.',200';
        $res = $db->select('data_category',$where,'*',$limit);
        foreach ($res as $key => $value) {

          $saveWhere['id'] = $value['id'];
          //$newvalue['code'] =  substr($value['name'], -4);
          $newvalue['name'] =  substr($value['name'], 0, strlen($value['name'])-4);
          var_dump($value);
          $count = $db->save('data_category',$saveWhere,$newvalue);
          if($count==0){
               $logstr = join(',',$value)."\n";
               // addlog($logstr);
          }
          $sum = $sum + $count; 
          echo $sum;
          echo "\n";
        }
        $i+=200;
       } while($res);
   

      


     

     
     


      
      









