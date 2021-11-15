<?php
require_once "{$config->APP_PATH}/controllers/MenuController.php";

$v_menu_items_edit = $aux_vmenu->print_menu_items("");

if($_GET['edit_menu']){
	//esli najimaem na edit
	$id = $_GET['edit_menu'];
	$parent_id = $v_menu_items_edit[$id]['parent_id'];
	$last = $v_menu_items_edit[$id]['position'];
}else{
	$np = "Żaden rodzic"; 
	$last = $aux_vmenu->return_menu_last_pos(); 
}
?>

<div class="form-group">
<form method="post">
	<legend>Menu</legend>
	<!-- id -->
	<input type = "hidden" name = "id" value = "<?=$id;?>" />
	<!-- Position -->
	<input type="hidden" name="position" value ="<?=$last; ?>" />
	
	<!-- title -->
    <label for="title" >Tytuł*</label>
	<input style="width:50%" class="form-control" type="text" placeholder="Tytuł" name="title" value ="<?=$v_menu_items_edit[$id]['title'];?>" required />
	<em class="text-info">Użyć maksymalnie 60 znaków w tytule.</em>
	<br />
	<!-- Path -->
	<label for="path">Ścieżka</label>
	<input style="width:50%" class="form-control" type="text" placeholder="Ścieżka" name="path" value ="<?=$v_menu_items_edit[$id]['path'];?>" required />
	<br />
	<!-- Visible -->
	<label for="visible">Opcje publikacji</label>
	<select name="visible" class="form-control" style="width:auto" > 
		<option value ="1" <?php if ($v_menu_items_edit[$id]['visible'] == 1) {echo "selected";}?>>Opublikowane</option>
		<option value ="0" <?php if ($v_menu_items_edit[$id]['visible'] == 0) {echo "selected";}?>>Nieopublikowane</option>
	</select>
	<br />
	<!-- description -->
	<label for="description">Opis</label>
	<textarea class="form-control" name="description" ><?=$v_menu_items_edit[$id]['description'];?></textarea>
	<em class="text-info">Użyć maksymalnie 160 znaków w opisie.</em>
	<br />
	<!-- Menu parent -->
	<label for="parent_id">Nadrzędny link</label>
	<select name="parent_id" class="form-control" style="width:auto" >
		<?php
					function menu_item_pos($menu_id = 0, $tabs="-"){
						global $v_menu_items_edit;
						global $id;
						global $parent_id;
						foreach($v_menu_items_edit as $item){
							if($item['parent_id'] == $menu_id){
								
								if ($id){
									if ($item['id'] == $parent_id) {
										$sel = "selected";
									}elseif($parent_id ==0 and $item['id'] == $id){
										$sel = "selected";
										$item['title'] = "Żaden rodzic";
									}else{
										$sel = "";
									}
								}
								
								echo "<option value='" . $item['id'] . "' " . $sel . " >" . $tabs . $item['title'] . "</option>";
								menu_item_pos($item['id'], sprintf('%s %s', $tabs, "-"));
							}
						}
					}
					menu_item_pos();
					
					if($np) echo "<option selected value='0'> - " . $np . "</option>";
		?>			
	</select>
	<br />
	<!-- Save -->
	<input type="submit" name="post_menu" class="btn btn-primary" value="Zapisz" />
</form>
</div>
