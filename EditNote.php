<?php
	// person.php 
	// version 1.0 (Jan, 8th. 2012)
	// created by kylejan for web2.0 project
	
	require_once( "common/common.php" );
	require_once( "database/UsrControl.php" );
	require_once( ROOT."database/DocControl.php" );
	require_once( ROOT."database/GroControl.php" );
	
	$did = $_GET['did'];
	$doc = FindDoc($did);
	$uid = $_SESSION['userid'];
	
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>MySpace</title>
	<link rel="stylesheet" type="text/css" href="css/common.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/group-style.css" media="all" />
	
	<script src="js/jquery-1.7.1.js" type="text/javascript"></script>
	<script src="js/jquery.masonry.min.js" type="text/javascript"></script>
	<script src="js/square.js" type="text/javascript"></script> 
</head>

<body>
	<?php
		require_once( ROOT."common/header.php" );
	?>
	
	<div id="main">
		<div id="left_content">
			<div class="info">
				<?php
					$con_user = mysql_connect(Config::$host, Config::$user, Config::$pass);
					mysql_select_db(Config::$db, $con_user);
					mysql_query('SET NAMES UTF8') or die(Config::$err3);
					
					$sql_to_user = "select * from user where uid=" . $_SESSION['userid'];	
					$result_user = mysql_query( $sql_to_user ) or die( "No comment table!" );
					$record_user = mysql_fetch_array($result_user);
					$uname = $record_user['nick'];
					$pic = $record_user['picture'];
					$signature = $record_user['signature'];
					mysql_close();
				?>
				<h1><?= $uname ?></h1>
				<img src="<?= $pic ?>" alt="MyPic"/>
				<p><?= $signature ?></p>
			</div>

			<div class="Friend_Group">
				<h1>我的好友</h1>
				<div class="clear"></div>
				<?php
					mysql_connect( Config::$host, Config::$user, Config::$pass ) or die( Config::$err1 );
					mysql_select_db( Config::$db ) or die( Config::$err2 );
					mysql_query('SET NAMES UTF8') or die(Config::$err3);
											
					$sql = "select * from friend where (uid1=" . $uid . " OR uid2=" . $uid .")";
					$result = mysql_query($sql) or die( "No friend table!" );
					
					while($record = mysql_fetch_array($result)){
						$uid1 = $record['uid1'];
						$uid2 = $record['uid2'];
						if($uid1 == $uid){
							$friendID = $uid2;
						}
						elseif($uid2 == $uid){
							$friendID = $uid1;
						}
						$friend = FindUser($friendID);
				?>
					<div class="each">
						<img src="<?= $friend->picture ?>" />
						<p><?= $friend->nick ?></p>
					</div>
				<?php
					}
				?>
			</div>
			
			<div class="clear"></div>

			<div class="Friend_Group">
				<h1>我的小组</h1>
				<div class="clear"></div>
				<?php
					$con = mysql_connect(Config::$host, Config::$user, Config::$pass) or die(Config::$err1);
					mysql_select_db(Config::$db, $con) or die(Config::$err2);
					mysql_query('SET NAMES UTF8') or die(Config::$err3);
					
					$sql = "select * from `group` where uid = " . $uid;
					$result = mysql_query($sql) or die("No group table!");
					
					while($record = mysql_fetch_array($result)){
						$group = FindGroup($record['gid']);
				?>
						<div class="each">
							<img src="images/group/<?= $group->pic ?>" />
							<p><?= $group->name ?></p>
						</div>
				<?php
					}
				?>
			</div>
			
		</div>
		
		<div id="right_content">
			<h1>编辑笔记</h1>

			<div class="clear"></div>
			<div class="us_bar"></div>
			
			<div class="footprint">
				<div class="item">
					<div class="left-item">
						<h2><?= $doc->title ?></h2>
						<div class="clear"></div>
						<img src="<?= $doc->picture ?>"   /></a>  
						<p><?= $doc->description ?></p>
					</div>
					<div class="right-item">
						<form action="person.php" method="post" >
							<label><input type="hidden" name="did" value="<?= $doc->id ?>"></label>
							<label><textarea name="content" rows="50"></textarea></label>
							<label><input type="submit" value="保存"/></label>
							<br /><br />
							是否在小组内分享：<label><input type="radio" name="shared" value="1" /> YES</label>
							<label><input type="radio" name="shared" value="0" checked="checked"/> NO</label>
						</form>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	
	<div class="clear"></div>
	<?php
		require_once( ROOT."common/footer.php" );
	?>
</body>
</html>
