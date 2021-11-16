<?php
/**
 * Klasa służąca do obsługi pobierania danych z bazy danych dla tabeli pages
 * 
 * @package Content
 * @subpackage Model
 */
require_once "config/db.php";
require_once "controllers/SiteInfoController.php";

class ContentModel extends Db {
	/**
     * Zwraca artykuł uwzględniającą dodatkowe parametry
     * int $id identyfikator artykuł
     * @return result obiekt
     */
	function return_content ($id = NULL){
		global $info;
		if(is_numeric($id)){
			$sql = "select description, keywords, title, created, lastmod, content, category, path from pages where id ={$id} and visible = '1' limit 1";
		}else{
			$sql = "select description, keywords, title, created, lastmod, content, category, path from pages where path = '{$id}' and visible = '1' limit 1";
		}
		if(!$id){
			if($info['home_page']){
				$sql = "select description, keywords, title, created, lastmod, content, category, path from pages where path='" . $info['home_page'] . "' limit 1";
			}else{
				$sql = "select description, keywords, title, created, lastmod, content, category, path from pages where visible = '1' ORDER BY id limit 1";
			}		
		}				
		$result = $this->sql($sql);
		return $result;		
	}
}
?>
