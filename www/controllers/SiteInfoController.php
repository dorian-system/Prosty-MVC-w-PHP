<?php
/**
 * Obsługuje akcje informacja o stronie
 * 
 * @package SiteInfo
 * @subpackage Controller
 */
 
require_once "{$config->APP_PATH}/models/SiteInfoModel.php";

class SiteInfoController extends SiteInfoModel {
	/**
     * Wyswietla informacja o stronie
     * /admin/site_info
	*/
	function print_site_info(){
		$res = $this->return_site_info();
		$row = mysqli_fetch_assoc($res);
		return $row;	
	}
	
	/**
     * Czyszczenie zmiennej $_POST
	*/
	function clean_data($str){
		$str = str_replace('"', '\"', $str);
		$str = str_replace("'", "\'", $str);
	return $str;
	}
	
	/**
     * Przesyła dane z formularza POST do bazy
     * /admin/site_info
	*/
	function post_data($post){
		foreach($post as $key=>$value){
			$aux_post[$key] = $this->clean_data($value);		
		}
		$this->update_site_info($aux_post);
	}
}
$csiteinfo = new SiteInfoController();
$info = $csiteinfo->print_site_info();
?>
