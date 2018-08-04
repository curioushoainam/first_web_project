<?php 
require_once ('./class/DatabaseFuncs.php');

//$paging = new Pagination();
$validation = new Validation();
$databaseFuncs = new DatabaseFuncs();
$input = array(
	'ma_cha'=>NULL,
	'ten'=>NULL,
	'alias'=>NULL,
	'trang_thai'=>NULL,
	'ngay_cap_nhat'=>NULL	
);

if ($_SERVER["REQUEST_METHOD"] == "POST"){	
	if(isset($_POST['edit']) && $_POST['edit'] && isset($_GET['id']) && $_GET['id']){		
		$id = $validation->test_input($_GET['id']);
		if(!(empty($_POST['ma_cha'.$id]) && $_POST['ma_cha'.$id] != 0)){
			$input['ma_cha'] = $validation->test_input($_POST['ma_cha'.$id]);
		}
		if(!(empty($_POST['ten'.$id]) && $_POST['ten'.$id] != 0)){
			$input['ten'] = $validation->test_input($_POST['ten'.$id]);
		}
		if(!(empty($_POST['alias'.$id]) && $_POST['alias'.$id] != 0)){
			$input['alias'] = $validation->test_input($_POST['alias'.$id]);
		}
		if(!(empty($_POST['trang_thai'.$id]) && $_POST['trang_thai'.$id] != 0)){
			$input['trang_thai'] = $validation->test_input($_POST['trang_thai'.$id]);
		}
		$input['ngay_cap_nhat'] = date('Y-m-d H:i:s');
		// viewArr($input);		
		$result = $databaseFuncs->update('product_supplier',$input,array('ma'=>$id));
		if($result)			
			chuyentrang('?view=product_supplier');
		else 
			echo '<script type="text/javascript">alert("'. 'Cập nhật thất bại' .'")</script>';
	}

	if(isset($_POST['delete']) && $_POST['delete'] && isset($_GET['id']) && $_GET['id']){
		$id = $validation->test_input($_GET['id']);
		$result = $databaseFuncs->update('product_supplier',array('trang_thai'=>2,'ngay_cap_nhat'=>date('Y-m-d H:i:s')),array('ma'=>$id));
		if($result)			
			chuyentrang('?view=product_supplier');
		else 
			echo '<script type="text/javascript">alert("'. 'Xóa item=>'.$id.' thất bại' .'")</script>';
	}

	if(isset($_POST['add_supplier']) && $_POST['add_supplier']){
		$databaseFuncs->create('product_supplier',array('ma_cha'=>0,
														'ten'=>'',
														'alias'=>'',
														'trang_thai'=>1,
														'ngay_tao'=>date('Y-m-d H:i:m'),
														'ngay_cap_nhat'=>NULL	
														));
		$lastID = $databaseFuncs->getLastId();
		chuyentrang('?view=product_supplier&status=edit&id='.$lastID);
	}


}

$data = $databaseFuncs->read('product_supplier',array('*'));
?>

<div class="admin" id="admin">	
	<div class="container-fluid" id="btn-control">		
		<div class="col-sm-2">
			<form action="" method="post">
				<button type="submit" class="btn btn-success" id="add-service" name="add_supplier" value="true"><span class="glyphicon glyphicon-plus"></span> Thêm nhà cung cấp</button>			
			</form>
		</div>
			
		<div class="col-sm-offset-10">
			<form role="form" class="form-horizontal" method="post">
				<div class="form-group">					
					<label>Số dòng trên trang</label>
					<select class="search" name="rpp" id="rpp" onchange="this.form.submit()">
					<?php  	
						$rpp_arr = [25, 50, 100];
						foreach ($rpp_arr as $item){
                        $selectVar = $_SESSION['rpp'] == $item ? 'selected' : '';
                        echo '<option '.$selectVar.' value="'. $item .'">'.   $item .'</option>'; 
                    	}
					?>																
					</select>
				</div>
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
	    		<th>Mã cha</th>
	    		<th>Tên</th>
	    		<th>Alias</th>  
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
		    	$ma_cha = isset($row->ma_cha) ? $row->ma_cha : '';    		
		    	$ten = isset($row->ten) ? $row->ten : '';    		
		    	$alias = isset($row->alias) ? $row->alias : ''; 
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
	    			<a href="?view=product_supplier&status=edit&id=<?= $row->ma ?>"><span class="glyphicon glyphicon-edit" title="Edit"></span></a>
					 | 
					<a href="?view=product_supplier&status=delete&id=<?= $row->ma ?>"><span class="glyphicon glyphicon-trash" title="Delete"></span></a>
	    		</td> 
	    		<td><?= $ma ?></td>
	    		<td><input type="text" style="width: 30px;" value="<?= $ma_cha ?>" name="ma_cha<?= $ma ?>" <?= $readonly ?>></td> 
	    		<td><input type="text" style="width: 120px;" value="<?= $ten ?>" name="ten<?= $ma ?>" <?= $readonly ?>></td> 
	    		<td><input type="text" style="width: 120px;" value="<?= $alias ?>" name="alias<?= $ma ?>" <?= $readonly ?>></td>
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
	    			<button class="btn-success" style="margin: 2px " <?= $hide ?> type="submit" name="<?= $name ?>" value="true"><?= $button ?></button> 
	    			<button style="margin: 2px " <?= $hide ?>><a href="?view=product_supplier">Cancel</a></button>
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
