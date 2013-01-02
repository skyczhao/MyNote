<?php
	// ComControl.php
	// version 1.0 (Jan, 1st. 2013)
	// created by Jacob for web2.0 project
	require_once( "Comment.php" );
	require_once( "Config.php" );
	
	// post a comment
	// return the error message( type: boolean )
	// meanwhile, the comment->cid will be changed.
	function AddComment($comment){
		$con = mysql_connect(Config::$host, Config::$user, Config::$pass) or die(Config::$err1);
		mysql_select_db(Config::$db, $con) or die(Config::$err2);
		mysql_query('SET NAMES UTF8') or die(Config::$err3);
	
		//insert into database		
		$values = "('" . $comment->did . "','" . $comment->uid . "','" . $comment->content . "','" . $comment->comtime . "')";
		$sql_insert = "insert into comment(did, uid, content, comtime) value " . $values;
		$result = mysql_query($sql_insert, $con);
		//get id of the last insertion operation 
		$comment->cid = mysql_insert_id();
		mysql_close();
		
		return $result;
 	}
	
	//search a comment through ID
	//return the comment(comment) or error message(bool)
	function FindComment($id){
		$con = mysql_connect(Config::$host, Config::$user, Config::$pass) or die( Config::$err1 );
		mysql_select_db(Config::$db, $con) or die(Config::$err2);
		mysql_query('SET NAMES UTF8') or die(Config::$err3);
		
		//select the comment
		$sql = "select * from comment where cid = " . $id;
		$result = mysql_query($sql) or die ("No such comment!");
		mysql_close();
		
		//check existence
		if(mysql_num_rows($result) != 1){
			return false;
		}
		
		//generate a comment instance
		$com = new Comment();
		$com->content = mysql_result($result, 0, "content");
		$com->comtime = mysql_result($result, 0, "comtime");
		$com->uid = mysql_result($result, 0, "uid");
		$com->did = mysql_result($result, 0, "did");
		$com->cid = mysql_result($result, 0, "cid");
			
		return $com;
	}
?>