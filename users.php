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
		<title>Users</title>
		
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
				$con = mysql_connect(Config::$host, Config::$user, Config::$pass) or die(Config::$err1);	
				mysql_select_db(Config::$db, $con) or die(Config::$err2);
				mysql_query('SET NAMES UTF8') or die(Config::$err3);
				
				$sql = "select * from user";
				$result = mysql_query($sql,$con);
				if( mysql_num_rows( $result ) > 0 )
				while($row = mysql_fetch_array($result)){
				?>
				<div class="item">  
					<a href="other.php?uid=<?= $row['uid']?>">
					<img src="<?= empty( $row['picture'] ) ? "images/AdminUser.gif" : $row['picture'] ?>"/></a>  
				
					<h3><?= $row['nick'] ?></h3>
					<p><?= $row['signature'] ?></p>
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