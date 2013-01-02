<?php
	// reconstructed by chenzhao
	// Jan, 1st. 2013
	require_once( "common/common.php" );
	require_once( ROOT."database/Config.php" );
?>

<!DOCTYPE HMTL>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>User Square</title>
		
		<link rel="stylesheet" type="text/css" href="css/common.css" />
		<link rel="stylesheet" type="text/css" href="css/users-style.css" />
		
		<script src="js/jquery-1.7.1.js"></script>
		<script src="js/jquery.masonry.min.js" type="text/javascript"></script>
 		<script src="js/pageSystem.js" type="text/javascript"></script>
		<script src="js/users.js" type="text/javascript"></script> 
	</head>
	
	<body>
		<?php
			require_once( ROOT."common/header.php" );
		?>	
		
		<div id="page">
			<div id="us_bar">
				用户广场
			</div>
			<div id="main">
	
				<?php
				$con = mysql_connect(Config::$host, Config::$user, Config::$pass);	
				mysql_select_db(Config::$db, $con);
				$sql = "select * from user";
				$result = mysql_query($sql,$con);
				while($row = mysql_fetch_array($result)){
					$arr[]=array(
						'nick' => $row['nick'],
						'gender' => $row['gender'],
						'uid' => $row['uid']
						//'face' => $row['face']
					);
				?>
				<div class="item">  
					<a href="other.php?uid=<?= $row['uid']?>">  
					<img src="images/f1.jpg"/></a>  
				
					<h1><?= $row['nick'] ?></h1>
					<h2><?php if($row['gender']=="male"){echo "男";} else {echo "女";}?></h2>
					<p>你好</p>	
				</div>
				<?php
				}
				mysql_close();
				?>
			
			</div>
		</div>
		<?php
			require_once( ROOT."common/footer.php" );
		?>		
	</body>
</html>