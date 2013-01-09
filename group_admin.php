<?php
	// person.php 
	// version 1.0 (Dec, 17th. 2012)
	// created by kylejan for web2.0 project
	
	// reconstructed by chenzhao
	// Jan, 1st. 2013
	require_once( "common/common.php" );
	require_once( "database/UsrControl.php" );
	require_once( "database/GroControl.php" );
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>小组管理员</title>
	<link rel="stylesheet" type="text/css" href="css/common.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/group_admin-style.css" media="all" />
	
	<script src="js/jquery-1.7.1.js" type="text/javascript"></script>
	<script src="js/jquery.masonry.min.js" type="text/javascript"></script>
	<script src="js/square.js" type="text/javascript"></script> 
	<script src="js/admin.js" type="text/javascript"></script>
</head>

<body>
	<?php
		require_once( ROOT."common/header.php" );
	?>
	
	<div id="main">
		<div id="left_content">
			<div class="info">
				<h1>小组管理员</h1>
				<img src="images/user.jpg" alt="MyPic"/>
				<p>Group Administrator</p>
			</div>
		</div>
		
		<div id="right_content">
			<h1>小组管理</h1>
	
			<div class="clear"></div>
			<div class="us_bar"></div>
			
			<div class="footprint">	
				<?php
					$con = mysql_connect(Config::$host, Config::$user, Config::$pass) or die(Config::$err1);	
					mysql_select_db(Config::$db, $con) or die(Config::$err2);
					mysql_query('SET NAMES UTF8') or die(Config::$err3);
					
					$sql_group = "select * from `group` where uid=" . $_SESSION['userid'];
					$result_group = mysql_query($sql_group,$con) or die("No group!");
		
					if( mysql_num_rows($result_group) > 0 ){
						while($g_row = mysql_fetch_array($result_group)){
						
				?>		
				<div class="item">  
					<div>
					<p>小组ID:<?= $g_row['gid']?></p>
					<p>小组名称：<?= $g_row['name']?></p>
					<p>小组成员数：<?= $g_row['personNum']?></p>
					<p>建立时间：<?= $g_row['setime']?></p>
					<button class="delete_group" value="<?= $g_row['gid']?>">删除小组</button>
					</div>
					<div class="us_bar"></div>
					<div class="admin-right-item">
						<h1>小组成员</h1>
						<div class="clear"></div>
					
						<?php
							$group = FindGroup($g_row['gid']);
							$member = array();
							$member = $group->member;
							$personNum = $group->personNum;
							$num = 0;
							
							if($personNum <= 15){
							while($num < $personNum){
								$user = FindUser($member[$num]);
						?>
						<div class="each">
							<img src= "<?= $user->picture ?>"  />
							<p><?= $user->name ?></p>
							<button class="delete_group_mem" value="<?= $g_row['gid']?>&<?= $user->uid?>">删除</button>
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
							<button class="delete_group_mem" value="<?= $g_row['gid']?>&<?= $user->uid?>">删除</button>
						</div>
						<?php
								$num++;
								}
							}
						?>
						
					</div>
				</div>	
				
				<?php
					}
					//mysql_close();
				}
				?>
			</div>
									
		
	</div>
	
	<div class="clear"></div>
	<?php
		require_once( ROOT."common/footer.php" );
	?>
</body>
</html>
