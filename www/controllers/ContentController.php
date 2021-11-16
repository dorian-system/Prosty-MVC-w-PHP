<?php
/**
 * Obsługuje akcje widoku artykułów
 * 
 * @package Content
 * @subpackage Controller
 */
require_once "models/ContentModel.php";
require_once "SiteInfoController.php";

class ContentController extends ContentModel {
	/**
     * Strona tekstowa
     * /site/content.php
     */
	function print_content($id){
		global $info;
		$res = $this->return_content($id);
		$row = mysqli_fetch_assoc($res);
		$page = array();		
		if ($row){
			foreach ($row as $key=>$value){
			$page[$key] = $value;
			}
		}else{
			$page["title"] = $info['404_title'];
			$page["content"] = $info['404_content'];
		}
		return $page;
	}
}
?>
