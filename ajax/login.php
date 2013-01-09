<?php
	require_once "../common/common.php";
	require_once "../database/UsrControl.php";
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if(strlen(trim($username)) == 0 || strlen(trim($password)) == 0){
		echo 1;
		die();
	}
	
	if($username == "admin" && $password == "admin"){
		echo 5;
		die();
	}
	
	$result = Login($username, $password);
	if(!is_object($result) && ($result == 1 || $result == 2)){
		echo 2;
		die();
	}
	$_SESSION['userid'] = $result->id;
	
	echo 0;
?>