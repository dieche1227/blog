<?php
include_once "sql.php";

class heat extends manyi {

	#计算某个作品的热度
	public function temperature($pid=''){
    
    $project = $this->find('new_web_project',array('id'=>$pid));
    $subcatid = $project['subcatid'];
      #Nf=1.1(当作品为原创作品/经验); 
      #Nf=1.05(当作品为临摹作品/译文); 
      #Nf=1(当作品为佳作分享/转载);
      switch ($subcatid)
          {
          case 7:#原创作品
            $Nf=1.1;
            break;  
          case 30:#原创经验
            $Nf=1.1;
            break;
          case 5:#临摹作品
            $Nf=1.05;
            break;
          case 29:#译文
            $Nf=1.05;
            break;    
          case 6:#佳作分享
            $Nf=1;
            break; 
          case 16:#转载
            $Nf=1;
            break;
          }
      $tmp = array('A1','B1','C1','D1','E1','F1','A','B','C','D','E','F','G');

      foreach ($tmp as $key => $value) {
        $$value=$this->getvalue($value,1);
      }

      // $A1=1;$B1=100;$C1=10000;$D1=10;$E1=100;$F1=100;
      // $A=4.4;$B=4;$C=9;$D=6.4;$E=5;$F=9.33;$G=1.0057;
      $i=1;#默认值
      #如果作品未上首页推荐,则 i 为 0;
      if($project['ishome']!=1){
          $i = 0;
      }
      #单位时间评论量
      $currenttime=time();
      #单位时间评论量
      $commentnums48 = $this->commentnums48($pid);
      #单位时间浏览量
      $views48 = $project['views48'];
      #浏览量
      $views = $project['vienum'];
      #评论量*(D-i)/D’+
      $commentnums = $this->commentnums($pid);
      #点赞数*(E-i)/E’
      $likenums = $project['likenum'];
      #收藏量*(F-i)/F
      $favnums = $project['favnum'];
      #时间跨度
      #所有发布时间早于 2014 年 1 月 1 日的作品,
      #在计算时按 2014 年 1 月 1 日发布计算。
      $createtime = $project['createtime'];

      if($createtime < strtotime('2014-01-01 00:00:00')){
        $createtime = strtotime('2014-01-01 00:00:00');
      }
       $timecross=floor((time()-$createtime)/(24*60*60));
        #在热度值上前两天以上发布的作品,
        #在计算焦点时间段浏览量和焦点 事件段评论量时,
        #取当前浏览量和评论量的 0.1 倍,计算结果四舍五入取整 数。
       if(($currenttime-$createtime) > (60*60*48)){
          #单位时间评论量
          $commentnums48 = round($project['commentnum']/10);
          #单位时间浏览量
          $views48 = round($project['vienum']/10);
       }

       #作品热度值=Nf*(单位时间评论量*(A-i)/A’+
                  #单位时间浏览量*(B-i)/B’+
                  #浏 览量*(C-i)/C’+
                  #评论量*(D-i)/D’+
                  #点赞数*(E-i)/E’+
                  #收藏量*(F-i)/F’-(G^时间跨度 -G7));
      
      // var_dump($A1);var_dump($B1);var_dump($C1);var_dump($D1);var_dump($E1);var_dump($F1);
      // var_dump($A);var_dump($B);var_dump($C);var_dump($D);var_dump($E);var_dump($F);var_dump($G);
      // var_dump($commentnums48);var_dump($views48);var_dump($commentnums);var_dump($likenums);
      // var_dump($favnums);var_dump($timecross);die;
       
       $redu = $Nf*($commentnums48*($A-$i)/($A1)) +
                  $views48*($B-$i)/($B1) +
                  $views*($C-$i)/($C1) +
                  $commentnums*($D-$i)/($D1) +
                  $likenums*($E-$i)/($E1) +
                  $favnums*($F-$i)/($F1) - (pow($G,$timecross) - pow($G,7));
       
       if($redu<0){
          $redu = 0; 
       } 
       
       $redu = (float)$redu;
       $redu = number_format($redu, 1); 
       if($redu > 999.9){
          $redu = 999.9; 
       } 
       return $redu;
    }

