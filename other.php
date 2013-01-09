<?php
	// reconstructed by chenzhao
	// Jan, 1st. 2013
	
	// reconstructed by kylejan
	// Jan, 8th. 2013
	require_once( "common/common.php" );
	require_once( ROOT."database/Config.php" );
	require_once( ROOT."database/UsrControl.php" );
	require_once( ROOT."database/GroControl.php" );
	require_once( ROOT."database/DocControl.php" );
	require_once( ROOT."database/ComControl.php" );
	
	if(!isset($_GET['uid'])){
		die("error:NO SUCH USER!");
	}
	$uid = $_GET['uid'];
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Other</title>
	<link rel="stylesheet" type="text/css" href="css/common.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/person-style.css" media="all" />
	
	<script src="js/jquery-1.7.1.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/add_friend.js"></script>
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
					
					$sql_to_user = "select * from user where uid=" . $uid;	
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
				<h1><?php if(FindUser($uid)->gender == 1){echo "他的好友";}
							else{echo "她的好友";} ?></h1>
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
				<h1><?php if(FindUser($uid)->gender == 1){echo "他的小组";}
							else{echo "她的小组";} ?></h1>
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
			<h1><?php if(FindUser($uid)->gender == 1){echo "他的评论";}
							else{echo "她的评论";} ?></h1>
			<?php
				if(isset($_GET['uid']) && $_GET['uid'] != $_SESSION['userid']){
					$con = mysql_connect(Config::$host, Config::$user, Config::$pass) or die(Config::$err1);
					mysql_select_db(Config::$db, $con) or die(Config::$err2);
					mysql_query('SET NAMES UTF8') or die(Config::$err3);
					
					$sql = "select * from `friend` where uid1 = '" . $_GET['uid'] . "' and uid2 = '" . $_SESSION['userid'] . "'";
					$sql .= " or uid2 = '" . $_GET['uid'] . "' and uid1 = '" . $_SESSION['userid'] . "'";
					$result = mysql_query($sql) or die(mysql_error());
					if( mysql_num_rows( $result ) < 1 )
					{
			?>
						<button id="add_friend">加为好友</button>
			<?php
					}
					mysql_close();
				}
			?>

			<div class="clear"></div>
			<div class="us_bar"></div>
			
			<div class="footprint">
				<?php		
					$con_comment = mysql_connect(Config::$host, Config::$user, Config::$pass);
					mysql_select_db(Config::$db, $con_comment);
					mysql_query('SET NAMES UTF8') or die(Config::$err3);
					
					$sql_to_comment = "select * from comment where uid=" . $uid;	
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
		</div>
	</div>
	
	<div class="clear"></div>
	<?php
		require_once( ROOT."common/footer.php" );
	?>
</body>
</html>
