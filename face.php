<?php
	// reconstructed by chenzhao
	// Jan, 1st. 2013
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<script src="js/jquery-1.7.1.js" type="text/javascript"></script>
	<script src="js/jquery.masonry.min.js" type="text/javascript"></script>
	<script src="js/face.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="css/face-style.css" media="all" />
	<title>头像选择</title>
</head>
<body>
	<h3>选择你喜欢的头像</h3>
	<div id="faces">
		<?php
			foreach(range(1, 9) as $num){
		?>
		<div class="items chosen">
			<img src="images/face/m0<?=$num?>.gif" alt="images/face/m0<?=$num?>.gif" title="face0<?=$num?>"/>
		</div>
		<?php
			}
		?>
		
		<?php
			foreach(range(10, 64) as $num){
		?>
		<div class="items">
			<img src="images/face/m<?=$num?>.gif" alt="images/face/m<?=$num?>.gif" title="face<?=$num?>"/>
		</div>
		<?php
			}
		?>
	</div>
</body>
</html>