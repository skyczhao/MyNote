<?php
	// Group.php 
	// version 1.0 (Jan, 5th. 2013)
	// created by chenzhao for web2.0 project
	
	// recontructed by kylejan
	// Jan, 5th. 2013
	
	require_once( ROOT."database/Config.php" );
	
	class Group
	{
		var $gid;
		var $uid;
		var $name;
		var $setime;
		var $des;
		var $member;
		var $personNum;
		var $pic;
		
		function AddMember($uid){
			$con = mysql_connect(Config::$host, Config::$user, Config::$pass) or die(Config::$err1);
			mysql_select_db(Config::$db, $con) or die(Config::$err2);
			mysql_query('SET NAMES UTF8') or die(Config::$err3);
			
			$jointime = date('Y-m-j');
			$values = "('" . $this->gid . "','" . $uid . "','" . $jointime . "')";
			$sql_insert = "insert into `crew`( gid, uid, jointime ) value" . $values;
			$result = mysql_query($sql_insert, $con);
			mysql_close();
			
			//$member[$personNum] = $user->uid;
			$this->personNum++;
			
			$con = mysql_connect(Config::$host, Config::$user, Config::$pass) or die(Config::$err1);
			mysql_select_db(Config::$db, $con) or die(Config::$err2);
			mysql_query('SET NAMES UTF8') or die(Config::$err3);
			
			$sql_update = "update `group` set personNum = '" . $this->personNum . "' where gid = '" . $this->gid . "'";
			$result = mysql_query($sql_update, $con);
			return $result;
		}
		
		function DeleteMember($userid){
			$con = mysql_connect(Config::$host, Config::$user, Config::$pass) or die(Config::$err1);
			mysql_select_db(Config::$db, $con) or die(Config::$err2);
			mysql_query('SET NAMES UTF8') or die(Config::$err3);
			
			$sql_delete = "delete from `crew` where gid = '" . $this->gid . "' and uid = '" . $userid . "'" ;
			$result = mysql_query($sql_delete, $con);
			mysql_close();
			
			$this->member[$this->personNum] = NULL;
			$this->personNum--;
			
			$con = mysql_connect(Config::$host, Config::$user, Config::$pass) or die(Config::$err1);
			mysql_select_db(Config::$db, $con) or die(Config::$err2);
			mysql_query('SET NAMES UTF8') or die(Config::$err3);
			
			$sql_update = "update `group` set personNum = '" . $this->personNum . "' where gid = '" . $this->gid . "'";
			$result = mysql_query($sql_update, $con);
			return $result;	
		}
	};
?>