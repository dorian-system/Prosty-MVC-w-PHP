<?php
/*
base path:
$config->APP_PATH

site main menu: 
view_menu();

page title:
$page['title']

page content:
$page['content']

page created:
$page['created']

page lastmod:
$page['lastmod']

*/

require_once "controllers/ContentController.php";
$vcontent = new ContentController();

require_once "controllers/SiteInfoController.php";

if (isset($_GET['id'])){
	$id = $_GET['id'];
}

$page = $vcontent->print_content($id);

require_once "views/site/_menu.php";


if(!$page['alt_title']){
	$p_title = $page['title'];
}else{
	$p_title = $page['alt_title'];
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<title><?=$p_title." - ".$info{'site_name'};?></title>
	<meta charset="utf-8">
	<meta name="description" content="<?=$page['description'];?>" />
	<meta name="keywords" content="<?=$page['keywords'];?>" />
	<meta name="generator" content="DORIAN-SYSTEM" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="icon" type="image/ico" href="<?=$config->APP_PATH;?>/web/images/favicon.ico"></link>
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600,600italic,800' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?=$config->APP_PATH;?>/web/css/bootstrap.min.css" media="all" />
	<link rel="stylesheet" href="<?=$config->APP_PATH;?>/web/css/style.css" media="all" />
	
	<script src="<?=$config->APP_PATH;?>/web/js/jquery.min.js"></script>
	<script src="<?=$config->APP_PATH;?>/web/js/bootstrap.min.js"></script>

</head>
<body>
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>                        
		  </button>
		  <a class="navbar-brand" href="/"><img src="<?=$config->APP_PATH;?>/web/images/logo.png" /></a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
		  <?=view_menu();?>
		  <ul class="nav navbar-nav navbar-right">
			<li><a href="<?=$config->APP_PATH?>/admin/"><span class="glyphicon glyphicon-log-in"></span> Zaloguj się</a></li>
		  </ul>
		</div>
	  </div>
	</nav>
	<div class="container-fluid">
		<div class="row content">
			<br />
			<div class="col-sm-2 sidenav">
				
			</div>
			
			<div class="col-sm-8 text-left">
				<h2><?=$page['title'] ?></h2>
				<?=$page['content'] ?>
				<hr />
				<?php if ($page['created']): ?>
					<span class="label label-default">Data dodania: <?=$page['created']?></span>
				<?php endif ?>
				<?php if ($page['lastmod']): ?>
					<span class="label label-default">Uaktualniono: <?=$page['lastmod']?></span>
				<?php endif ?>
				<?php if ($page['category']): ?>
					<span class="label label-default">Kategoria: <?=$page['category']?></span>
				<?php endif ?>
			</div>
			
			<div class="col-sm-2 sidenav">
				
			</div>
			
		</div>
	</div> 
	<footer class="container-fluid text-center">
		<p>&copy; <?php echo date("Y"); ?> <?=$info{'site_name'}; ?> | Prosty MVC</p>
	</footer>
</body>
</html>