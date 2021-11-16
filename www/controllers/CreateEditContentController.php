<?php
/**
 * Obsługuje akcje widoku artykułów
 * 
 * @package Content
 * @subpackage Controller
 */
 
require_once "{$config->APP_PATH}/models/CreateEditContentModel.php";

class CreateEditContentController extends CreateEditContentModel {
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
     * /admin/content
	*/
	function post_data($post){
		foreach($post as $key=>$value){
			$aux_post[$key] = $this->clean_data($value);		
		}
		$this->create($aux_post);	
	}
	/**
     * Wyswietla liste dodanych artykułów
     * /admin/content_list
	*/
	function print_list($order = "desc") {
		$res = $this->list_pages($order);
		$cont = mysqli_fetch_all($res, MYSQLI_ASSOC);
		return $cont;	
	}
	/**
     * Wyswietla artykuł
     * /admin/content
	*/
	function print_pageedit($id){
		$res = $this->return_page_edit($id);
		$row = mysqli_fetch_assoc($res);
		return $row;	
	}
	/**
     * Usuwa artykuł
     * /admin/content_list
	*/
	function del_page($id){
		$this->delete_page($id);
	}
}
$vcreateedit = new CreateEditContentController();
?>
