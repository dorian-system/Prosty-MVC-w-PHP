<?php
require_once "{$config->APP_PATH}/models/UserModel.php";

class UserController extends UserModel {
	
	function print_users($user_name, $user_pass){
		$res = $this->return_users($user_name, $user_pass);
		$row = mysql_fetch_assoc($res);
		return $row;	
	}
	
	function list_users($where = ""){
		$res = $this->select_users($where);
		while ($row = mysql_fetch_array($res)) {
			$cont[$row['id']]['id'] = $row['id'];
			$cont[$row['id']]['user_name'] = $row['user_name'];
			$cont[$row['id']]['user_pass'] = $row['user_pass'];
			$cont[$row['id']]['user_email'] = $row['user_email'];
		}
		return $cont;		
	}
	
	function post_data($post){
		foreach($post as $key=>$value){
			$aux_post[$key] = $value;		
		}
		$this->create($aux_post); //visilaem v bazu;	
	}
	
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
