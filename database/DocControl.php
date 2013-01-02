<?php
	// DocControl.php 
	// version 1.0 (Jan, 1st. 2013)
	// created by chenzhao for web2.0 project
	require_once( ROOT."database/Document.php" );
	require_once( ROOT."database/Config.php" );
	
	// search a document through ID
	// return the document( type: document ) or error message( type: bool )
	function FindDoc( $did )
	{
		mysql_connect( Config::$host, Config::$user, Config::$pass ) or die( Config::$err1 );
		mysql_select_db( Config::$db ) or die( Config::$err2 );
		mysql_query('SET NAMES UTF8') or die(Config::$err3);
		
		// select the document
		$sql = "select * from document where did = " . $did;
		$result = mysql_query( $sql ) or die( "No document table!" );
		mysql_close();
		
		// check existence
		if( mysql_num_rows( $result ) != 1 )
			return false;
		
		// generate a document
		$doc = new Document();
		$doc->id = mysql_result( $result, 0, "did" );
		$doc->title = mysql_result( $result, 0, "title" );
		$doc->author = mysql_result( $result, 0, "author" );
		$doc->pubdate = mysql_result( $result, 0, "pubdate" );
		$doc->description = mysql_result( $result, 0, "description" );
		$doc->tag = mysql_result( $result, 0, "tag" );
		$doc->picture = mysql_result( $result, 0, "picture" );
		$doc->good = mysql_result( $result, 0, "good" );
		$doc->bad = mysql_result( $result, 0, "bad" );
		return $doc;
	}
	
	// add a book to database
	// return the error message( type: boolean )
	// at the mean time, the doc will be changed.
	function AddDoc( $doc )
	{
		mysql_connect( Config::$host, Config::$user, Config::$pass ) or die( Config::$err1 );
		mysql_select_db( Config::$db ) or die( Config::$err2 );
		mysql_query('SET NAMES UTF8') or die(Config::$err3);
		
		// insert into document table
		$para = "('" . $doc->title . "','" . $doc->author . "','";
		$para .= $doc->pubdate . "','" . $doc->description . "','";
		$para .= $doc->tag . "','" . $doc->picture . "','";
		$para .= $doc->good . "','" . $doc->bad . "')";
		$sql = "insert into document( title, author, pubdate, description, tag, picture, good, bad ) value " . $para;
		$result = mysql_query( $sql );
		$doc->id = mysql_insert_id();
		mysql_close();
		
		return $result;
	}
?>