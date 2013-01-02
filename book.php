<?php
	// book.php 
	// version 1.0 (Dec, 22th. 2012)
	// created by kylejan for web2.0 project
	
	// reconstructed by chenzhao
	// Jan, 1st. 2013
	require_once( "common/common.php" );
	require_once( ROOT."functions/upload_validation.php" );
	require_once( ROOT."database/DocControl.php");

	//Add the new record of the new uploaded book
	if(isset($_GET['action']) && $_GET['action'] == "upload"){
		$doc = new Document();
		$doc->title = checkTitle($_POST['bookname']);
		$doc->author = checkAuthor($_POST['author']);
		$doc->pubdate = checkPubdate($_POST['pubdate']);
		$doc->description = checkDescription($_POST['description']);
		$doc->tag = "";
		$upload_size_flag = checkPic($_FILES['picture']['size'],$_FILES['picture']['name']);
		if($upload_size_flag){
			$pic_name = getdate();
			move_uploaded_file($_FILES["picture"]["tmp_name"], "./images/book/$pic_name[0].jpg");
			if(is_uploaded_file($_FILES["picture"]["tmp_name"])){
				$doc->picture = "./images/book/$pic_name[0].jpg";
			}
			else{
				$doc->picture = "./images/book/Admin_pic.jpg";
			}
		}
		else{
			if(!is_uploaded_file($_FILES["picture"]["tmp_name"]))
				$doc->picture = "./images/book/Admin_pic.jpg";
		}
		$doc->good = 0;
		$doc->bad = 0;
		AddDoc($doc);
	}
	elseif(isset($_GET['action']) && $_GET['action'] == "comment"){
	}
?>

<!DOCTYPE HTML>
<!--
	version 2.0 (Dec, 31th. 2012)
	by chenzhao for web2.0 project
-->
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/common.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/book-style.css" media="all"/>
	<title>Book</title>
</head>
<body>
	<?php
		require_once( ROOT."common/header.php" );
	?>
	<!--显示单本书的详细信息-->
	<article>
		<!--用户标签-->
		<div id="tags">
			<div id="addtag">
				<form action="" method="post">
					<label><input type="text" name="newtag" maxlength="4"/></label>
					<label><input type="submit" value="添加"/></label>
				</form>
			</div>
			<div class="tag">
				<p>计算机<img src="images/tag-del.png" width="25px"/></p>
			</div>
		</div>
		
		<!--展示-->
		<div id="display">
			<!--书籍信息-->
			<div id="book">
				<img src="images/f3.jpg" alt="算法导论" width="200px"/>
				<div>
					<p><span class="ltag">文献名:  </span>算法导论</p>
				</div>
				<fieldset>
					<p class="ltag">简介</p>
					<p id="shortdes">算法界两大黑书之一, 绝对高品质!</p>
				</fieldset>
			</div>
			
			<!--用户评论-->
			<div id="comments">
				<div class="comment">
					<div class="img"><img src="images/f3.jpg" alt="用户头像" width="50px"/></div>
					<div class="detail">
						<p class="name">陈潇楠</p>
						<p class="des">超自然人类</p>
						<p class="content">卖萌</p>
						<p class="time">2012.10.12 11:00</p>
					</div>
				</div>
				<fieldset>
					<legend>添加评论</legend>
					<form action="" method="post">
						<label><textarea name="newcom" cols="70" rows="10"></textarea></label>
						<label><input type="submit" value="提交"/></label>
					</form>
				</fieldset>
			</div>
		</div>
	</article>
	<?php
		require_once( ROOT."common/footer.php" );
	?>
</body>
</html>