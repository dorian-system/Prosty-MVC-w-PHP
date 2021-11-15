<?php
require_once "{$config->APP_PATH}/models/SiteInfoModel.php";

class SiteInfoController extends SiteInfoModel {
	function print_site_info(){
		$res = $this->return_site_info();
		$row = mysql_fetch_assoc($res);
		return $row;	
	}
	
	function clean_data($str){
		$str = str_replace('"', '\"', $str);
		$str = str_replace("'", "\'", $str);
	return $str;
	}
	
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
