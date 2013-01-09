<?php
	// book.php 
	// version 1.0 (Dec, 22th. 2012)
	// created by kylejan for web2.0 project
	
	// reconstructed by chenzhao
	// Jan, 1st. 2013
	require_once( "common/common.php" );
	require_once( ROOT."database/DocControl.php" );
	require_once( ROOT."database/ComControl.php" );
	require_once( ROOT."database/UsrControl.php" );
	
	if( isset( $_GET['did'] ) )
		$did = $_GET['did'];
	
	// 查找文献
	if( !isset( $did ) )
		exit( "No parameters!" );
	$doc = FindDoc( $did );
	if( is_bool( $doc ) )
		exit( "Document doesn't exit!" );

	// 添加评论
	if( isset( $_POST["newcom"] ) )
	{
		$com = new Comment();
		$com->uid = $_SESSION['userid'];
		$com->did = $did;
		$com->content = $_POST["newcom"];
		$com->comtime = date("Y-m-j");
		AddComment( $com );
	}
	
	// 添加标签
	if( isset( $_POST["newtag"] ) )
	{
		$newt = $_POST["newtag"];
		if( !empty( $doc->tag ) )
		{
			$newt = ";" . $newt;
		}
		$doc->tag = $doc->tag . $newt;
		
		// 提交数据库更新
		$con = mysql_connect(Config::$host, Config::$user, Config::$pass) or die( Config::$err1 );
		mysql_select_db(Config::$db, $con) or die(Config::$err2);
		mysql_query('SET NAMES UTF8') or die(Config::$err3);
		
		$sql = "update document set tag = '" . $doc->tag . "' where did = " . $doc->id;
		$result = mysql_query($sql,$con) or die(mysql_error());
		mysql_close();
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
	<script src="js/jquery-1.7.1.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/book.js"></script>
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
			<?php
			$tags = explode(';',$doc->tag);
			if( !empty( $doc->tag ) )
			foreach( $tags as $t )
			{
			?>
			<div class="tag">
				<p><?= $t ?><img src="images/tag-del.png" width="25px"/></p>
			</div>
			<?php
			}
			?>
		</div>
		
		<!--展示-->
		<div id="display">
			<!--书籍信息-->
			<div id="book">
				<img src="<?= empty( $doc->picture ) ? "images/b0.jpg" : $doc->picture ?>" alt="<?=$doc->title?>" width="200px"/>
				<div>
					<p><span class="ltag">文献名:  </span><?=$doc->title?></p>
					<p><span class="ltag">作者:  </span><?=$doc->author?></p>
					<p><span class="ltag">出版日期:  </span><?=$doc->pubdate?></p>
				</div>
				<fieldset>
					<p class="ltag">简介</p>
					<p id="shortdes"><?=$doc->description?></p>
					<ul>
						<li><button id="addnote">添加笔记</button></li>
						<li id="goodp"><?= $doc->good ?></li>
						<li><button id="good">赞</button></li>
						<li id="badp"><?= $doc->bad ?></li>
						<li><button id="bad">踩</button></li>
					</ul>
				</fieldset>
			</div>
			
			<!--用户评论-->
			<div id="comments">
				<?php
				$con = mysql_connect(Config::$host, Config::$user, Config::$pass) or die( Config::$err1 );
				mysql_select_db(Config::$db, $con) or die(Config::$err2);
				mysql_query('SET NAMES UTF8') or die(Config::$err3);
				
				$sql = "select * from comment where did = " . $did;
				$result = mysql_query($sql,$con);
				mysql_close();
				
				if( mysql_num_rows( $result ) > 0 )
				while($row = mysql_fetch_array($result)){
					$arr[]=array(
						'uid' => $row['uid'],
						'content' => $row['content'],
						'comtime' => $row['comtime']
					);
					
					$usr = FindUser($row['uid']);
				?>
				<div class="comment">
					<div class="img"><img src="<?= empty( $usr->picture ) ? "images/f1.jpg" : $usr->picture ?>" width="50px"/></div>
					<div class="detail">
						<p class="name"><?= $usr->nick ?></p>
						<p class="des"><?= $usr->signature ?></p>
						<p class="content"><?= $row['content'] ?></p>
						<p class="time"><?= $row['comtime'] ?></p>
					</div>
				</div>
				<?php
				}
				?>
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