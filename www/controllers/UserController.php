<?php
/**
 * Obsługuje akcje użytkownika
 * 
 * @package User
 * @subpackage Controller
 */
require_once "{$config->APP_PATH}/models/UserModel.php";

class UserController extends UserModel {
	/**
     * Wyswietla użytkownika
     * /admin/user
	*/
	function print_users($user_name, $user_pass){
		$res = $this->return_users($user_name, $user_pass);
		$row = mysqli_fetch_assoc($res);
		return $row;	
	}
	
	/**
     * Wyswietla użytkowników
     * /admin/user_list
	*/
	function list_users($where = ""){
		$res = $this->select_users($where);
		$list_users = mysqli_fetch_all($res, MYSQLI_ASSOC);
		return $list_users;		
	}
	
	/**
     * Czyszczenie zmiennej $_POST
	*/
	function post_data($post){
		foreach($post as $key=>$value){
			$aux_post[$key] = $value;		
		}
		$this->create($aux_post);
	}
	
	/**
     * Usuwa użytkownika
     * /admin/user_list
	*/
	function del_user($id){
		global $config;
		$users = $this->list_users("WHERE id <> " . $id);
		
		if($users){
			$this->del_from_users($id);
		}else{
			$config->alert_danger = true;
			return false;
		}
	}
}
?>
