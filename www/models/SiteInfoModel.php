<?php
/**
 * Klasa służąca do obsługi pobierania danych z bazy danych dla tabeli site_info
 * 
 * @package SiteInfo
 * @subpackage Model
 */
require_once "{$config->APP_PATH}/config/db.php";

class SiteInfoModel extends Db {
	/**
     * Zwraca informacje o stronie
     * @return result obiekt
     */
	function return_site_info(){
		$sql = "select * from site_info";
		$result = $this->sql($sql);
		return $result;	
	}
	
	/**
     * Aktualizuje informacje o stronie
	 * array $post
	*/
	function update_site_info($post){
		$sql = "UPDATE site_info SET site_name='{$post['site_name']}', site_slogan='{$post['site_slogan']}', 
				home_page='{$post['home_page']}', 404_content='{$post['404_content']}',
				g_analytics ='{$post['g_analytics']}'";
		$this->sql($sql);	
		return true;	
	}
} 
?>