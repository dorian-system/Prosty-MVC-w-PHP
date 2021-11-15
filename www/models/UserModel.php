<?php
require_once "{$config->APP_PATH}/config/db.php";

class UserModel extends Db {	
	function return_users($user_name, $user_pass){
		$sql = "select * from users WHERE user_name='{$user_name}' AND user_pass='" . md5($user_pass) . "'";
		$result = $this->sql($sql);
		return $result;	
	}
	
	function select_users($where = ""){
		$sql = "select * from users " . $where;
		$result = $this->sql($sql);
		return $result;	
	}
	
	function create($post){
		global $config;
		if ($post['id'] != null){
			$user = $this->select_users("where (user_name='{$post['user_name']}' OR user_email = '{$post['user_email']}') AND id <> '{$post['id']}'");
			$row = mysql_fetch_assoc($user);
			if ($row) {
				$config->alert_danger = true;
				return false;
			}else{
				$sql = "UPDATE users SET user_name='{$post['user_name']}', user_pass='" . md5($post['user_pass']) . "', 
				user_email='{$post['user_email']}' WHERE id={$post['id']}";
			}
		}else{
			$sql = "INSERT INTO users (user_name, user_pass, user_email)
			SELECT * FROM (SELECT '{$post['user_name']}', '" . md5($post['user_pass']) . "', '{$post['user_email']}') AS tmp
			WHERE NOT EXISTS (
				SELECT user_name, user_email FROM users WHERE user_name = '{$post['user_name']}' OR user_email = '{$post['user_email']}'
			) LIMIT 1;";
		}
	$this->sql($sql);
	return true;	
	}
	
	function del_from_users($id){
		$sql = 'delete from users where id ='.$id;
		$this->sql($sql);
	}
} 

?>