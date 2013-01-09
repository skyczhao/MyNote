<?php
	// person.php 
	// version 1.0 (Dec, 17th. 2012)
	// created by kylejan for web2.0 project
	
	// reconstructed by chenzhao
	// Jan, 1st. 2013
	
	// reconstructed by kylejan
	// Jan, 8th. 2013
	
	require_once( "common/common.php" );
	require_once( "database/UsrControl.php" );
	require_once( ROOT."database/DocControl.php" );
	require_once( ROOT."database/GroControl.php" );
	
	$uid = $_SESSION['userid'];
	
	if(isset($_POST['did'])){
		$modtime = date('Y-m-j');
		$shared = $_POST['shared'];
		$content = $_POST['content'];
		$did = $_POST['did'];
		
		mysql_connect( Config::$host, Config::$user, Config::$pass ) or die( Config::$err1 );
		mysql_select_db( Config::$db ) or die( Config::$err2 );
		mysql_query('SET NAMES UTF8') or die(Config::$err3);
		
		$note = "('" . $uid . "','" . $did . "','";
		$note .= $content . "','" . $modtime . "','";
		$note .= $shared . "')";
		
		$sql = "insert into note( uid, did, content, modtime, shared ) value " . $note;
		$result = mysql_query( $sql );

		mysql_close();
	}

?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>MySpace</title>
	<link rel="stylesheet" type="text/css" href="css/common.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/person-style.css" media="all" />
	
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
				<?php
					$con = mysql_connect(Config::$host, Config::$user, Config::$pass) or die(Config::$err1);
					mysql_select_db(Config::$db, $con) or die(Config::$err2);
					mysql_query('SET NAMES UTF8') or die(Config::$err3);
					
					$sql = "select * from `crew` where uid = " . $uid;
					$result = mysql_query($sql) or die("No crew table!");
					
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
			<h1>我的评论</h1>
			<a href="upload.php"><h5>上传书籍</h5></a>
			<a href="create.php"><h5>创建小组</h5></a>
			<?php
				$con = mysql_connect(Config::$host, Config::$user, Config::$pass) or die(Config::$err1);	
				mysql_select_db(Config::$db, $con) or die(Config::$err2);
					
				$sql_group = "select * from `group` where uid=" . $_SESSION['userid'];
				$result_group = mysql_query($sql_group,$con) or die("No group!");
		
				if( mysql_num_rows($result_group) > 0 ){
			?>
			
			<a href="group_admin.php"><h5>管理我创建的小组</h5></a>
			<?php
			}
			?>
			<div class="clear"></div>
			<div class="us_bar"></div>
			
			<div class="footprint">
				<?php		
					$con_comment = mysql_connect(Config::$host, Config::$user, Config::$pass);
					mysql_select_db(Config::$db, $con_comment);
					mysql_query('SET NAMES UTF8') or die(Config::$err3);
					
					$sql_to_comment = "select * from comment where uid=" . $_SESSION['userid'];	
					$result_comment = mysql_query( $sql_to_comment ) or die( "No comment table!" );
					
					while($record_comment = mysql_fetch_array($result_comment)){
						$did = $record_comment['did'];
						$content = $record_comment['content'];
						
						$sql_to_document = "select * from document where did=" . $did;
						$result_document = mysql_query( $sql_to_document ) or die( "No document table!" );
						$record_document = mysql_fetch_array($result_document);
						
						$title = $record_document['title'];
						$description = $record_document['description'];
						$picture = $record_document['picture'];
					
				?>
						<div class="item"> 
							<h2><?= $title ?></h2>
							<div class="clear"></div>
							<img src="<?= $picture ?>"   /></a>  
							<p><?= $description ?></p>
							<div class="us_bar"></div>
							<h3>Comment</h3>
							<p><?= $content ?></p>
						</div>
						
				<?php
					}
					mysql_close();
				?>
			</div>
			
			<h1>我的笔记</h1>

			<div class="clear"></div>
			<div class="us_bar"></div>
			
			<div class="print">
			<?php
				mysql_connect( Config::$host, Config::$user, Config::$pass ) or die( Config::$err1 );
				mysql_select_db( Config::$db ) or die( Config::$err2 );
				mysql_query('SET NAMES UTF8') or die(Config::$err3);
					
				$sql = "select * from note where uid=" . $uid;
				$result = mysql_query($sql) or die( "No note table!" );
				while($record = mysql_fetch_array($result)){
					$doc = FindDoc($record['did']);
					$content = $record['content'];
			?>
				<div class="noteitem">  
					<div class="left-item">
						<h2><?= $doc->title ?></h2>
						<div class="clear"></div>
						<img src="<?= $doc->picture ?>"   />
						<p><?= $doc->description ?></p>
					</div>
					<div class="right-item">
						<h2>我的笔记</h2>
						<div class="us_bar"></div>
						<p><?= $content ?></p>
					</div>
				</div>
				
			<?php
				}
			?>
			</div>
		</div>
	</div>
	
	<div class="clear"></div>
	<?php
		require_once( ROOT."common/footer.php" );
	?>
</body>
</html>
