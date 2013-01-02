<?php
	// reconstructed by chenzhao
	// Jan, 1st. 2013
	require_once( "common/common.php" );
	require_once( ROOT."database/Config.php" );
	
	if(!isset($_GET['uid'])){
		die("error:NO SUCH USER!");
	}
	$id = $_GET['uid'];
	$con = mysql_connect(Config::$host, Config::$user, Config::$pass);
	mysql_select_db(Config::$db, $con);
	$sql = "select * from user where uid = " . $id;
	$result = mysql_query($sql,$con);
	$row = mysql_fetch_array($result);
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Other</title>
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
				<h1><?= $row['nick'] ?></h1>
				<img src="images/user.jpg" alt="MyPic"/>
				<p>一个向往着无穷无尽的创意世界，不断学习生活，享受生活的男孩</p>
			</div>

			<div class="Friend_Group">
				<h1>我的好友</h1>
				<div class="each">
					<img src="images/f1.jpg" />
					<p>卡卡罗特是神奇的超级萨亚人</p>
				</div>
				
				<div class="each">
					<img src="images/f2.jpg" />
					<p>路飞君</p>
				</div>
				
				<div class="each">
					<img src="images/f3.jpg" />
					<p>香吉士</p>
				</div>
				
				<div class="each">
					<img src="images/f4.jpg" />
					<p>娜美君</p>
				</div>
			</div>
			
			<div class="clear"></div>

			<div class="Friend_Group">
				<h1>我的小组</h1>
				<div class="each">
					<img src="images/f1.jpg" />
					<p>卡卡罗特</p>
				</div>
				
				<div class="each">
					<img src="images/f2.jpg" />
					<p>路飞君</p>
				</div>
				
				<div class="each">
					<img src="images/f3.jpg" />
					<p>香吉士</p>
				</div>
				
				<div class="each">
					<img src="images/f4.jpg" />
					<p>娜美君</p>
				</div>
			</div>
			
		</div>
		
		<div id="right_content">
			<h1>我的笔记</h1>
			
			<div class="clear"></div>
			<div class="us_bar"></div>
			
			<div class="footprint">
				<div class="item">  
					<img src="images/f1.jpg"   /></a> 
					<p>我是卡卡罗特，看我的龟波气功，超级赛亚人变身</p>
				</div>
				<div class="item">  
					<img src="images/f2.jpg"   /></a>  
				</div>  
				<div class="item">  
					<img src="images/f3.jpg"   /></a>  
				</div>  
				<div class="item">  
					<img src="images/f4.jpg"   /></a>  
				</div>  
				<div class="item">  
					<img src="images/f5.jpg"   /></a>  
				</div>  
				<div class="item">  
					<img src="images/f2.jpg"   /></a>  
				</div>  
				<div class="item">  
					<img src="images/f3.jpg"   /></a>  
				</div>  
				<div class="item">  
					<img src="images/f4.jpg"   /></a>  
				</div>  
			</div>
			
			<h1>我的评论</h1>
			<div class="clear"></div>
			<div class="us_bar"></div>
			
			<div class="footprint">
				<div class="item">  
					<img src="images/f1.jpg"   /></a>  
					<p>我是卡卡罗特，看我的龟波气功，超级赛亚人变身</p>
				</div>
				<div class="item">  
					<img src="images/f2.jpg"   /></a>  
				</div>  
				<div class="item">  
					<img src="images/f3.jpg"   /></a>  
				</div>  
				<div class="item">  
					<img src="images/f4.jpg"   /></a>  
				</div>  
				<div class="item">  
					<img src="images/f5.jpg"   /></a>  
				</div>  
				<div class="item">  
					<img src="images/f2.jpg"   /></a>  
				</div>  
				<div class="item">  
					<img src="images/f3.jpg"   /></a>  
				</div>  
				<div class="item">  
					<img src="images/f4.jpg"   /></a>  
			</div>
		</div>
	</div>
	
	<div class="clear"></div>
	<?php
		require_once( ROOT."common/footer.php" );
	?>
</body>
</html>
