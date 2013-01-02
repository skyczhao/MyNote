<?php
	// reconstructed by chenzhao
	// Jan, 1st. 2013
	require_once( "common/common.php" );
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>MySpace</title>
	<link rel="stylesheet" type="text/css" href="css/common.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/upload-style.css" media="all" />

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
				<h1>Kylejan奋斗学业</h1>
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
			<h1>上传书籍</h1>
			
			<div class="clear"></div>
			<div class="us_bar"></div>
			
			<form action="book.php?action=upload" method="post" enctype="multipart/form-data">
				<div id="unamewrapper" class="infos">
					<label for="bookname">书名：</label>
					<input type="text" name="bookname" maxlength="15" class="text"/>
					<span class="reqstar">*</span>
					<span class="error">长度不得小于4位或大于10位，只可含有数字或字母</span>
				</div>
				<div id="authorwrapper" class="infos">
					<label for="author">作者：</label>
					<input type="text" name="author" maxlength="15" class="text"/>
					<span class="reqstar">*</span>
					<span class="error">长度不得小于8位或大于15位，只可含有数字或字母</span>
				</div>
				<div id="datewrapper" class="infos">
					<label for="pubdate">出版年份：</label>
					<input type="date" name="pubdate" class="text" value="2011-11-11"/>
					<span class="reqstar">*</span>
				</div>
				<div id="bookwrapper" class="infos">
					<label for="picture">书籍图片：</label>
					<input type="file" name="picture" class="text"/>
					<span class="reqstar">*</span>
					<span class="error">长度必须为4位，只含有数字</span> 
				</div>
				<div id="descriptionwrapper" class="infos">
					<label for="description">书籍简介：</label>
					<textarea rows="5" cols="32" name="description" class="text"/></textarea>
					<span class="reqstar">*</span>
					<span class="error">长度不得大于200位</span>
				</div>
				<div id="submit" class="infos">
					<input type="submit" value="提 交"/>
				</div>
			</form>
		</div>
	</div>
	
	<div class="clear"></div>
	<?php
		require_once( ROOT."common/footer.php" );
	?>
</body>
</html>
