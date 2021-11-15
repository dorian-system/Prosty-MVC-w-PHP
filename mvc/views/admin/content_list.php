<?php
$aux_list = new CreateEditContentController();
$list = $aux_list->print_list();
?>

	<div class="table-scrol">  
	<legend>Zawartość</legend>
	<?php if($alert_success): ?>
		<div class="alert alert-success">
			<strong><span class="glyphicon glyphicon-ok-sign"></span> <?=$alert ?></strong>
		</div>
	<?php endif ?>
	<div class="btn-toolbar">
		<div class="btn-group">
			<a class="btn btn-primary" href="?page=create"><i class="glyphicon glyphicon-plus"></i> Dodaj treść</a>	
		</div>
	</div>
	<br />
	<div class="table-responsive"><!--this is used for responsive display in mobile and other devices-->  
		<?php if($list): ?>
			<table class="table table-bordered table-hover table-striped" style="table-layout: fixed">  
				<thead>
					<tr>
						<th>Tytył</th>  
						<th>Status</th>
						<th>Uaktualniono</th>
						<th>Kategoria</th>
						<th colspan="2">Operacje</th> 
					</tr>  
				</thead>
				<?php foreach($list as $item) : ?>
					<tr>
						<td><a href ='/<?=$item['path']; ?>' ><?=$item['title'];?></a></td>
						<td><?php if($item['visible'] == 1) echo "Opublikowane"; else echo "Nieopublikowane"; ?></td>
						<td><?php if($item['lastmod'] == "0000-00-00") echo $item['created']; else echo $item['lastmod'];  ?></td>
						<td><?=$item['category'];?></td>
						<td><a href ='?edit=<?=$item['id']; ?>' ><button class='btn btn-warning'><i class='glyphicon glyphicon-edit'></i> Edytuj</button></a></td>
						<td><a onclick="return confirm('Czy na pewno chcesz usunąć <?=$item['title'];?>?')" href ='?delete=<?=$item['id']; ?>' ><button class='btn btn-danger'><i class='glyphicon glyphicon-trash'></i> Usuń</button></a></td>
					</tr>
				<?php endforeach; ?>		
			</table>
		<?php else : ?>
			<div class="alert alert-info">
				<strong>Brak zawartości.</strong> Aby dodać zawartość, kliknij na przycisk "Dodaj treść".
			</div>
		<?php endif ?>
    </div>  
</div>
<script type="text/javascript">
	document.getElementById("navbar-nav").childNodes[9].className = "active";
</script>