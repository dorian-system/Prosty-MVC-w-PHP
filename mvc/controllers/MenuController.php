<?php
require_once "{$config->APP_PATH}/models/MenuModel.php";

class MenuController extends MenuModel {	
	function print_menu_items($where){
		$res = $this->return_menu_items($where); //vozvrashaet sylku na resultat zaprosa
		while ($row = mysql_fetch_array($res)) {
			$mname[$row['id']]['parent_id'] = $row['parent_id'];
			$mname[$row['id']]['has_child'] = $row['has_child'];
			$mname[$row['id']]['id'] = $row['id'];
			$mname[$row['id']]['title'] = $row['title']; //zabivaem v masiv rezultat vipalnenie zaiavki
			$mname[$row['id']]['path'] = $row['path'];
			$mname[$row['id']]['description'] = $row['description'];
			$mname[$row['id']]['visible'] = $row['visible'];
			$mname[$row['id']]['position'] = $row['position'];
		}
		return $mname;
	}
	
	//Get New Position for menu item
	function return_menu_last_pos(){
		$res = $this->select_last_pos();
		$last = mysql_fetch_assoc($res);
		$new_pos = $last['position'] + 1;
		return $new_pos;
	}
	
	function post_data($post){
		foreach($post as $key=>$value){
			$aux_post[$key] = $value;		
		}
		$this->create($aux_post); //visilaem v bazu;	
	}
	
	function del_menu_item($id){
		$this->del_from_menu($id);
	}
	
	function menu_item_pos($pos, $way){
			if ($way == "down"){
				$pos_2 = $pos +1;
			}elseif($way == "up"){
				$pos_2 = $pos -1;
			}else return;
		
		$this->update_item_pos($pos, $pos_2);
	}
}


$aux_vmenu = new MenuController();
$v_menu_items = $aux_vmenu->print_menu_items("where visible='1' ");


?>
