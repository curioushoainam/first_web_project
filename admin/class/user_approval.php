<?php
require_once ('./../config.php'); 
require_once ('./../class/Database.php');
require_once ('./../class/User.php');
$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST['ma'], $_POST['res']) && $_POST['ma']){
		$result = $user->approveUser($_POST['ma'], $_POST['res']);
		if($result)
			echo json_encode(array('error'=>'0', 'msg'=>''));
		else 
			echo json_encode(array('error'=>'1', 'msg'=>'Lỗi connecting tới database'));

	} else {
		echo json_encode(array('error'=>'1', 'msg'=>'Lỗi dữ liệu'));
	}

}

?>