<?php
//这是一个工具类，作用是完成对数据库的操作
class sqlHelper{
	
	public $conn;
	public $dbname="employee";
	public $username="root";
	public $password="snail";
	public $host="localhost";
	
	
	public function __construct(){
		$this->conn=mysql_connect($this->host,$this->username,$this->password);
		if (!$this->conn){
			die("连接失败".mysql_error());
			
		}
		mysql_select_db($this->dbname,$this->conn);
		
	}
	//执行dql语句
	public function execute_dql($sql){
		$res=mysql_query($sql,$this->conn) or die(mysql_error());
		return $res;
	
	}
	
	//更优秀的dql语句资源处理方案返回的是一个数组
public function execute_dql2($sql){
		$arr=array();
		$res=mysql_query($sql,$this->conn) or die(mysql_error());
		$i=0;
		//把$res=》$arr把结果集的内容转移到一个数组中
		while ($row=mysql_fetch_assoc($res)){
			$arr[$i++]=$row;
		}
		//这里就可以马上关闭资源
	  mysql_free_result($res);
	  return $arr;
	
	}
	//执行dml语句
	public function execute_dml($sql){
		$b=mysql_query($sql,$this->conn);
		if (!$b){
			return 0;
		}else {
			if (mysql_affected_rows($this->conn)>0){
				return 1;//表示执行ok
			}else{
				return 2;//表示没有行受到影响
			}
		}
	}
	//关闭连接的方法
	public function close_connect(){
		if(!empty($this->conn)){
			mysql_close();
		
		}
	}
	
}


?>