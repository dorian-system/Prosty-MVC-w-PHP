<?php  
    session_start();
    if(!$_SESSION['email'] and !$_SESSION['login_key']){
		//przekieruj do strony logowania, aby zabezpieczyć stronę powitalną bez dostępu do logowania.
		header("Location: login.php");
    }
	
	//ścieżka do katalogu configuracji
	require_once "../config/config.php";
?>
     
<!DOCTYPE html> 
<html>  
    <head lang="pl">  
        <title>Panel Administratora</title>  
		<meta charset="utf-8">
		<meta name="generator" content="DORIAN-SYSTEM" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="icon" type="image/ico" href="<?=$config->APP_PATH;?>/web/images/favicon.ico"></link>
		<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600,600italic,800' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="<?=$config->APP_PATH;?>/web/css/bootstrap.min.css" media="all" />
		<link rel="stylesheet" href="<?=$config->APP_PATH;?>/web/css/style.css" media="all" />
		
		<script src="<?=$config->APP_PATH;?>/web/js/jquery.min.js"></script>
		<script src="<?=$config->APP_PATH;?>/web/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?=$config->APP_PATH;?>/admin/web/openwysiwyg/scripts/wysiwyg.js"></script>
		<script type="text/javascript" src="<?=$config->APP_PATH;?>/admin/web/openwysiwyg/scripts/wysiwyg-settings.js"></script>
	
    </head>      
    <body class="admin-page">        
    <div class="container">
		<div class="page-header">			
			<nav class="navbar navbar-default">
			  <div class="container-fluid">
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				  </button>
				  <a class="navbar-brand" href="<?=$config->APP_PATH?>/admin"><img src="<?=$config->APP_PATH;?>/web/images/logo.png" /></a>
				</div>
				
				<div class="collapse navbar-collapse" id="myNavbar">
				  <ul id="navbar-nav" class='nav navbar-nav'>
					<li class="<?=(!count($_GET) ? "active" : null); ?>" ><a href="<?=$config->APP_PATH?>/admin/index.php"><i class="glyphicon glyphicon-list-alt"></i> Podstawowe dane</a></li>
					<li class="<?=($_GET['page'] == 'users' ? "active" : null); ?>" ><a href="<?=$config->APP_PATH?>/admin/index.php?page=users"><i class="glyphicon glyphicon-user"></i> Użytkownicy</a></li>
					<li class="<?=($_GET['page'] == 'menu' ? "active" : null); ?>" ><a href="<?=$config->APP_PATH?>/admin/index.php?page=menu"><i class="glyphicon glyphicon-menu-hamburger"></i> Menu</a></li>
					<li class="<?=($_GET['page'] == 'list' ? "active" : null); ?>" ><a href="<?=$config->APP_PATH?>/admin/index.php?page=list"><i class="glyphicon glyphicon-file"></i> Zawartość</a></li>
				  </ul>
				  <ul class="nav navbar-nav navbar-right">
					<li><a href="logout.php"><i class='glyphicon glyphicon-log-out'></i> Wyloguj się</a></li>
				  </ul>
				</div>
			  </div>
			</nav>
		</div>
	
		<?php  
			
			if($_POST) {
				if($_POST['create']){
					require_once "{$config->APP_PATH}/controllers/CreateEditContentController.php";
					$vcreateedit->post_data($_POST);
					$alert_success = true;
					$alert = "Zmiany zostały zapisane.";
					require_once "{$config->APP_PATH}/views/admin/content_list.php";
				}elseif($_POST['post_menu']){
					
					require_once "{$config->APP_PATH}/controllers/MenuController.php";
					$aux_vmenu->post_data($_POST);
					$alert_success = true;
					$alert = "Zmiany zostały zapisane.";
					require_once "{$config->APP_PATH}/views/admin/menu_list.php";
					
				}elseif($_POST['site_info']){
					
					require_once "{$config->APP_PATH}/controllers/SiteInfoController.php";
					$csiteinfo->post_data($_POST);
					$alert_success = true;
					$alert = "Zmiany zostały zapisane.";
					require_once "{$config->APP_PATH}/views/admin/site_info.php";	
					
				}elseif($_POST['post_user']){
					
					require_once "{$config->APP_PATH}/controllers/UserController.php";
					$cusers = new UserController();
					$cusers->post_data($_POST);
					
					if (mysql_insert_id()){
						$alert_success = true;
						$alert = "Utworzono nowe konto użytkownika.";
						require_once "{$config->APP_PATH}/views/admin/user_list.php";
					}elseif($_POST['id'] and !$config->alert_danger){
						$alert_success = true;
						$alert = "Zmiany zostały zapisane.";
						require_once "{$config->APP_PATH}/views/admin/user_list.php";
					}else{
						$config->alert_danger = true;
						require_once "{$config->APP_PATH}/views/admin/user.php";
					}
				}
			}elseif($_GET['page']== "create"){
				require_once "{$config->APP_PATH}/controllers/CreateEditContentController.php";
				require_once "{$config->APP_PATH}/views/admin/content.php";
			}elseif($_GET['page'] == "list"){
				require_once "{$config->APP_PATH}/controllers/CreateEditContentController.php";
				require_once "{$config->APP_PATH}/views/admin/content_list.php";
			}elseif($_GET['edit']){
				require_once "{$config->APP_PATH}/controllers/CreateEditContentController.php";
				require_once "{$config->APP_PATH}/views/admin/content.php";
			}elseif($_GET['delete']){
				require_once "{$config->APP_PATH}/controllers/CreateEditContentController.php";
				$vcreateedit->del_page($_GET['delete']);
				$alert_success = true;
				$alert = "Odnośnik został usunięty.";
				require_once "{$config->APP_PATH}/views/admin/content_list.php";
			}elseif($_GET['del_menu_item']){
				
				require_once "{$config->APP_PATH}/controllers/MenuController.php";
				$aux_vmenu->del_menu_item($_GET['del_menu_item']);
				$alert_success = true;
				$alert = "Odnośnik został usunięty.";
				require_once "{$config->APP_PATH}/views/admin/menu_list.php";
			
			}elseif($_GET['edit_menu_item_pos']){
				
				require_once "{$config->APP_PATH}/controllers/MenuController.php";
				$aux_vmenu->menu_item_pos($_GET['edit_menu_item_pos'], $_GET['way']);
				$alert_success = true;
				$alert = "Zmiany zostały zapisane.";
				require_once "{$config->APP_PATH}/views/admin/menu_list.php";
			
			}elseif($_GET['menu']== 'create'){
				
				require_once "{$config->APP_PATH}/views/admin/menu.php";
				
			}elseif($_GET['edit_menu']){
				
				require_once "{$config->APP_PATH}/views/admin/menu.php";
				
			}elseif($_GET['page'] == "menu"){
				
				require_once "{$config->APP_PATH}/views/admin/menu_list.php";
				
			}elseif($_GET['page']== "users"){
				
				require_once "{$config->APP_PATH}/controllers/UserController.php";
				require_once "{$config->APP_PATH}/views/admin/user_list.php";
			
			}elseif($_GET['edit_user'] or $_GET['user'] == 'create'){
				require_once "{$config->APP_PATH}/controllers/UserController.php";
				require_once "{$config->APP_PATH}/views/admin/user.php";
				
			}elseif($_GET['delete_user']){
				
				require_once "{$config->APP_PATH}/controllers/UserController.php";
				$cusers = new UserController();
				$cusers->del_user($_GET['delete_user']);
				$alert_success = true;
				$alert = "Konto zostało usunięte.";
				require_once "{$config->APP_PATH}/views/admin/users_list.php";
				
			}else{
				require_once "{$config->APP_PATH}/controllers/SiteInfoController.php";
				require_once "{$config->APP_PATH}/views/admin/site_info.php";
			}	
		?>
	</div>

	<footer class="container-fluid text-center">
		<p>&copy; <?php echo date("Y"); ?> <?=$info{'site_name'}; ?> | Prosty MVC</p>
	</footer>
    </body>     
</html>  