<?php
header('Content-Type:text/html;charset=utf-8');
//活跃设计师统计脚本
include_once('../../www/uiconfig.php');
$conn = mysql_connect($config['DB_HOST'],$config['DB_USER'],$config['DB_PWD']);
mysql_query("SET NAMES utf8");
mysql_select_db('umb',$conn);
$endtime = time();
$starttime = time()-7*24*3600;
$sql = "select count(id) as num,keywords from new_web_search_log where createtime>".$starttime." and createtime<".$endtime." group by keywords limit 5";
$resutl = mysql_query($sql);
while ($row = mysql_fetch_array($resutl)) {
	$res[] = $row;
}
dump($res);