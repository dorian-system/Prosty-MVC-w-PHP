<?php
require_once "{$config->APP_PATH}/config/db.php";

class MenuModel extends Db {	
	//Return menu for frontpage. Only if menu is visible 
	function return_menu_items($where = "where visible='1' "){
		$sql = "select mainMenu.*, 
		(select count(menuParent.id) from menu AS menuParent where menuParent.parent_id = mainMenu.id) as has_child 
		from menu AS mainMenu ". $where . "order by position";
		$res = $this->sql($sql); //podaiot na funkciu iz db.php
		return $res;
	}
	
	//Select last position of menu
	function select_last_pos() {
		$sql = "select position from menu order by position desc limit 1";	
		$res = $this->sql($sql);
		return $res;
	}
	
	function create($post){
		if($post['id'] == $post['parent_id']) $post['parent_id'] = 0;
		if ($post['id'] != null){
		$sql = "UPDATE menu SET parent_id='{$post['parent_id']}', title='{$post['title']}', 
		path='{$post['path']}', description='{$post['description']}', visible='{$post['visible']}', 
		position='{$post['position']}' WHERE id={$post['id']}";
		$editenable = true;
		}else{
			$sql = "insert into menu(parent_id, title, path, description, visible, position)
			values('{$post['parent_id']}','{$post['title']}','{$post['path']}','{$post['description']}','{$post['visible']}','{$post['position']}')";
		}		
		//echo "<textarea cols='100%' rows='20' readonly style='margin: 10px 0px; padding: 10px; background-color: blanchedalmond; width:97%'>";
		//	print ($sql);
		//echo "</textarea>";
	$this->sql($sql);	
	return true;	
	}
	
	function del_from_menu($id){
		$sql = "delete from menu where id ={$id} or parent_id={$id}";
		$this->sql($sql);
	}
	
	function update_item_pos($pos, $dow_pos){
		$sql = "UPDATE `menu` AS c1 JOIN `menu` c2 ON (c1.position = {$pos} AND c2.position = " . $dow_pos . ") SET c1.position = c2.position, c2.position = c1.position where c1.parent_id = c2.parent_id ";
		$this->sql($sql);
	}
}
?>
