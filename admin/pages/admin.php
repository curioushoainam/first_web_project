<?php 
require_once ('./class/Pagination.php'); 
require_once ('./class/Process_account.php');

$paging = new Pagination();
$process_account = new Process_account();

if(!empty($_GET['status']) && $_GET['status']){
	

	if ($_GET['status'] == 'all'){
		$config = array(
		    'current_page'  => isset($_GET['page']) ? $_GET['page'] : 1, // Trang hiện tại
		    'total_record'  => $process_account->total_accounts($_GET['status']), 		// Tổng số record
		    'limit'         => 5,				// limit
		    'link_full'     => '?view=admin&status=all&page={page}',// Link full có dạng như sau: domain/com/page/{page}
		    'link_first'    => '?view=admin&status=all',	// Link trang đầu tiên
		    'range'         => 9 				// Số button trang bạn muốn hiển thị 
		);
		$paging->init($config);		
		$accounts = $process_account->list_all_accounts($paging->get_config('start'), $paging->get_config('limit'));
	}	
	else if ($_GET['status'] == 'hidden'){		
		$config = array(
		    'current_page'  => isset($_GET['page']) ? $_GET['page'] : 1, // Trang hiện tại
		    'total_record'  => $process_account->total_accounts($_GET['status']), 		// Tổng số record
		    'limit'         => 5,				// limit
		    'link_full'     => '?view=admin&status=hidden&page={page}',// Link full có dạng như sau: domain/com/page/{page}
		    'link_first'    => '?view=admin&status=hidden',	// Link trang đầu tiên
		    'range'         => 9 				// Số button trang bạn muốn hiển thị 
		);
		$paging->init($config);		
		$accounts = $process_account->list_hidden_accounts($paging->get_config('start'), $paging->get_config('limit'));
	}
	else if ($_GET['status'] == 'deleted'){		
		$config = array(
		    'current_page'  => isset($_GET['page']) ? $_GET['page'] : 1, // Trang hiện tại
		    'total_record'  => $process_account->total_accounts($_GET['status']), 		// Tổng số record
		    'limit'         => 5,				// limit
		    'link_full'     => '?view=admin&status=deleted&page={page}',// Link full có dạng như sau: domain/com/page/{page}
		    'link_first'    => '?view=admin&status=deleted',	// Link trang đầu tiên
		    'range'         => 9 				// Số button trang bạn muốn hiển thị 
		);
		$paging->init($config);
		$accounts = $process_account->list_deleted_accounts($paging->get_config('start'), $paging->get_config('limit'));
	}
} else{		
	$config = array(
	    'current_page'  => isset($_GET['page']) ? $_GET['page'] : 1, // Trang hiện tại
	    'total_record'  => $process_account->total_accounts(), 		// Tổng số record
	    'limit'         => 5,				// limit
	    'link_full'     => '?view=admin&page={page}',// Link full có dạng như sau: domain/com/page/{page}
	    'link_first'    => '?view=admin',	// Link trang đầu tiên
	    'range'         => 9 				// Số button trang bạn muốn hiển thị 
	);
	$paging->init($config);		
	$accounts = $process_account->list_active_accounts($paging->get_config('start'), $paging->get_config('limit'));
}

?>

