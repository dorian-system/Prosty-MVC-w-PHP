<?php
require_once "controllers/MenuController.php";

function view_menu($parent_id = 0, $class = "nav navbar-nav"){
	global $v_menu_items;
	global $config;
	if ($v_menu_items){
	
		echo "<ul class='{$class}'>";
			foreach($v_menu_items as $item){
				if($item['parent_id'] == $parent_id){
					$active = ($_GET['id'] == $item['path'] ? "active" : null);
					echo "<li class='{$active}" . ($item['has_child'] ? " dropdown" : null) . "' >
							<a " . ($item['has_child'] ? "class='dropdown-toggle' data-toggle='dropdown'" : null) . " href='{$config->APP_PATH}/{$item['path']}' title='{$item['description']}'>
								{$item['title']}
								" . ($item['has_child'] ? "<span class='caret'></span></a>" : null) . "
							</a>";
						if ($item['id']) view_menu($item['id'], "dropdown-menu");			
					echo "</li>";	
				}
				
			}
		echo "</ul>";
	}
}

?>