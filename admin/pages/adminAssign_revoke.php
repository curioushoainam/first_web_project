<?php

if(isset($_GET['id']) && $_GET['id']){
	if(isset($_POST['delete']) && $_POST['delete']){
		require_once ('./class/Permission.php');
		$permission = new Permission();

		$result = $permission->revoke($_GET['id']);
		if($result)
			$_SESSION['msg'] = 'Xóa thành công phân quyền của id => '.$_GET['id'];
		else 
			$_SESSION['msg'] = 'Xóa thất bại phân quyền của id => '.$_GET['id'];

		chuyentrang('?view=adminAssign');
	}	
}

?>

<div align="center">
	<form action="" method="post">
		<fieldset>
			<h4><b>Bạn có muốn xóa phân quyền <span style="color: red">id #<?= $_GET['id']?></span> không?<b></h4>
			<button class="btn btn-success" name="delete" value="true">Delete</button>
			<a href="?view=adminAssign"><input type="button" class="btn btn-default" value="Cancel"></a>
		</fieldset>
	</form>
	
</div>