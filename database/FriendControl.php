<?php
	require_once( "UsrControl.php" );
	function AddFriend($uid1,$uid2){
		$user1 = FindUser($uid1);
		$user2 = FindUser($uid2);
		
		$con = mysql_connect(Config::$host, Config::$user, Config::$pass) or die(Config::$err1);
		mysql_select_db(Config::$db, $con) or die(Config::$err2);
		mysql_query('SET NAMES UTF8') or die(Config::$err3);
		
		$jointime = date('Y-m-j');
		$values = "('" . $user1->uid . "','" . $user2->uid . "','" . $jointime . "')";
		$sql_insert = "insert into `friend`( uid1, uid2, setime ) value" . $values;
		$result = mysql_query($sql_insert, $con);
		mysql_close();
		
		return $result;
	}
	
	function DeleteFriend($uid1,$uid2){
		$con = mysql_connect(Config::$host, Config::$user, Config::$pass) or die(Config::$err1);
		mysql_select_db(Config::$db, $con) or die(Config::$err2);
		mysql_query('SET NAMES UTF8') or die(Config::$err3);
		
		$sql_delete = "delete from `friend` where uid1 = '" . $uid1 . "' and uid2 = '" . $uid2 . "'" ;
		$result = mysql_query($sql_delete, $con);
		mysql_close();
		
		return $result;	
	}
?>