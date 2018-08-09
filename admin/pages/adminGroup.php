<?php 
require_once ('./class/DatabaseFuncs.php');

//$paging = new Pagination();
$validation = new Validation();
$databaseFuncs = new DatabaseFuncs();
$input = array(	
	'ten'=>NULL,	
	'trang_thai'=>NULL,
	'ngay_cap_nhat'=>NULL	
);
$feedback = '';
if ($_SERVER["REQUEST_METHOD"] == "POST"){	
	if(isset($_POST['edit']) && $_POST['edit'] && isset($_GET['id']) && $_GET['id']){		
		$id = $validation->test_input($_POST['edit']);

		if(!(empty($_POST['ten'.$id]) && $_POST['ten'.$id] != 0)){
			$input['ten'] = $validation->test_input($_POST['ten'.$id]);
		}
		
		if(!(empty($_POST['trang_thai'.$id]) && $_POST['trang_thai'.$id] != 0)){
			$input['trang_thai'] = $validation->test_input($_POST['trang_thai'.$id]);
		}

		$input['ngay_cap_nhat'] = date('Y-m-d H:i:s');			
		$result = $databaseFuncs->update('admin_group',$input,array('ma'=>$id));
		if($result)			
			chuyentrang('?view=adminGroup');
		else 
			$feedback = '<h4 style="color:red"><i>Cập nhật vào database thất bại</i></h4>';
	}

	if(isset($_POST['delete']) && $_POST['delete'] && isset($_GET['id']) && $_GET['id']){
		$id = $validation->test_input($_POST['delete']);
		$result = $databaseFuncs->update('admin_group',array('trang_thai'=>2,'ngay_cap_nhat'=>date('Y-m-d H:i:s')),array('ma'=>$id));
		if($result)			
			chuyentrang('?view=adminGroup');
		else 
			echo '<h4 style="color:red"><i>Xóa #id=>'.$id.' thất bại</i></h4>';
	}

	if(isset($_POST['add_group']) && $_POST['add_group']){
		$databaseFuncs->create('admin_group',array('ten'=>'',
														'trang_thai'=>1,
														'ngay_tao'=>date('Y-m-d H:i:m'),
														'ngay_cap_nhat'=>NULL	
														));
		$lastID = $databaseFuncs->getLastId();
		chuyentrang('?view=adminGroup&status=edit&id='.$lastID);
	}
}

$data = $databaseFuncs->read('admin_group',array('*'));
?>

<div class="admin_group" id="admin_group">	
	<div class="text-center"><?= $feedback ?></div>
	<div class="container-fluid" id="btn-control">		
		<div class="col-sm-2">
			<form action="" method="post">
				<button type="submit" class="btn btn-success" id="add-service" name="add_group" value="true"><span class="glyphicon glyphicon-plus"></span> Thêm group</button>			
			</form>
		</div>
	</div>
	<div class="inform">
		<?php 		
		?>
	</div>	
    <div class="table-responsive edit_table">
	  <table class="table table-bordered table-striped table-hover">
	    <thead >
	    	<tr class="success">	<!-- style="width: 15%" -->
	    		<th>Todo</th>	    		
	    		<th>Mã</th>	
	    		<th>Tên</th>
	    		<th>Trạng thái</th>
	    		<th>Ngày tạo</th>
	    		<th>Ngày cập nhật</th>
	    		<th>Xác nhận</th>
	    	</tr>
	    </thead>
	    <tbody>
	    <?php 	    	
	    	foreach ($data as $row) {
		    	$ma = isset($row->ma) ? $row->ma : '';    		
		    	$ten = isset($row->ten) ? $row->ten : '';    		
		    	$trang_thai = isset($row->trang_thai) ? $row->trang_thai : '';    		
		    	$ngay_tao = isset($row->ngay_tao) ? $row->ngay_tao : '';    		
		    	$ngay_cap_nhat = isset($row->ngay_cap_nhat) ? $row->ngay_cap_nhat : '';

		    	$readonly = ' readonly ';
		    	$hide = ' hidden ';
		    	$disable = 'disabled';
		    	$name = '';
		    	$button = '';
		    	if(isset($_GET['id'], $_GET['status']) && $_GET['id'] && $_GET['status']){
		    		if($ma == $_GET['id']){
		    			$readonly = '';
		    			$hide = '';
		    		}
		    		if($_GET['status'] == 'edit'){
		    			$name = 'edit';
		    			$button = 'Update';
		    			$disable = '';
		    		} 
		    		else if ($_GET['status'] == 'delete'){
		    			$name = 'delete';
		    			$button = 'Delete';		    			
		    		} 
		    	}
	    ?>
	    <form action="" method="post">	
	    	<tr> 
	    		<td>
	    			<a href="?view=adminGroup&status=edit&id=<?= $row->ma ?>"><span class="glyphicon glyphicon-edit" title="Edit"></span></a>
					 | 
					<a href="?view=adminGroup&status=delete&id=<?= $row->ma ?>"><span class="glyphicon glyphicon-trash" title="Delete"></span></a>
	    		</td> 
	    		<td><?= $ma ?></td>
	    		<td><input type="text" style="width: 120px;" value="<?= $ten ?>" name="ten<?= $ma ?>" <?= $readonly ?>></td> 
	    		<td>
		    		<select name="trang_thai<?= $ma ?>" <?= $disable ?>>
		    		<?php 
	                    $trang_thais = [0,1,2];
	                    foreach ($trang_thais as $item){
	                        $selectVar = $trang_thai == $item ? 'selected' : '';
	                        $selectVar = $trang_thai == $item ? 'selected' : '';
	                        echo '<option '.$selectVar.' value="'. $item .'">'.   $item .'</option>'; 
	                    }
	                ?>
		    		</select>
	    		</td>   		
	    		<td><?= $ngay_tao ?></td>	    		
	    		<td><?= $ngay_cap_nhat ?></td>
	    		<td>
	    			<button class="btn-success" style="margin: 2px " <?= $hide ?> type="submit" name="<?= $name ?>" value="<?= $ma ?>"><?= $button ?></button> 
	    			<button style="margin: 2px " <?= $hide ?>><a href="?view=adminGroup">Cancel</a></button>
    			</td>
	    	</tr>
	    </form>
	    <?php 
	    	}
	    ?>		    	
	    </tbody>
	  </table>
	</div>	
</div>
