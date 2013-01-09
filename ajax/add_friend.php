<?php
	require_once("../common/common.php");
	require_once("../database/Friend.php");
	require_once("../database/FriendControl.php");
	
	
	$uid = $_POST['userid'];
	
	$res = FindUser($uid);
	if(!is_object($res) && !$res){
		echo 0;
	}
	else{
		AddFriend($_SESSION['userid'], $uid);
		echo 1;
	}
	
?>