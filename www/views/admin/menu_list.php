<?php
require_once "{$config->APP_PATH}/controllers/MenuController.php";

$v_menu_items_edit = $aux_vmenu->print_menu_items("");
?>

	<div class="table-scrol">  
	<legend>Lista odnośników</legend>
	<?php if($alert_success): ?>
		<div class="alert alert-success">
			<strong><span class="glyphicon glyphicon-ok-sign"></span> <?=$alert ?></strong>
		</div>
	<?php endif ?>
	<div class="btn-toolbar">
		<div class="btn-group">
			<a class="btn btn-primary" href="?menu=create"><i class="glyphicon glyphicon-plus"></i> Dodaj odnośnik</a>	
		</div>
	</div>
	<br />
	<div class="table-responsive"><!--this is used for responsive display in mobile and other devices-->  
		<?php if($v_menu_items_edit) : ?>
			<table class="table table-bordered table-hover table-striped" style="table-layout: fixed">  
			<thead>
				<tr>
					<th>Tytył</th>  
					<th>Ścieżka</th>  
					<th>Waga</th>  
					<th colspan="2" >Operacje</th> 
				</tr>  
			</thead>
			
			<?php
				function menu_item_pos($menu_id = 0, $tabs="-"){
					global $v_menu_items_edit;
					global $id;
					foreach($v_menu_items_edit as $item){
						if($item['parent_id'] == $menu_id){
							echo "<tr>";
							echo 	"<td><a href='/{$item['path']}'>{$tabs} {$item['title']}</a></td>
									<td>{$item['path']}</td>
									<td>
										<a href ='?edit_menu_item_pos={$item['position']}&way=up' ><i class='glyphicon glyphicon-arrow-up'></i>do góry</a>
										<a href ='?edit_menu_item_pos={$item['position']}&way=down' ><i class='glyphicon glyphicon-arrow-down'></i>na dół</a>
									</td>
									<td><a href ='?edit_menu={$item['id']}' ><button class='btn btn-warning'><i class='glyphicon glyphicon-edit'></i> Edytuj</button></a></td>
									<td><a onclick=\"return confirm('Czy na pewno chcesz usunąć {$item['title']}?')\" href ='?del_menu_item={$item['id']}' ><button class='btn btn-danger'><i class='glyphicon glyphicon-trash'></i> Usuń</button></a></td>";
							echo "</tr>";			
							menu_item_pos($item['id'], sprintf('%s %s', $tabs, "-"));
						}
					}
				}
				menu_item_pos();
			?>			
			</table>
		<?php else : ?>
			<div class="alert alert-info">
				<strong>Brak odnośników.</strong> Aby dodać odnośnik, kliknij na przycisk "Dodaj odnośnik".
			</div>
		<?php endif ?>
    </div>  
</div>
