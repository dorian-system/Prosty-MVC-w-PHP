<?php
$cusers = new UserController();

if($_GET['edit_user']){
	$id = $_GET['edit_user'];
	$user = $cusers->list_users("where id=" . $id);
	
}else{
	
}
?>

<div class="form-group">
<?php if($config->alert_danger): ?>
	<div class="alert alert-danger">
		<strong><span class="glyphicon glyphicon-remove-sign"></span> Nazwa użytkownika lub adres e-mail już jest używany.</strong>
	</div>
<?php endif ?>
<form method="post">
	<legend>Użytkownik</legend>
	<!-- id -->
	<input type = "hidden" name = "id" value = "<?=$id;?>" />
	
	<!-- Name -->
    <label for="user_name" >Nazwa*</label>
	<input style="width:50%" class="form-control" type="text" placeholder="Nazwa" name="user_name" value ="<?=$user[$id]['user_name'];?>" required />
	<br />
	<!-- Pass -->
    <label for="user_pass" >Hasło*</label>
	<input style="width:50%" class="form-control" type="password" placeholder="Hasło" name="user_pass" value ="" required />
	<br />
	<!-- Path -->
	<label for="user_email">E-mail*</label>
	<input style="width:50%" class="form-control" type="email" placeholder="E-mail" name="user_email" value ="<?=$user[$id]['user_email'];?>" required />
	<br />
	<!-- Save -->
	<div class="row">
		<div class="col-xs-12">
			<input type="submit" name="post_user" class="btn btn-primary pull-right" value="Zapisz" />
		</div>
	</div>
	
</form>
</div>
