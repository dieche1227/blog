<?php
 
include_once "sql.php";//
//文件操作类
//老动态表 转成新动态表，新站上线前使用
set_time_limit(0);
date_default_timezone_set('PRC');
error_reporting(E_ALL ^ E_NOTICE);
if(substr(PHP_SAPI_NAME(),0,3)!=='cli') die('error');
//$begintime= time();
//$begindate= date("Y-m-d h:i:s");

// function addlog($logstr){
//   $tab = new CtbClass();//文件操作类
//   $filename='/data/jiaoben/manyi/log/oldtonew.txt';
//   $tab->file = $filename;
//   if(!file_exists($filename)){
//       $tab->null_write($logstr);
//     }else{
//       $tab->add_write($logstr);
//     }

// }




      $db = new manyi();
      
      // $where['ntype'] = 1;  //留言
      // $i = 0;
      // $sum = 0;
      // // do{
      //   // $limit = $i.',200';
      //   // $res = $db->select('new_web_user_notification_copy',$where,'*',$limit);
      //   foreach ($res as $key => $value) {
      //     $value['ntype'] = 3;//
      //     $count = $db->add('new_web_user_notification',$value);
      //     if($count==0){
      //          $logstr = join(',',$value)."\n";
      //          addlog($logstr);
      //     }
      //     $sum = $sum + $count; 
      //     echo $sum;
      //     echo "\n";
      //   }
      //   $i+=200;
      //  // } while($res);
      //  $logstr = '共增加  留言动态'.$sum.'条!'."\n";
      


       $file_path = "../1.txt";
        if (file_exists($file_path)) 
        {
            $str = file_get_contents($file_path);//将整个文件内容读入到一个字符串中
            $str = str_replace("\r\n","<br />",$str);
            //echo $str;
        }
        $tmpArray = explode('----------------',$str);
        foreach ($tmpArray as $key => $value) {
            preg_match_all("|[\x{4e00}-\x{9fa5}]+[0-9]{4}|u",
            $value,
            $out, PREG_PATTERN_ORDER);
           $res[] = $out;
        }
        //dd($res);

        foreach ($res as $key => $value) {
            foreach ($value as $k => $v) {
                foreach ($v as $k1 => $v1) {
                    //\DB::table('data_category')->insert(array('name' => $v1));
                    $db->add('data_category',array('name' => $v1));
                }  
            }
        }


