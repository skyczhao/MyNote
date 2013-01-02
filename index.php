<?php
	// reconstructed by chenzhao
	// Jan, 1st. 2013
	require_once "common/common.php";
	
	if(isset($_GET['action']) && $_GET['action'] == 'login'){
		echo "hello";
		$username = $_POST['username'];
		$password = $_POST['password'];
		if(strlen(trim($username)) == 0 || strlen(trim($password))){
			
		}
	}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>超级型男索女</title>
	
	<link href='http://fonts.googleapis.com/css?family=Rock+Salt' rel='stylesheet' type='text/css' />
	<link href='http://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css' />
	<link rel="stylesheet" type="text/css" href="css/common.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/index-style.css" media="all" />
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/index.js"></script>
</head>
<body>
	<?php
		require_once( ROOT."common/header.php" );
	?>
	<div id="title">
		<h1>型男索女阅读交友中心</h1>
		<div id="login">
			<form action="index.php?action=login" method="post" name="login">
				<label for="username">Username: <input class="login" type="text" maxlength="20" name="username" /></label>
				<label for="username">Password: <input class="login" type="password" maxlength="20" name="password" /></label>
				<input type="submit" name="submit" value="Login"/>
			</form>
			<div id="hint">
				<span class="error" id="error1">用户名或密码不能为空！</span>
				<span class="error" id="error2">用户名或密码错误！</span>
				<input type="checkbox" name="remember" id="remember"/>
				<label for="remember">Remember Me</label> | <a href="register.php">Register</a>
			</div>
		</div>
	</div>
    
    <div id="content_wrapper">
    <div id="example">
        <div id="ei_menu" class="ei_menu">
		<ul>
			<li>
				<a href="#" class="pos1">
					<span class="ei_preview"></span>
					<span class="ei_image"></span>
				</a>
				<div class="ei_descr">
					<h2>陈潇楠</h2>
					<h3>B30,000,00</h3>
					<p>伟大的组长，神级大前锋？中锋？</p>
				</div>
			</li>
			<li>
				<a href="#" class="pos2">
					<span class="ei_preview"></span>
					<span class="ei_image"></span>
				</a>
				<div class="ei_descr">
					<h2>王建</h2>
					<h3>B120,000,000</h3>
					<p>建牛 性别男 爱好coding 未婚 </p>
				</div>
			</li>
			<li>
				<a href="#" class="pos3">
					<span class="ei_preview"></span>
					<span class="ei_image"></span>
				</a>
				<div class="ei_descr">
					<h2>刘邦杰</h2>
					<h3>B400,000,000</h3>
					<p>杰帅。用mac的男人</p>
				</div>
			</li>
			<li>
				<a href="#" class="pos4">
					<span class="ei_preview"></span>
					<span class="ei_image"></span>
				</a>
				<div class="ei_descr">
					<h2>朱迪</h2>
					<h3>B16,000,000</h3>
					<p>胖妞，你懂的</p>
				</div>
			</li>
			<li>
				<a href="#" class="pos5">
					<span class="ei_preview"></span>
					<span class="ei_image"></span>
				</a>
				<div class="ei_descr">
					<h2>陈照</h2>
					<h3>B77,000,000</h3>
					<p>码农</p>
				</div>
			</li>
		</ul>
		</div>
    </div> 
	</div>
	
    <?php
		require_once( ROOT."common/footer.php" );
	?>
</body>
</html>