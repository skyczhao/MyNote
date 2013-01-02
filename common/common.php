
<?php
	define("ROOT", substr(dirname(__FILE__), 0, -6));
	header('Content-Type: text/html; charset=utf-8');
	
	//拒绝PHP低版本
	if (PHP_VERSION < '4.1.0') {
		exit('Version is to Low!');
	}
	
	session_start();
?>