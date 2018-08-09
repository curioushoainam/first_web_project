<?php 
if(isset($_GET['id']) && $_GET['id']){
	require ('./class/Permission.php');
	$permission = new Permission();

	$result = $permission->revoke($_GET['id']);
	if($result)
		$_SESSION['msg'] = 'Xóa thành công phân quyền của id => '.$_GET['id'];
	else 
		$_SESSION['msg'] = 'Xóa thất bại phân quyền của id => '.$_GET['id'];

	chuyentrang('?view=admin_assign');
}

?>