    #48小时内的真实评论量
    #计算时,相同 id 的评论只取 3 个计入评论量 >3 取3
    public function commentnums48($pid){
      $projectinfo = $this->find('new_web_project',array('id'=>$pid));
      $createtime = $projectinfo['createtime'];
      $dateline = $createtime+48*60*60;
      $where = array('p_is_deleted'=>2,'is_examine'=>2,'projectid'=>$pid);
      
      $where['dateline'] =array('lt',$dateline);

      $res = $this->select('new_web_project_comment',$where,'commentid,count(commentid)','','commentid');
      
      $i = 0;
      foreach ($res as $key => $value) {
        if($value['count(commentid)']>3){
          $i += 3;
        }else{
          $i += $value['count(commentid)'];
        }
      }
      return $i;
    }


     #评论量
    #计算时,相同 id 的评论只取 3 个计入评论量 >3 取3
    public function commentnums($pid){   
      $where=array('p_is_deleted'=>2,'is_examine'=>2,'projectid'=>$pid);
      $res = $this->select('new_web_project_comment',$where,'commentid,count(commentid)','','commentid');
      $i = 0;
      foreach ($res as $key => $value) {
        if($value['count(commentid)']>3){
          $i += 3;
        }else{
          $i += $value['count(commentid)'];
        }
      }
      return $i;
    }

    #每天更新作品热度数据
    #定时执行#作品发布 48 小时以 后,每天刷新一次热度数据;
    public function update1day(){
      
       $currenttime = time();
       $starttime = $currenttime-48*60*60;
       $where=array('p_is_deleted'=>2,'createtime'=>array('lt',$starttime),'is_examine'=>2);
       $i= 0;
       $sum = 0;
      do{
        $limit = $i.',200';
        $ures = $this->select('new_web_project',$where,'*',$limit);
        foreach ($ures as $key => $value) {
          
         #寻热度
        $data['temperature'] = $this->temperature($value['id']);
	      #更新 
	      $count = $this->save('new_web_project',array('id'=>$value['id']),$data);
        echo $count;
        $sum = $sum + $count;
          
        }
        $i+=200;
      } while($ures);

      return '已更新new_web_project'.$sum.'条数据';
    }

     #定时执行#品发布 24 小时至 48 小时内,每小时刷新一次热度数据;
    public function update1hour(){
       $currenttime = time();
       $endtime = $currenttime-24*60*60;
       $starttime = $currenttime-48*60*60;
       $where = array('is_examine'=>2,'p_is_deleted'=>2,'createtime'=>array('between',$starttime,$endtime));
       $i = 0;
       $sum = 0;
      do{
      	$limit = $i.',200';
        $ures = $this->select('new_web_project',$where,'*',$limit);
        foreach ($ures as $key => $value) {
          #寻热度
          $data['temperature'] = $this->temperature($value['id']);
	        #更新 
	        $count = $this->save('new_web_project',array('id'=>$value['id']),$data);
          echo $count;
          $sum = $sum + $count; 
        }
        $i+=200;
      } while($ures);

      return '已更新new_web_project'.$sum.'条数据';
    }

    #定时执行// 作品上线在24小时以内,每十分钟更新作品热度
    public function update10(){
       $currenttime = time();
       $endtime = $currenttime-24*60*60;
       $where=array('is_examine'=>2,'p_is_deleted'=>2,'createtime'=>array('gt',$endtime));
       $i= 0;
       $sum = 0;
       do{
       	$limit = $i.',200';
        $ures = $this->select('new_web_project',$where,'*',$limit);
        foreach ($ures as $key => $value) {
          #寻热度
          $data['temperature'] = $this->temperature($value['id']);
	        #更新 
	        $count = $this->save('new_web_project',array('id'=>$value['id']),$data);
          echo $count;
          $sum = $sum + $count;
         
        }
        $i+=200;
      } while($ures);
       return '已更新new_web_project'.$sum.'条数据';
    }  
}

class excelcomment extends manyi { 

