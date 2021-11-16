<?php
if($_GET['edit']){
	$editpage = new CreateEditContentController();
	$id = $_GET['edit'];
	$cont = $editpage->print_pageedit($id);
} else {$np = "New position";}
?>

<div class="form-group">
<form method="post">
	<legend>Zawartość</legend>
	<!-- id -->
	<input type = "hidden" name = "id" value = "<?=$id;?>" />
	
	<!-- title -->
	<label for="title" >Tytuł*</label>
	<input style="width:50%" class="form-control" type="text" placeholder="Tytuł" name="title" value ="<?=$cont['title'];?>" required />
	<em class="text-info">Użyć maksymalnie 60 znaków w tytule.</em>
	<br />
	<!-- Path -->
	<label for="path">Ścieżka*</label>
	<input style="width:50%" class="form-control" type="text" placeholder="Ścieżka" name="path" value ="<?=$cont['path'];?>" required />
	<br />
	<!-- Content -->
	<label for="content">Treść*</label>
	<script type="text/javascript">
		WYSIWYG.attach('editor', full); // full featured setup 
	</script>
	<textarea name="content" id="editor" ><?=$cont['content'];?></textarea>
	<br />
	<!-- Visible -->
	<label for="visible">Opcje publikacji</label>
	<select name="visible" class="form-control" style="width:auto" > 
		<option value ="1" <?php if ($cont['visible'] == 1) {echo "selected";}?>>Opublikowane</option>
		<option value ="0" <?php if ($cont['visible'] == 0) {echo "selected";}?>>Nieopublikowane</option>
	</select>
	<br />
	<!-- Category -->
	<label for="category">Kategoria</label>
	<input class="form-control" name="category"  value="<?=$cont['category'];?>" />
	<br />
	<!-- Description -->
	<label for="description">Opis</label>
	<textarea class="form-control" name="description" ><?=$cont['description'];?></textarea>
	<em class="text-info">Użyć maksymalnie 160 znaków w opisie.</em>
	<br />
	<!-- Keywords -->
	<label for="keywords">Słowa kluczowe</label>
	<textarea name="keywords" class="form-control" ><?=$cont['keywords'];?></textarea>	
	<br />
	<!-- Save -->
	<input class="btn btn-primary" type="submit" name="create" value="Zapisz" />
</form>
</div>
