<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<title><?=$title;?></title>
	<meta name="keywords" content="<?=$key;?>" />
	<meta name="description" content="<?=$desc;?>" />
	<base href="<?=BASE;?>" />
	<link href="templates/css/style.css" rel="stylesheet">
</head>
<body>
<div class="wrapper">
	<header class="header">
		<?=$title;?>
		<div class="subheader">
			Super Lightweight CMS
		</div>
	</header>
	<div class="middle">
		<div class="container">
		<div class="wrapper2">
			<div class="breadcrumb">
				<? if(empty($_GET["page"])){echo "index";}else{echo $_GET["page"];}?>
			</div>
			<main class="content">
				<?=$content;?>
			</main>
		</div>
		<div class="info"><?=$mvc;?></div>
		</div>
		<aside class="kiri">
			<span style="color:black;">Menu Utama</span>
			<hr width="80%" align="right" style="margin-top:-3px;">
			<ul>
				<?=$utama;?>
			</ul>
			<br><br>
			<span style="color:black;">Kategori</span>
			<hr width="80%" align="right" style="margin-top:-3px;">
			<ul>
				<?=$kategori;?>
			</ul>
		</aside>
		<aside class="kanan">
			<span style="color:black;">Pages</span>
			<hr width="80%" align="left" style="margin-top:-3px;">
			<ul>
				<?=$pages;?>
			</ul>
			<br><br>
			<span style="color:black;">Blogroll</span>
			<hr width="80%" align="left" style="margin-top:-3px;">
			<ul>
				<?=$blogroll;?>
			</ul>
		</aside>
	</div>
</div>
<footer class="footer">
<span style="align:center;">Copyright 2013 | Hadi Sutomo | LogosCMS v 1.0<br>
</footer>
</body>
</html>