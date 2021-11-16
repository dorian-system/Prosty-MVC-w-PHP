<?php
/**
 * Klasa służąca do obsługi pobierania danych z bazy danych dla tabeli menu
 * 
 * @package Menu
 * @subpackage Model
 */
 
require_once "{$config->APP_PATH}/config/db.php";

class MenuModel extends Db {	
	
	/**
     * Zwraca listę menu uwzględniającą dodatkowe parametry
     * string $where
     * @return res tablica obiektów
     */
	function return_menu_items($where = "where visible='1' "){
		$sql = "select mainMenu.*, 
		(select count(menuParent.id) from menu AS menuParent where menuParent.parent_id = mainMenu.id) as has_child 
		from menu AS mainMenu ". $where . "order by position";
		$res = $this->sql($sql);
		return $res;
	}
	
	/**
     * Zwraca ostatnia pozycja menu
     * @return res obiekt
     */
	function select_last_pos() {
		$sql = "select position from menu order by position desc limit 1";	
		$res = $this->sql($sql);
		return $res;
	}
	
	 /**
     * Tworzy menu
     * array $post
     */
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
		$this->sql($sql);	
		return true;	
	}
	
	/**
     * Usuwa menu
     * int $id identyfikator menu
     */
	function del_from_menu($id){
		$sql = "delete from menu where id ={$id} or parent_id={$id}";
		$this->sql($sql);
	}
	
	/**
     * Aktualizuje pozycji menu
     * int $pos pozycja menu
	 * int $dow_pos nowa pozycja
	*/
	function update_item_pos($pos, $dow_pos){
		$sql = "UPDATE `menu` AS c1 JOIN `menu` c2 ON (c1.position = {$pos} AND c2.position = " . $dow_pos . ") SET c1.position = c2.position, c2.position = c1.position where c1.parent_id = c2.parent_id ";
		$this->sql($sql);
	}
}
?>
