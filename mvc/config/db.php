<?php
$APP_PATH = dirname(dirname(__FILE__));
require_once "{$APP_PATH}/config/config.php"; 

class Db extends Configuration {

private $connection;

function __construct() {
	$this->open_connection();
}

	private function open_connection() {
		$this->connection = mysql_connect($this->db_host, $this->db_user, $this->db_pass);
	
		if(!$this->connection) {
			die("<div class='alert alert-danger'><strong>Połączenie z bazą danych nie powiodło się:</strong> ".mysql_error()."</div>");
		} else {
			$db_select = mysql_select_db($this->db_name);
			if(!$db_select) {
				die("<div class='alert alert-danger'><strong>Połączenie z bazą danych nie powiodło się:</strong> ".mysql_error()."</div>");
			}
		}
	
		mysql_query("set names utf8") or die("<div class='alert alert-danger'><strong>Błąd:</strong> Set names utf8 failed</div>");
	}

	public function sql($query){
		$result = mysql_query($query, $this->connection);
		if (!$result) {
			die("<div class='alert alert-danger'><strong>Zapytanie do bazy danych nie powiodła się: </strong> ".mysql_error()."</div>");
		}
		return $result;
	}
}

$db = new Db();
?>