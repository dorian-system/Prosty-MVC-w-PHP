<?php
	//sesja zaczyna się tutaj
    session_start();
	//ścieżka do katalogu configuracji
	require_once "../config/config.php";
	
	//kontroler użytkownika
	require_once "../controllers/UserController.php";
    $cusers = new UserController();
	  
    if(isset($_POST['login']))  
    {  
		$users = $cusers->print_users($_POST['name'], $_POST['pass']);
        if($users['user_name'] and $users['user_pass'] and $users['user_email']){  
            $_SESSION['email']= $users['user_email'];
			$_SESSION['login_key']= rand();
			echo "<script>window.open('index.php','_self')</script>";
		}else{  
		  $notify = "<div class='alert alert-danger'><strong>Błąd! </strong>Nazwa lub hasło jest nieprawidłowe!</div>";
        }  
    }

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

    </head>      
    <body class="login-page" >        
    <div class="container" style="padding-top:20px" >  
        <div class="row">  
            <div class="col-md-4 col-md-offset-4">  
                <div class="login-panel panel panel-primary">  
						<div class="panel-heading">  
                        <h3 class="panel-title">Zaloguj</h3>  
						</div>  
						<div class="panel-body">
							<?php if(isset($notify)) echo $notify ?>
							<form role="form" method="post" action="login.php">  
								<fieldset>  
									<div class="form-group"  >  
										<input required class="form-control" placeholder="Nazwa" name="name" type="name" autofocus>  
									</div>  
									<div class="form-group">  
										<input required class="form-control" placeholder="Hasło" name="pass" type="password" value="">  
									</div>  
									<input class="btn btn-lg btn-default btn-block" type="submit" value="Zaloguj" name="login" > 
								</fieldset>  
							</form>
						</div>
                </div>
            </div>  
        </div> 
    </div>      
    </body> 
</html>