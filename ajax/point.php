<?php
	// point.php
	// version 1.0 (Dec, 22th. 2012)
	// created by chenzhao for web2.0 project
	
	require_once "../common/common.php";
	require_once ROOT."database/Config.php";
	if( $_POST["op"] == "good" )
	{
		mysql_connect( Config::$host, Config::$user, Config::$pass ) or die( Config::$err1 );
		mysql_select_db( Config::$db ) or die( Config::$err2 );
		mysql_query('SET NAMES UTF8') or die(Config::$err3);
		
		$sql = "update document set good = '" . $_POST["point"] . "' where did = '" . $_POST["did"] . "'";
		$result = mysql_query( $sql ) or die( mysql_error() );
		mysql_close();
	}
	
	if( $_POST["op"] == "bad" )
	{
		mysql_connect( Config::$host, Config::$user, Config::$pass ) or die( Config::$err1 );
		mysql_select_db( Config::$db ) or die( Config::$err2 );
		mysql_query('SET NAMES UTF8') or die(Config::$err3);
		
		$sql = "update document set bad = '" . $_POST["point"] . "' where did = '" . $_POST["did"] . "'";
		$result = mysql_query( $sql ) or die( mysql_error() );
		mysql_close();
	}
?>