<div class="admin" id="admin">	
	<div class="container-fluid" id="btn-control">		
		<div class="col-sm-2">
			<a type="button" class="btn btn-success" id="add-service" href="?view=add_account"><span class="glyphicon glyphicon-plus"></span> Thêm quản trị</a>			
		</div>
		<div class="col-sm-4 dropdown">			
				<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" id="btn-select-active" href="#">Chọn thao tác <span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li><a href="?view=admin">Hiện danh sách hiển thị</a></li>
					<li><a href="?view=admin&status=all">Hiện toàn bộ danh sách</a></li>
					<li><a href="?view=admin&status=hidden">Hiện danh sách ẩn</a></li>
					<li><a href="?view=admin&status=deleted">Hiện danh sách bị xóa</a></li>					
				</ul>
			
		</div>	
		<div class="col-sm-offset-10">
			<form role="form" class="form-horizontal" action="" >
				<div class="form-group">
					<!-- <input type="text" class="search" name="ten" id="ten" placeholder="tên" >
					<select class="search" name="ma_nhom" id="ma_nhom">
						<option value="">-- chọn nhóm --</option>
						<option value="-- variable --">-- variable --</option>						
					</select>
					<select class="search" name="trang_thai" id="trang_thai">
						<option value="">-- trạng thái --</option>
						<option value="-- variable --">-- trang_thai --</option>						
					</select>
					<button type="submit" class="btn btn-primary btn-sm" name="btn-search" id="btn-search" href="#"><span class="glyphicon"></span> Search</button> -->
					<label>Số dòng trên trang</label>
					<select class="search" name="rpp" id="rpp">
						<option value="3">3</option>
						<option value="5">5</option>
						<option value="10">10</option>
						<option value="25">25</option>											
					</select>
				</div>
			</form>
		</div>
	</div>
	<div class="inform">
		<?php 
		if(!empty($_GET['status']) && $_GET['status']){
			if ($_GET['status'] == 'all'){
				echo '<p><i>* Toàn bộ danh sách</i></p>';
			}	
			else if ($_GET['status'] == 'hidden'){
				echo '<p><i>* Danh sách bị tắt</i></p>';
			}
			else if ($_GET['status'] == 'deleted'){
				echo '<p><i>* Danh sách đã bị xóa</i></p>';
			}
		} else{
			echo '<p><i>* Danh sách hiển thị</i></p>';
		}
		?>

	</div>	
    <div class="table-responsive">
	  <table class="table table-bordered table-striped table-hover">
	    <thead >
	    	<tr class="success">
	    		<th style="width: 3%"><input type="checkbox" name="" value=""></th>
	    		<th style="width: 3%; ">Mã</th>
	    		<th style="width: 15%; ">Họ tên</th>
	    		<th style="width: 15%">Tên đăng nhập</th>
	    		<th style="width: 15%">Email</th>
	    		<th style="width: 3%">Nhóm</th>
	    		<th style="width: 3%">Trạng thái</th>
	    		<th style="width: 15%; ">Ngày tạo</th>
	    		<th style="width: 15%; ">Ngày cập nhật</th>
	    		<th style="width: 8%">Todo</th>
	    	</tr>
	    </thead>
	    <tbody>
	    <?php 	    	
	    	foreach ($accounts as $account) {	    		
	    ?>	
	    	<tr>
	    		<td><input type="checkbox" name="" value=""></td>
	    		<td><?= $account->ma ?></td>
	    		<td style="text-align: left;"><?= $account->ho_ten ?></td>
	    		<td style="text-align: left;"><?= $account->ten_dang_nhap ?></td>
	    		<td style="text-align: left;"><?= $account->email ?></td>
	    		<td><?= $account->ma_nhom ?></td>
	    		<td><?= $account->trang_thai ?></td>
	    		<td><?= $account->ngay_tao ?></td> 
	    		<td><?= $account->ngay_cap_nhat ?></td>	    		
	    		<td>
	    			<a href="#" id="<?= $account->ma ?>" class="view_data" data-toggle="modal" data-target="#dataModal"><span class="glyphicon glyphicon-list-alt"></span></a>
	    			 | 
					<a href="?view=edit_account&id=<?= $account->ma ?>"><span class="glyphicon glyphicon-edit"></span></a>
					 | 
					<a href="?view=delete_account&id=<?= $account->ma ?>"><span class="glyphicon glyphicon-trash"></span></a>

	    		</td>
	    	</tr>
	    <?php 
	    	}
	    ?>		    	
	    </tbody>
	  </table>
	</div>
	<div class="col-sm-offset-4">	
		<!-- Pagination -->
		<?php			
			echo $paging->html();
		?>
		<!-- //Pagination -->
	</div>
</div>

<?php 
include_once ('./includes/modal.php');
?>

