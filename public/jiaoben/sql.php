<?php
//require_once("../../www/uiconfig.php");

include_once "file.php";//文件操作类

class manyi
{
    protected $db;#pdo 对象
   	protected $database;#数据库名
    public function __construct()
    {
      global $config;//外面的配置文件
      // $this->database = $config['DB_NAME'];
      // $host = "mysql:host=".$config['DB_HOST'].";dbname=".$config['DB_NAME'];
      // $uname= $config['DB_USER'];
      // $pass = $config['DB_PWD'];
      $config['DB_HOST'] = 'mysql';
      $config['DB_USER']= 'root';
      $config['DB_PWD'] = 'root';
      $config['DB_NAME'] = 'test';
      $host = "mysql:host=".$config['DB_HOST'].";dbname=".$config['DB_NAME'];
      $uname= $config['DB_USER'];
      $pass = $config['DB_PWD'];
      $this->database = $config['DB_NAME'];
  	  if($this->db == null){    
  	    try {
  			 $this->db = new PDO($host,$uname,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')); 
  			}catch(Exception $e) {
  			echo $e->getMessage();
  			}
  	  }
    }

    #获取表内单条对象信息
    #针对作品表和评论表
    public function find($tablename,$arr){
        $pdo = $this->db;
        $key = key($arr);
        $value = current($arr);
        $sql = "select * from ".$tablename." where `".$key."`='".$value."'";
        $ures = $pdo->query($sql);
        $ures->setFetchMode(PDO::FETCH_ASSOC);
        $project = $ures->fetch();
        if($project){
          return $project;
        }else{
            $logstr = $sql."\n";
            $this->addlog($logstr);
            return $project;
          }
    }

    public function select($tablename,$where='',$field="*",$limit='',$group=''){
       //$where['createtime']=array('between',$starttime,$endtime))
      $tiaojian=array('lt'=>'<','gt'=>'>');
      if($where){
        $wherestr = 'where ';
        foreach ($where as $key => $value) {
            #如果$VALUE 为值 而非数组
            if(is_array($value)){#
            	if(current($value)=='between'){
            		$wherestr .=  '('."`{$key}`".' BETWEEN '.$value[1].' AND '.$value[2].') and ';
            	}else{
                	$wherestr .= ("`{$key}`".$tiaojian[$value[0]].$value[1].' and ');
                }
            }else{
              $wherestr .= ("`{$key}`"."='".$value."' and ");
            }
        }
        $wherestr = rtrim($wherestr,' and ');
      }
      $sql = "select ".$field." from ".$tablename." ".$wherestr;
      if($group){
        $sql = $sql.' GROUP BY '.$group;
      }
      if($limit){
        $sql = $sql.' limit '.$limit;
      }
      //var_dump($sql);die;
      $pdo = $this->db;

      $stmt = $pdo->query($sql);

      $stmt->setFetchMode(PDO::FETCH_ASSOC);
	    $res = $stmt->fetchAll();
       if($res){
          return $res;
        }else{
            $logstr = $sql."\n";
            $this->addlog($logstr);
            return $res;
          }
    }

    public function add($table,$dataArray){
        $pdo = $this->db;
        $field = "";
        $value = "";
        if( !is_array($dataArray) || count($dataArray)<=0) {
            return false;
        }
        while(list($key,$val)=each($dataArray)) {
            //var_dump($val);
            $val = addslashes($val);
            $field .="`{$key}`,";
            $value .="'{$val}',";
        }
        $field = substr($field,0,-1);
        $value = substr($value,0,-1);
        $sql = "insert into $table($field) values($value)";

        //$sql =  str_replace($pattern, $replacement,$sql);
        $count = $pdo->exec($sql);
        if($count){
          return $count;
        }else{
            $logstr = $sql."\n";
            $this->addlog($logstr);
            return $count;
          }
    } 

    public function save($tablename,$where,$data){
      $pdo = $this->db;
      foreach ($where as $key => $value) {
          $wherestr .= ("`{$key}`".'='.$value.' ');
      }
      $key=key($data);
      $value=current($data);  
      $sql= "update ".$tablename." set `".$key."`='".$value."' where ".$wherestr;
      //var_dump($sql);
      $count = $pdo->exec($sql); 
      if($count){
          return $count;
        }else{
            $logstr = $sql."\n";
            $this->addlog($logstr);
            return $count;
          }
      return $count;
    }
     #取 根据KEY 取VALUE值
    public function getvalue($key,$type){
        $pdo = $this->db;
        $sql = "select * from "."new_keyvalue where k='".$key."' and type=".$type;
        $ures = $pdo->query($sql);
        $ures->setFetchMode(PDO::FETCH_ASSOC);
        $project = $ures->fetch();
        return $project['v'];
    }

    public function addlog($logstr){
      // $tab = new CtbClass();//文件操作类
      // $filename='/data/jiaoben/manyi/log/sql.txt';
      // $tab->file = $filename;
      // if(!file_exists($filename)){
      //     $tab->null_write($logstr);
      //   }else{
      //     $tab->add_write($logstr);
      //   }
    }
}