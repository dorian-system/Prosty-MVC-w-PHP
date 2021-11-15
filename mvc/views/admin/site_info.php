<?php
$info = $csiteinfo->print_site_info();

?>
	<div class="form-group">
		<?php if($alert_success): ?>
			<div class="alert alert-success">
				<strong><span class="glyphicon glyphicon-ok-sign"></span> <?=$alert ?></strong>
			</div>
		<?php endif ?>
		<form method="post" >
			<legend>Podstawowe dane</legend>
			<div class="panel panel-default">
				<div class="panel-heading">Szczegóły witryny</div>
				<div class="panel-body">
					<!-- Site name -->
					<label for="site_name" >Nazwa witryny*</label>
					<input style="width:50%" class="form-control" type="text" placeholder="np. moja strona" name="site_name" value ="<?=$info['site_name'];?>" required />
					<br />
					<!-- Site slogan -->
					<label for="site_slogan">slogan</label>
					<input style="width:50%" class="form-control" type="text" placeholder="hasło strony" name="site_slogan" value ="<?=$info['site_slogan'];?>" />
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">Strona główna/błędu</div>
				<div class="panel-body">
					<!-- Home page -->
					<label for="home_page">Domyślna strona główna</label>
					<input style="width:50%" class="form-control" type="text" placeholder="ścieżka" name="home_page" value ="<?=$info['home_page'];?>" />
					<br />
					<!-- 404 content -->
					<label for="404_content">Domyślna strona błędu 404 (nie znaleziono strony)</label>
					<script type="text/javascript">
						WYSIWYG.attach('editor', full); // full featured setup 
					</script>
					<textarea name="404_content" id="editor" ><?=$info['404_content'];?></textarea>
				</div>
			</div>
			
			<!-- Save -->
			<div class="row">
				<div class="col-xs-12">
					<input class="btn btn-primary pull-right" type="submit" value="Zapisz" name="site_info" >
				</div>
			</div>
		</form>
	</div>