<?php
	// reconstructed by chenzhao
	// Jan, 1st. 2013
	
	// reconstructed by kylejan
	// Jan, 8th. 2013
	require_once( "common/common.php" );
	require_once( ROOT."database/Config.php" );
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Groups</title>
	
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
			小组广场
		</div>
		<div id="main">
			<?php
			$con = mysql_connect(Config::$host, Config::$user, Config::$pass) or die(Config::$err1);	
			mysql_select_db(Config::$db, $con) or die(Config::$err2);
			mysql_query('SET NAMES UTF8') or die(Config::$err3);
			
			$sql = "select * from `group`";
			$result = mysql_query($sql,$con) or die(mysql_error());
			if( mysql_num_rows( $result ) > 0 )
			while($row = mysql_fetch_array($result)){
			?>
			<div class="item">  
				<a href="group.php?gid=<?= $row['gid']?>">  
					<img src="<?= empty( $row['pic'] ) ? "images/group/AdminGroup.jpg" : "images/group/" . $row['pic'] ?>"/>
				</a>  
			
				<h3><?= $row['name'] ?></h3>
				<p><?= $row['description'] ?></p>
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