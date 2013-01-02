<?php
	// upload_validation.php 
	// version 1.0 (Dec, 22th. 2012)
	// created by kylejan for web2.0 project
	function checkTitle($title){
		return $title;
	}
	
	function checkAuthor($author){
		return $author;
	}
	
	function checkPubdate($pubdate){
		return $pubdate;
	}
	
	function checkDescription($description){
		$error = "书籍简介至少有5个字，最多只能有200字";
		
		if(strlen($description) < 5 || strlen($description) > 200){
			checkAndBack($error);
		}
		
		return $description;
	}
	
	function checkPic($pic_size){
		$error = "上传图片大小不能超过5M";

		if($pic_size > 5*1024*1024){
			checkAndBack($error);
		}
		
		return 1;
	}

	function checkAndBack($str){
		echo "<script type='text/javascript'>alert('$str'); history.back();</script>";
		exit();
	}
?>