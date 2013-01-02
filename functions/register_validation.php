<?php
	function checkCode($str1, $str2){
		$error = "验证码错误！";
		if(strcasecmp($str1, $str2) != 0){
			checkAndBack($error);
		}
	}
	
	function checkUname($str){
		$reg = "/\W/";
		$error1 = "用户名必须大于4位且小于10位！";
		$error2 = "用户名只能含有字母或者数字！";
		if(preg_match($reg, $str) == 1){
			checkAndBack($error2);
		}
		if(strlen($str) < 4 || strlen($str) > 10){
			checkAndBack($error1);
		}
		
		return $str;
	}

	function checkPassword($psw, $pswVerify){
		$reg = "/^[\w\d]*$/";
		$error1 = "密码必须大于8位且小于15位！";
		$error2 = "密码只能含有字母或者数字！";
		$error3 = "两次输入密码不相同！";
		if(preg_match($reg, $psw) == 0){
			checkAndBack($error2);
		}
		if(strlen($psw) < 8 || strlen($psw) > 15){
			checkAndBack($error1);
		}
		if($psw != $pswVerify){
			checkAndBack($error3);
		}
		return $psw;
	}
	
	function checkNkname($nkname){
		$reg = "/^[\x{4e00}-\x{9fa5}\w\d]+$/u";
		$error1 = "昵称不能为空！";
		$error2 = "昵称只能包含字母、数字、汉字！";
		if(strlen($nkname) == 0){
			checkAndBack($error1);
		}
		if(preg_match($reg, $nkname) != 1){
			checkAndBack($error2);
		}
		
		return $nkname;
	}
	
	function checkPic($facepath){
		return $facepath;
		
	}
	
	function checkEmail($email){
		$reg = "/[\w\d]+@[\w\d]+\.com|com\.cn/";
		$error = "不合法的email地址！";
		if(preg_match($reg, $email) == 0 && strlen($email) != 0){
			checkAndBack($error);
		}
		
		return $email;
	}
	
	function checkSex($sex){
		return $sex;
	}
	
	function checkAndBack($str){
		echo "<script type='text/javascript'>alert('$str'); history.back();</script>";
		exit();
	}
?>