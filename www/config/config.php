<?php
    /**
	 * Konfiguracja bazy
	 * 
	 * @package Configuration
	*/

	require_once "debug.php";

	class Configuration extends Debug{
		function __construct(){
			$this->APP_PATH = dirname(dirname(__FILE__));
		}	
		var $APP_PATH;
		var $db_host = "localhost"; //nazwa hosta
		var $db_name = "01357044_mvc"; //database name
		var $db_user = "01357044_mvc"; //nazwa bazy danych
		var $db_pass = "pn9pg%vu3rO#"; //dhasło użytkownika bazy danych
		
		var $alert_danger = false; //alert błędu
	}

	$config = new Configuration();
?>
