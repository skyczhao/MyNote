<?php
	
	function checkGroupName($str){
		$error1 = "组名必须大于4位且小于20位！";
		//echo strlen($str);
		if(strlen($str) < 4 || strlen($str) > 20){
			checkAndBack($error1);
		}
		
		return $str;
	}
	
	function checkDescription($str){
		$error = "简介不能为空！";
		if(strlen($str) == 0){
			checkAndBack($error);
		}
		return $str;
	}
	
	function checkPicture(){
		$error1 = "文件不存在！";
		$error2 = "未知错误！请重传！";
		$error3 = "文件类型不符！";
		//echo $_FILES['picture']['type'];
		if($_FILES["picture"]["error"] > 0){
			checkAndBack($error2);
		}
		if($_FILES['picture']['size'] == 0){
			checkAndBack($error1);
		}
		if($_FILES['picture']['type'] != "image/jpeg" &&
			$_FILES['picture']['type'] != "image/gif" &&
			$_FILES['picture']['type'] != "image/jpg"){
			checkAndBack($error3);
		}
		
		move_uploaded_file($_FILES["picture"]["tmp_name"], "images/group/" . $_FILES["picture"]["name"]);
		return $_FILES['picture']['name'];
	}

	function checkAndBack($str){
		echo "<script type='text/javascript'>alert('$str'); history.back();</script>";
		exit();
	}
?>