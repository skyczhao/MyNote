<?php
	require_once("../common/common.php");
	require_once("../database/Group.php");
	require_once("../database/GroControl.php");
	
	
	$gid = $_POST['gid'];
	
	$res = FindGroup($gid);
	if(!is_object($res) && !$res){
		echo 0;
	}
	else{
		//AddFriend($_SESSION['userid'], $gid);
		$res->AddMember($_SESSION['userid']);
		
		echo 1;
	}
	
?>