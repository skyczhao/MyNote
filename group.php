<?php
	// person.php 
	// version 1.0 (Dec, 17th. 2012)
	// created by kylejan for web2.0 project

	require_once( "common/common.php" );
	require_once( ROOT."database/GroControl.php" );
	require_once( ROOT."database/DocControl.php" );
	require_once( ROOT."database/UsrControl.php" );
	
	if(isset($_GET['gid']))
		$gid = $_GET['gid'];
	$group = FindGroup($gid);
	$member = array();
	$member = $group->member;
	$personNum = $group->personNum;
	$num = 0;
	$uid = $_SESSION['userid'];
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Group</title>
	<link rel="stylesheet" type="text/css" href="css/common.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/group-style.css" media="all" />
	
	<script src="js/jquery-1.7.1.js" type="text/javascript"></script>
	<script src="js/jquery.masonry.min.js" type="text/javascript"></script>
	<script src="js/square.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/join_group.js"></script>
	<script type="text/javascript" src="js/out_group.js"></script>
</head>

<body>
	<?php
		require_once( ROOT."common/header.php" );
	?>
	
	<div id="main">
		<div id="left_content">
			<div class="info">
				<h1><?= $group->name ?></h1>
				<?php
					$flag = 0;
					if(count($member) != 0){
						foreach($member as $value){
							if($value == $uid){
								$flag = 1;
							}
						}
					}
					if(!$flag){
				?>
					<button id="join_group">加入小组</button>
				<?php
					}
					elseif($flag && $uid != $member[0]){
				?>
					<button id="out_group">退出小组</button>
				<?php
					}
					else{
				?>
					<h5>管理员身份</h5>
				<?php
					}
				?>
				<img src="images/group/<?= $group->pic ?>" alt="MyPic"/>
				<p><?= $group->des ?></p>
			</div>

			<div class="Friend_Group">
				<h1>小组成员</h1>
				<div class="clear"></div>
				<?php
					if($personNum <= 15){
						while($num < $personNum){
							$user = FindUser($member[$num]);
				?>
				<div class="each">
					<img src="<?= $user->picture ?>" />
					<p><?= $user->name ?></p>
				</div>
				<?php
						$num++;
						}
					}
					elseif($personNum > 15){
						while($num < 15){
							$user = FindUser($member[$num]);
				?>
				<div class="each">
					<img src="<?= $user->picture ?>" />
					<p><?= $user->name ?></p>
				</div>
				<?php
						$num++;
						}
					}
				?>
			</div>
			
			<div class="clear"></div>
			
		</div>
		
		<div id="right_content">
			<h1>小组成员笔记</h1>
			<div class="clear"></div>
			<div class="us_bar"></div>
			
			<div class="footprint">
				<?php
					$num = 0;
					
					if($personNum <= 15){
						while($num < $personNum){
							mysql_connect( Config::$host, Config::$user, Config::$pass ) or die( Config::$err1 );
							mysql_select_db( Config::$db ) or die( Config::$err2 );
							mysql_query('SET NAMES UTF8') or die(Config::$err3);
							
							$sql = "select * from note where uid=" . $member[$num];
							$result = mysql_query($sql) or die( "No note table!" );
							
							while($record = mysql_fetch_array($result)){
								$doc = FindDoc($record['did']);
								$user = FindUser($record['uid']);
								if($record['shared']){
				?>
								<div class="item">
									<div class="left-item">
										<h2><?= $doc->title ?></h2>
										<div class="clear"></div>
										<img src="<?= $doc->picture ?>"   /></a>  
										<p><?= $doc->description ?></p>
									</div>
									<div class="right-item">
										<h2><?= $user->name ?>的笔记</h2>
										<div class="us_bar"></div>
										<p><?= $record['content'] ?></p>
									</div>
								</div>
				<?php
								}
							}
							$num++;
						}
					}
					elseif($personNum > 15){
						while($num < 15){
							mysql_connect( Config::$host, Config::$user, Config::$pass ) or die( Config::$err1 );
							mysql_select_db( Config::$db ) or die( Config::$err2 );
							mysql_query('SET NAMES UTF8') or die(Config::$err3);
							
							$sql = "select * from note where uid=" . $member[$num];
							$result = mysql_query($sql) or die( "No note table!" );
							
							while($record = mysql_fetch_array($result)){
								$doc = FindDoc($record['did']);
								$user = FindUser($record['uid']);
								if($record['shared']){
				?>
								<div class="item">
									<div class="left-item">
										<h2><?= $doc->title ?></h2>
										<div class="clear"></div>
										<img src="<?= $doc->picture ?>"   /></a>  
										<p><?= $doc->description ?></p>
									</div>
									<div class="right-item">
										<h2><?= $user->name ?>的笔记</h2>
										<div class="us_bar"></div>
										<p><?= $record['content'] ?></p>
									</div>
								</div>
				<?php
								}
							}
							$num++;
						}
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
