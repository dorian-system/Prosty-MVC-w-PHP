<?php
require_once "config/db.php";
require_once "controllers/SiteInfoController.php";

class ContentModel extends Db {
	function return_content ($id = NULL){
		global $info;
		if(is_numeric($id)){
			$sql = "select description, keywords, title, alt_title, created, lastmod, content, booksy_id, path from pages where id ={$id} and visible = '1' limit 1";
		}else{
			$sql = "select description, keywords, title, alt_title, created, lastmod, content, booksy_id, path from pages where path = '{$id}' and visible = '1' limit 1";
		}
		if(!$id){
			if($info['home_page']){
				$sql = "select description, keywords, title, alt_title, created, lastmod, content, booksy_id, path from pages where path='" . $info['home_page'] . "' limit 1";
			}else{
				$sql = "select description, keywords, title, alt_title, created, lastmod, content, booksy_id, path from pages where visible = '1' ORDER BY id limit 1";
			}		
		}				
		$result = $this->sql($sql);
		return $result;		
	}
}
?>
