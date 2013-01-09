<?php
	// person.php 
	// version 1.0 (Dec, 17th. 2012)
	// created by kylejan for web2.0 project
	
	// reconstructed by chenzhao
	// Jan, 1st. 2013
	require_once( "common/common.php" );
	require_once( "database/UsrControl.php" );
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>管理员</title>
	<link rel="stylesheet" type="text/css" href="css/common.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/person-style.css" media="all" />
	
	<script src="js/jquery-1.7.1.js" type="text/javascript"></script>
	<script src="js/jquery.masonry.min.js" type="text/javascript"></script>
	<script src="js/square.js" type="text/javascript"></script> 
	<script src="js/admin.js" type="text/javascript"></script>
</head>

<body>
	<div id="banner"><div id="nav">
		<ul><li><a href="index.php?action=logout">退出</a></li></ul>
	</div></div>
	
	<div id="main">
		<div id="left_content">
			<div class="info">
				<h1>管理员</h1>
				<img src="images/user.jpg" alt="MyPic"/>
				<p>Administrator</p>
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
					
					$sql_group = "select * from `group`";
					$result_group = mysql_query($sql_group,$con) or die("No group!");
		
					if( mysql_num_rows($result_group) > 0 ){
						while($g_row = mysql_fetch_array($result_group)){
							$arr[]=array(
								'gid' => $g_row['gid'],
								'uid' => $g_row['uid'],
								'name' => $g_row['name'],
								'setime' => $g_row['setime'],
								'personNum' => $g_row['personNum']
							);
				?>		
				<div class="item">  
					<p>小组ID:<?= $g_row['gid']?></p>
					<p>小组名称：<?= $g_row['name']?></p>
					<p>组长：<?= $g_row['uid']?></p>
					<p>小组成员数：<?= $g_row['personNum']?></p>
					<p>建立时间：<?= $g_row['setime']?></p>
					<button class="delete_group" value="<?= $g_row['gid']?>">删除小组</button>
				</div>  
				<?php
					}
					mysql_close();
				}
				?>
			</div>
			
			<h1>用户管理</h1>
			<div class="clear"></div>
			<div class="us_bar"></div>
						<div class="footprint">	
				<?php
					$con1 = mysql_connect(Config::$host, Config::$user, Config::$pass) or die(Config::$err1);	
					mysql_select_db(Config::$db, $con1) or die(Config::$err2);
					
					$sql_user = "select * from `user`";
					$result_user = mysql_query($sql_user,$con1) or die("No user!");
		
					if( mysql_num_rows($result_user) > 0 ){
						while($u_row = mysql_fetch_array($result_user)){
							$arr[]=array(
								'uid' => $u_row['uid'],
								'name' => $u_row['name']
							);
				?>		
				<div class="item" id=<?= $u_row['uid']?>>  
					<p>用户ID:<span class="uid"><?= $u_row['uid']?></span></p>
					<p>用户名：<?= $u_row['name']?></p>
					<button class="delete_user" value="<?= $u_row['uid']?>">删除用户</button>
				</div>  
				<?php
					}
					mysql_close();
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
