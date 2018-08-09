<?php 
require_once ('./class/Permission.php');
$permission = new Permission();

if(isset($_SESSION['msg']) && $_SESSION['msg']){
	$msg = $_SESSION['msg']; 
	unset($_SESSION['msg']); 
} else
	$msg = '';
?>

<div class="admin_asign grid" id="admin">
	<div class="row" align="center" style="color: blue;"><i><?= $msg ?></i></div>
	<h4><b>Danh sách người dùng</b></h4>	
	<hr>
	<div class="row">
		<div class="col-md-8 col-md-offset-2 table-responsive">
		  <table class="table table-bordered table-striped table-hover">
		    <thead >
		    	<tr class="success">	    		
		    		<th >Mã</th>
		    		<th >Họ tên</th>
		    		<th >Tên đăng nhập</th>	    		
		    		<th >Mã nhóm</th>
		    		<th >Trạng thái</th>	    		
		    		<th >Todo</th>
		    	</tr>
		    </thead>
		    <tbody>
		    <?php 	  
		    	$users = $permission->readUserList();  	
		    	foreach ($users as $user){
		    		$ma = isset($user->ma) ? $user->ma : '';
		    		$ho_ten = isset($user->ho_ten) ? $user->ho_ten : '';
		    		$ten_dang_nhap = isset($user->ten_dang_nhap) ? $user->ten_dang_nhap : '';
		    		$ma_nhom = isset($user->ma_nhom) ? $user->ma_nhom : '';
		    		$trang_thai = isset($user->trang_thai) ? $user->trang_thai : '';
		    		$ma = isset($user->ma) ? $user->ma : '';
		    ?>	
		    	<tr>	    		
		    		<td><?= $ma ?></td>
		    		<td style="text-align: left;"><?= $ho_ten ?></td>
		    		<td style="text-align: left;"><?= $ten_dang_nhap ?></td>
		    		<td><?= $ma_nhom ?></td>
		    		<td><?= $trang_thai ?></td>	    		   		
		    		<td><a href="?view=adminAssign_grant&id=<?= $ma ?>"><span class="fa fa-user-circle fa-2x" title="Cấp quyền"></span></a>
		    			  |  
		    			<a href="?view=adminAssign_revoke&id=<?= $ma ?>"><span class="fa fa-user-times fa-2x" title="Thu hồi"></span></a>

		    		</td>
		    	</tr>
		    <?php 
		    	}
		    ?>		    	
		    </tbody>
		  </table>
		</div>
	</div>

	<h4><b>Danh sách người dùng đã được phân quyền</b></h4>	
	<hr>
	<div class="col-md-4 col-md-offset-4 row">
		<div class="table-responsive">
		  <table class="table table-bordered table-striped table-hover">
		    <thead >
		    	<tr class="success">	    		
		    		<th >Mã quản trị</th>		    			    		
		    		<th >Ngày tạo</th>
		    	</tr>
		    </thead>
		    <tbody>
		    <?php
		    	$permlist = $permission->listGranted();	    	
		    	foreach ($permlist as $perm){
		    		$ma_quan_tri = isset($perm->ma_quan_tri) ? $perm->ma_quan_tri : '';		    		
		    		$ngay_tao = isset($perm->ngay_tao) ? $perm->ngay_tao : '';
		    ?>	
		    	<tr>	    		
		    		<td><?= $ma_quan_tri ?></td>		    		
		    		<td><?= $ngay_tao ?></td>    
		    	</tr>
		    <?php 
		    	}
		    ?>		    	
		    </tbody>
		  </table>
		</div>
	</div>
</div>