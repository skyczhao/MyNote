<?php
	// reconstructed by chenzhao
	// Jan, 1st. 2013
	require_once( "common/common.php" );
	require_once( ROOT."functions/upload_validation.php" );
	require_once( ROOT."database/DocControl.php" );
	require_once( ROOT."database/GroControl.php" );
	require_once( ROOT."database/UsrControl.php" );
	
	//Add the new record of the new uploaded book
	if(isset($_POST['action']) && $_POST['action'] == "upload"){
		$doc = new Document();
		$doc->title = checkTitle($_POST['bookname']);
		$doc->author = checkAuthor($_POST['author']);
		$doc->pubdate = checkPubdate($_POST['pubdate']);
		$doc->description = checkDescription($_POST['description']);
		$doc->tag = "";
		$upload_size_flag = checkPic($_FILES['picture']['size'],$_FILES['picture']['name']);
		if($upload_size_flag){
			$pic_name = getdate();
			move_uploaded_file($_FILES["picture"]["tmp_name"], "./images/book/$pic_name[0].jpg");
			if(is_uploaded_file($_FILES["picture"]["tmp_name"])){
				$doc->picture = "./images/book/$pic_name[0].jpg";
			}
			else{
				$doc->picture = "./images/book/Admin_pic.jpg";
			}
		}
		else{
			if(!is_uploaded_file($_FILES["picture"]["tmp_name"]))
				$doc->picture = "./images/book/Admin_pic.jpg";
		}
		$doc->good = 0;
		$doc->bad = 0;
		if( AddDoc($doc) )
		{
			header("Location:book.php?did=" . $doc->id);
			exit();
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
			<h1>上传书籍</h1>
			
			<div class="clear"></div>
			<div class="us_bar"></div>
			
			<form action="" method="post" enctype="multipart/form-data">
				<input type="hidden" name="action" value="upload"/>
				<div id="unamewrapper" class="infos">
					<label for="bookname">书名：</label>
					<input type="text" name="bookname" maxlength="15" class="text"/>
					<span class="reqstar">*</span>
					<span class="error">长度不得小于4位或大于10位，只可含有数字或字母</span>
				</div>
				<div id="authorwrapper" class="infos">
					<label for="author">作者：</label>
					<input type="text" name="author" maxlength="15" class="text"/>
					<span class="reqstar">*</span>
					<span class="error">长度不得小于8位或大于15位，只可含有数字或字母</span>
				</div>
				<div id="datewrapper" class="infos">
					<label for="pubdate">出版年份：</label>
					<input type="date" name="pubdate" class="text" value="2011-11-11"/>
					<span class="reqstar">*</span>
				</div>
				<div id="bookwrapper" class="infos">
					<label for="picture">书籍图片：</label>
					<input type="file" name="picture" class="text"/>
					<span class="reqstar">*</span>
					<span class="error">长度必须为4位，只含有数字</span> 
				</div>
				<div id="descriptionwrapper" class="infos">
					<label for="description">书籍简介：</label>
					<textarea rows="5" cols="32" name="description" class="text"/></textarea>
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
		require_once( ROOT."common/footer.php" );
	?>
</body>
</html>