  //计算评论分数
  public function calculate($commentid){
    #评论的得分=(赞同数-反对数)*A+(2*赞同数/(赞同数+反对数))*B+(支持
    #者总积分-反对者总积分)/评论者的用户积分比*C
    #+(评论的字数 ^0.5)*D+(LOG10(评论者的积分^0.5))*E
    #赞同数
    $tmp = array('A','B','C');
    foreach ($tmp as $key => $value) {
      $$value=$this->getvalue($value,2);
    }
    //支持者总积分
    #赞同数
    $commentinfo = $this->find('new_web_project_comment',array('commentid'=>$commentid));
   
    $likenums = $commentinfo['like_num'];
    #反对数    
    $opposenums = $commentinfo['oppo_num'];
    #支持者总积分
    
    //$zhichizhe = $this->select('new_web_project_comment_like',array('commentid'=>$commentid,'is_like'=>1),'userid');
    
    //$zhichiscore = 0;

    // foreach ($zhichizhe as $key => $value) {
    //   $userinfo = $this->find('new_web_user',array('id'=>$value['userid']));
    //   $score =  $userinfo['score'];
    //   $zhichiscore += $score;                   
    // }
    #反对者总积分
    // $fanduizhe  = $this->select('new_web_project_comment_like',array('commentid'=>$commentid,'is_like'=>'-1'),'userid');
    // $fanduiscore = 0;
    // foreach ($fanduizhe as $key => $value) {
    //   $userinfo = $this->find('new_web_user',array('id'=>$value['userid']));
    //   $score =  $userinfo['score'];
    //   $fanduiscore += $score;                   
    // }

    #评论者的用户积分比
    #第一期去掉
    // if($fanduiscore!=0){
    //     $ratio = $zhichiscore/$fanduiscore;
    // }else{
    //     $ratio = 
    // }
    #评论的字数 
   
    $s = $commentinfo['content'];
    
    $s = iconv('gbk', 'utf-8', $s);
    $zishu = iconv_strlen($s, 'utf-8');  

    #评论者的积分
    // $pinglunid = $commentinfo['id'];                                  
    // $userinfo =  $this->find('new_web_user',array('id'=>$pinglunid));
    // $pinglunscore =  $userinfo['score'];                     
    #评论者的等级
   	$canshuarr=array('likenums'=>$likenums,
	   				 'opposenums'=>$opposenums,
	   				 'A'=>$A,
	   				 'B'=>$B,
	   				 'C'=>$C,
	   				 'D'=>$D,
	   				 'E'=>$E,
	   				 'zhichiscore'=>$zhichiscore,
	   				 'fanduiscore'=>$fanduiscore,
	   				 'ratio'=>$ratio,
	   				 'zishu'=>$zishu,
	   				 'pinglunscore'=>$pinglunscore
   				    ); 
   	foreach ($canshuarr as $key => $value) {
   		$$key = (float)$value; 
   	}

   	// var_dump($likenums);var_dump($opposenums);
    
    // var_dump($A);var_dump($B);var_dump($C);var_dump($D);var_dump($E);
    
    // var_dump($zhichiscore);var_dump($fanduiscore);
    
    // var_dump($ratio);
    
    // var_dump($zishu);
    
    // var_dump($pinglunscore);die;

    #赞同数/(赞同数+反对数+1)*A+评论者的等级*B+(评论的字数^0.5)*C
    $purposescore = $likenums/($likenums + $opposenums + 1)*$A +               
    				        
                    #$COMMENTDEGREE*$B +

                    (pow($zishu,0.5)*$C);
    #四舍五入取两位小数              
    $purposescore = round($purposescore, 2);
    return $purposescore;
  }


  #更新评论表里面评论分数,
  public function update()
  {
    $where = array('is_examine'=>2,'p_is_deleted'=>2);
    $sum=0;
    $i = 0;
	    do{
	        $limit = $i.',200';
	        $res = $this->select('new_web_project_comment',$where,'*',$limit);
	        foreach ($res as $key => $value) {
	         $data['score'] = $this->calculate($value['commentid']);
	         $count = $this->save('new_web_project_comment',array('commentid'=>$value['commentid']),$data);
           echo $count;
           $sum = $sum + $count;
	        } 
	        $i += 200;                          
	    }while($res);
    return  '已更新评论表'.$sum.'条数据';
  }

}

