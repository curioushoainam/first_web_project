<?php 
require_once ('./../config.php');
require_once ('./../class/database.php');
require_once ('./../class/Process_account.php');
require_once ('./../class/Validation.php');
$process_account = new Process_account();
$validation = new Validation();
$account = $process_account->getAccountInfo($_POST['ma']);

if(isset($_POST['ma']) && $_POST['ma']){
	$ma = $validation->test_input($_POST['ma']);
	if (!$validation->isNumber($ma)){
		exit ('Mã sản phẩm không hợp lệ'); 
	}
	$account = $process_account->getAccountInfo($ma);
	$output = '';
	$output .= '
		<div class="table-responsive">  
           <table class="table table-bordered">
           		<tr>
	    			<td>Mã quản lý</td>
	    			<td>'. $account->ma .'</td>
	    		</tr>
	    		<tr>
	    			<td>Tên đăng nhập</td>
	    			<td>'. $account->ten_dang_nhap .'</td>
	    		</tr>
	    		<tr>
	    			<td>Email</td>
	    			<td>'. $account->email .'</td>
	    		</tr>
	    		<tr>
	    			<td>Họ tên</td>
	    			<td>'. $account->ho_ten .'</td>
	    		</tr>
	    		<tr>
	    			<td>Địa chỉ</td>
	    			<td>'. $account->dia_chi .'</td>
	    		</tr>
	    		<tr>
	    			<td>Mã nhóm</td>
	    			<td>'. $account->ma_nhom .'</td>
	    		</tr>
	    		<tr>
	    			<td>Trạng thái</td>
	    			<td>'. $account->trang_thai .'</td>
	    		</tr>
	    		<tr>
	    			<td>Ngày tạo</td>
	    			<td>'. $account->ngay_tao .'</td>
	    		</tr>
	    		<tr>
	    			<td>Ngày cập nhật</td>
	    			<td>'. $account->ngay_cap_nhat .'</td>
	    		</tr> 
			</table>
		</div>';
	echo $output;
}
?>
