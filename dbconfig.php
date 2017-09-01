<?php
error_reporting('1');
define("SECURITYSERVER", "http://ec2-18-220-169-20.us-east-2.compute.amazonaws.com/");
class db 
{
	 protected $con;
	function __construct()
	{
		$this->con=new mysqli('localhost','root',"R'7d2HA[cz",'security_db');
	}
	function xss_filter($string)
	{
		return strip_tags($string);
	}
	function ValidateField($string)
	{
		return mysqli_real_escape_string($this->con,trim($string));
	}
	function select($select,$table_name,$where="")
	{
		if($where!="")
			return $this->con->query("select $select from $table_name where $where");
		else
			return $this->con->query("select $select from $table_name");
	}
	function update($update,$table_name,$where="")
	{
		if($where!="")
			return $this->con->query("update $table_name set $update where $where");
		else
			$this->con->query("update $table_name set $update ");
	}
	function delete($table_name,$where="")
	{
		if($where!="")
			return $this->con->query("delete from $table_name where $where");
		else
			$this->con->query("delete from $table_name");
	}
	function insert($table_name,$values)
	{
		$keys=implode(',',array_keys($values));
		$values=implode("','",array_values($values));
		return $this->con->query("insert into $table_name ($keys) values ('$values')");
	}
	function insert_id()
	{
		return $this->con->insert_id;
	}
	function num_rows($select)
	{
		return $select->num_rows;
	}
}

?>