<?php
	$cusers = new UserController();
	$list = $cusers->list_users();
?>
	<div class="table-scrol">  
	<legend>Lista Użytkowników</legend>
	<?php if($alert_success and !$config->alert_danger): ?>
		<div class="alert alert-success">
			<strong><span class="glyphicon glyphicon-ok-sign"></span> <?=$alert ?></strong>
		</div>
	<?php endif ?>
	<?php if($config->alert_danger): ?>
		<div class="alert alert-danger">
			<strong><span class="glyphicon glyphicon-remove-sign"></span> Błąd! Musi zostać przynajmniej jeden użytkownik!</strong>
		</div>
	<?php endif ?>
	<div class="btn-toolbar">
		<div class="btn-group">
			<a class="btn btn-primary" href="?user=create"><i class="glyphicon glyphicon-plus"></i> Dodaj użytkownika</a>	
		</div>
	</div>
	<br />
	<div class="table-responsive"><!--this is used for responsive display in mobile and other devices-->  
		<table class="table table-bordered table-hover table-striped" style="table-layout: fixed">  
			<thead>
				<tr>
					<th>ID</th>  
					<th>Nazwa</th>  
					<th>E-mail</th>  
					<th colspan="2">Operacje</th> 
				</tr>  
			</thead>			
			<?php foreach($list as $item) : ?>
				<tr>
					<td><?=$item['id'];?></td>
					<td><?=$item['user_name'];?></td>
					<td><?=$item['user_email'];?></td>
					<td><a href ='?edit_user=<?=$item['id']; ?>' ><button class='btn btn-warning'><i class='glyphicon glyphicon-edit'></i> Edytuj</button></a></td>
					<td><a onclick="return confirm('Czy na pewno chcesz usunąć <?=$item['user_name'];?>?')" href ='?delete_user=<?=$item['id']; ?>' ><button class='btn btn-danger'><i class='glyphicon glyphicon-trash'></i> Usuń</button></a></td>
					
				</tr>
			<?php endforeach; ?>	
		</table>
    </div>  
</div>
