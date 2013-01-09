<?php
	// reconstructed by chenzhao
	// Jan, 1st. 2013
	require_once "common/common.php";
	
	if(isset($_GET['action']) && $_GET['action'] == "logout"){
		session_destroy();
	}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>型男索女阅读中心</title>
	
	<link rel="stylesheet" type="text/css" href="css/outer-style.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/common.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/index-style.css" media="all" />
	
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/index.js"></script>
	<script type="text/javascript" src="js/login.js"></script>
</head>
<body>
	<div id="banner"><div id="nav"></div></div>
	<div id="title">
		<h1>型男索女阅读交友中心</h1>
		<div id="login">
			<form action="" method="post" name="login">
				<label for="username">Username: <input class="login" type="text" maxlength="20" name="username" /></label>
				<label for="username">Password: <input class="login" type="password" maxlength="20" name="password" /></label>
				<!-- <input type="submit" name="submit" value="Login" id="submit"/> -->
			</form>
			<button id="submit">Login</button>
			<div id="hint">
				<input type="checkbox" name="remember" id="remember"/>
				<label for="remember">Remember Me</label>
				 | 
				 <a href="register.php">Register</a>
			</div>
			<span class="error" id="error1">不能为空！</span>
			<span class="error" id="error2">密码错误！</span>
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
					<h2>刘邦杰</h2>
					<h3>测试工程师</h3>
					<p>项目质量管理</p>
				</div>
			</li>
			<li>
				<a href="#" class="pos2">
					<span class="ei_preview"></span>
					<span class="ei_image"></span>
				</a>
				<div class="ei_descr">
					<h2>王建</h2>
					<h3>前端工程师</h3>
					<p>以用户为核心</p>
				</div>
			</li>
			<li>
				<a href="#" class="pos3">
					<span class="ei_preview"></span>
					<span class="ei_image"></span>
				</a>
				<div class="ei_descr">
					<h2>陈潇楠</h2>
					<h3>项目经理</h3>
					<p>掌管一切，洞察先机。</p>
				</div>
			</li>
			<li>
				<a href="#" class="pos4">
					<span class="ei_preview"></span>
					<span class="ei_image"></span>
				</a>
				<div class="ei_descr">
					<h2>朱迪</h2>
					<h3>交互设计师</h3>
					<p>用户体验是我最大价值</p>
				</div>
			</li>
			<li>
				<a href="#" class="pos5">
					<span class="ei_preview"></span>
					<span class="ei_image"></span>
				</a>
				<div class="ei_descr">
					<h2>陈照</h2>
					<h3>后端架构师</h3>
					<p>更健壮的系统</p>
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