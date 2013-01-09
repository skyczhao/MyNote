<?php
	require_once("../common/common.php");
	require_once("../database/User.php");
	require_once("../database/UsrControl.php");	
	require_once("../database/Group.php");
	require_once("../database/GroControl.php");	

	//$uid = $_POST['userid'];

	if(isset($_POST['userid'])){
		$uid = $_POST['userid'];
	
		$res = FindUser($uid);
		if(!is_object($res) && !$res){
			echo 0;
		}
		else{
			DeleteUser($uid);
			echo 1;
		}
	}
	
	if(isset($_POST['groupid'])){
		$gid = $_POST['groupid'];
		
		$res1 = FindGroup($gid);
		if(!is_object($res1) && !$res1){
			echo 0;
		}
		else{
			DeleteGroup($gid);
			echo 1;
		}
	}
	
	if(isset($_POST['msg'])){
		$get = $_POST['msg'];
		
		$param = explode("&",$get);
		$gid = $param[0];
		$uid = $param[1];
		
		$group = FindGroup($gid);
		if(!is_object($group) && !$group){
			echo 0;
		}
		else{
			$group->DeleteMember($uid); 
			echo 1;
		}
	}	
	
?>