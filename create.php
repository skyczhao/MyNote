<?php
	require_once "common/common.php";
	require_once ROOT."database/Group.php";
	require_once ROOT."database/GroControl.php";
	require_once ROOT."functions/group_validation.php";
	require_once( ROOT."database/UsrControl.php" );
	

	if(isset($_GET['action']) && $_GET['action'] == "create"){
		$group = new Group();
		$group->uid = $_SESSION['userid'];
		
		$group->name = checkGroupName(trim($_POST['groupname']));
		
		$group->setime = date("Y-m-j");
		$group->des = checkDescription($_POST['description']);
		$group->member[] = array();
		$group->personNum = 0;
		$group->pic = checkPicture();
		
		$res = AddGroup($group);
		
		$group->AddMember($_SESSION['userid']);
		
		if($res){
			header("Location: group.php?gid=".$group->gid);
		}
	}
	
	$uid = $_SESSION['userid'];
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>MySpace</title>
	<link rel="stylesheet" type="text/css" href="css/common.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/upload-style.css" media="all" />

	<script src="js/jquery-1.7.1.js"></script>
	<script src="js/jquery.masonry.min.js" type="text/javascript"></script>
	<script src="js/square.js" type="text/javascript"></script> 
</head>

<body>
	<?php
		require_once ROOT."common/header.php";
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
			<h1>创建小组</h1>
			
			<div class="clear"></div>
			<div class="us_bar"></div>
			
			<form action="create.php?action=create" method="post" enctype="multipart/form-data">
				<div id="unamewrapper" class="infos">
					<label for="groupname">小组名称：</label>
					<input type="text" name="groupname" maxlength="15" class="text"/>
					<span class="reqstar">*</span>
					<span class="error">长度不得小于4位或大于10位，只可含有数字或字母</span>
				</div>
				<div id="groupwrapper" class="infos">
					<label for="picture">小组图片：</label>
					<input type="file" name="picture" required="true"/>
					<span class="reqstar">*</span>
				</div>
				<div id="descriptionwrapper" class="infos">
					<label for="description">小组简介：</label>
					<textarea rows="5" cols="32" name="description" class="text" maxlength="200" required="true"/></textarea>
					<span class="reqstar">*</span>
					<span class="error">长度不得大于200位</span>
				</div>
				<div id="submit" class="infos">
					<input type="submit" value="提 交"/>
				</div>
			</form>
		</div>
	</div>
	
	<div class="clear"></div>
	<?php
		require_once ROOT."common/footer.php";
	?>
</body>
</html>
