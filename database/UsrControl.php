<?php
	// UsrControl.php
	// version 1.0 (Jan, 1st. 2013)
	// created by chenzhao for web2.0 project
	require_once( ROOT."database/User.php" );
	require_once( ROOT."database/Config.php" );
	
	// to get specific user from database
	// return user( type: user ) or wrong message( type: int )
	function Login( $name, $password )
	{
		mysql_connect( Config::$host, Config::$user, Config::$pass ) or die( Config::$err1 );
		mysql_select_db( Config::$db ) or die( Config::$err2 );
		mysql_query('SET NAMES UTF8') or die(Config::$err3);
		
		// find the user
		$sql = "select * from user where name like '" . $name . "'";
		$result = mysql_query( $sql ) or die( "No user table!" );
		mysql_close();
		
		// check existence
		if( mysql_num_rows( $result ) != 1 )
			return 1;
		// check password
		if( mysql_result( $result, 0, "password" ) != $password )
			return 2;
			
		// generate a user
		$user = new User();
		$user->id = mysql_result( $result, 0, "uid" );
		$user->name = mysql_result( $result, 0, "name" );
		$user->nick = mysql_result( $result, 0, "nick" );
		$user->email = mysql_result( $result, 0, "email" );
		$user->gender = mysql_result( $result, 0, "gender" );
		$user->signature = mysql_result( $result, 0, "signature" );
		$user->picture = mysql_result( $result, 0, "picture" );
		return $user;
	}
	
	// register a user
	// return the error message( type: boolean )
	// at the mean time, the user will be changed.
	function Register( $user, $password )
	{
		mysql_connect( Config::$host, Config::$user, Config::$pass ) or die( Config::$err1 );
		mysql_select_db( Config::$db ) or die( Config::$err2 );
		mysql_query('SET NAMES UTF8') or die(Config::$err3);
		
		// insert into database
		$para = "('" . $user->name . "','" . $password . "','";
		$para .= $user->nick . "','" . $user->email . "','";
		$para .= $user->gender . "','" . $user->signature . "','" . $user->picture . "')";
		$sql = "insert into user( name, password, nick, email, gender, signature, picture ) value " . $para;
		$result = mysql_query( $sql );
		$user->id = mysql_insert_id();
		mysql_close();
		
		return $result;
	}
?>