<?php
/**
 * Klasa pomocnicza obsługująca bazę danych
 * 
 * @package Configuration
 */
 
$APP_PATH = dirname(dirname(__FILE__));
require_once "{$APP_PATH}/config/config.php"; 

class Db extends Configuration {

	private $connection;

	function __construct() {
		$this->open_connection();
	}

	private function open_connection() {
		$this->connection = mysqli_connect($this->db_host, $this->db_user, $this->db_pass);
	
		if(!$this->connection) {
			die("<div class='alert alert-danger'><strong>Połączenie z bazą danych nie powiodło się:</strong> ".mysqli_error($this->connection)."</div>");
		} else {
			$db_select = mysqli_select_db($this->connection, $this->db_name);
			if(!$db_select) {
				die("<div class='alert alert-danger'><strong>Połączenie z bazą danych nie powiodło się:</strong> ".mysqli_error($this->connection)."</div>");
			}
		}
	
		mysqli_query($this->connection, "set names utf8") or die("<div class='alert alert-danger'><strong>Błąd:</strong> Set names utf8 failed</div>");
	}

	public function sql($query){
		$result = mysqli_query($this->connection, $query);
		if (!$result) {
			die("<div class='alert alert-danger'><strong>Zapytanie do bazy danych nie powiodła się: </strong> ".mysqli_error($this->connection)."</div>");
		}
		return $result;
	}
}

$db = new Db();
?>