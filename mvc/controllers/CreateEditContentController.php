<?php
require_once "{$config->APP_PATH}/models/CreateEditContentModel.php";

class CreateEditContentController extends CreateEditContentModel {
	function clean_data($str){
	/*if(get_magic_quotes_gpc() == 1){
		$str = str_replace('\"', "&quot;", $str);
		$str = str_replace("\'", "&#039;", $str);
		$str = str_replace('<', "&lt;", $str);	
		$str = str_replace('>', "&gt;", $str);
	} else {
		$str = htmlspecialchars($str, ENT_QUOTES, "UTF-8", false);	
	}*/
	$str = str_replace('"', '\"', $str);
	$str = str_replace("'", "\'", $str);
	return $str;
	}
	
	function post_data($post){
		foreach($post as $key=>$value){
			$aux_post[$key] = $this->clean_data($value);		
		}
		$this->create($aux_post); //visilaem v bazu;	
	}
	
	function print_list($order = "desc") {
		$res = $this->list_pages($order); //vozvrashaet sylku na resultat zaprosa
		while ($row = mysql_fetch_array($res)) {
			$cont[$row['id']]['id'] = $row['id'];
			$cont[$row['id']]['path'] = $row['path'];
			$cont[$row['id']]['title'] = $row['title'];
			$cont[$row['id']]['alt_title'] = $row['alt_title'];
			$cont[$row['id']]['content'] = $row['content'];
			$cont[$row['id']]['category'] = $row['category'];
			$cont[$row['id']]['image'] = $row['image'];
			$cont[$row['id']]['alt_description'] = $row['alt_description'];
			$cont[$row['id']]['description'] = $row['description'];
			$cont[$row['id']]['created'] = $row['created']; //zabivaem v masiv rezultat vipalnenie zaiavki
			$cont[$row['id']]['lastmod'] = $row['lastmod'];
			$cont[$row['id']]['visible'] = $row['visible'];
		}
		return $cont;	
	}
	
	function print_pageedit($id){
		$res = $this->return_page_edit($id);
		$row = mysql_fetch_assoc($res);
		return $row;	
	}
	function del_page($id){
		$this->delete_page($id);
	}
}
$vcreateedit = new CreateEditContentController();
?>
