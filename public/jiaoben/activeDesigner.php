<?php
header('Content-Type:text/html;charset=utf-8');
//活跃设计师统计脚本
//include_once('../../www/uiconfig.php');
$config = array(
      'DB_TYPE'    => 'mysql',            //数据库类型
      'DB_HOST'    => '42.62.78.217',        //测试服务器地址217
      'DB_NAME'    => 'udy',             //数据库名
      'DB_USER'    => 'jasper',          //用户名
      'DB_PWD'     => '2mc8n1BBx',         //密码
      'DB_PORT'    => 3306,               //端口
      'DB_CHARSET' => 'utf8',             //数据库编码默认采用utf8
      'DB_PREFIX'  => 'new_',             // 数据库表前缀 
);


include_once "file.php";//文件操作类
$conn = mysql_connect($config['DB_HOST'],$config['DB_USER'],$config['DB_PWD']);
mysql_query("SET NAMES utf8");
mysql_select_db('udy',$conn);
$starttime=time();
$begindate= date("Y-m-d h:i:s");
#活跃设计师
#将原有的数据改成删除状态，重新插入新的数据
mysql_query("UPDATE `new_web_active_user` set is_deleted=2");

#一周内的时间段
$endTime = strtotime(date('Y-m-d ') . ' 00:00:01');
$beginTime = strtotime(date('Y-m-d ') . ' 00:00:01') - 7 * 24 * 3600;

#符合时间段的用户
$rows = mysql_query("select count(*) as projectnum,ownerid,sum(likenum) as liketotal from new_web_project where p_is_deleted=2 and createtime>={$beginTime} and createtime<={$endTime} group by ownerid");

$ownerid = array();
while ($arr = mysql_fetch_array($rows)) {
	#作者的作品被点赞总数
	$arr['liketotal'] = $arr['liketotal'] ? $arr['liketotal'] :0;
	$ownerid[] = $arr;
}

#通过用户ID获取评论数和获取到的积分
foreach($ownerid as $key=>$val){

	#用户这段时间的评论数
	$com = mysql_fetch_array(mysql_query("select count(*) as commentnum from new_web_project_comment where id={$val['ownerid']} and p_is_deleted=2 and dateline>={$beginTime} and dateline<={$endTime}"));
	$ownerid[$key]['commentnum'] = $com['commentnum'];

	#用户这段时间获得的积分
	$score = $val['projectnum']*5+$com['commentnum']*1;
	$ownerid[$key]['score'] = $score;

	#评论上限
	$maxcom = ($com['commentnum']*0.5)>=10 ? 10 : $com['commentnum']*0.5;

	#积分上限
	$maxscore = ($score*0.5)>=10 ? 10 : $score*0.5;
	#活跃度
	$ownerid[$key]['act'] = ($val['projectnum']*10)+$maxcom+$maxscore;

}

#往数据表中添加数据
foreach($ownerid as $key=>$val){
	mysql_query("INSERT INTO new_web_active_user(id,userid,projectnum,likenum,commentnum,score,vitality,is_deleted) VALUES(NULL,{$val['ownerid']},{$val['projectnum']},{$val['liketotal']},{$val['commentnum']},{$val['score']},{$val['act']},1)");

}

$overtime=time();
$exectime =  $overtime-$starttime;
$exectime =  sec2time($exectime);


$logstr = "每周六零点更新 更新活跃度 脚本开始时间：".$begindate.";脚本运行:".$exectime."\n";
	
	$tab = new CtbClass();
	
	$filename='/data/jiaoben/manyi/log/'.date('y-m').'.txt'; 
	//echo $filename;
	if(!file_exists($filename)){
		$tab->file = $filename;
		$tab->null_write($logstr);
	}else{
		$tab->file = $filename;
		$tab->add_write($logstr);
	}

?>