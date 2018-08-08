<?php 
//require_once ('./class/Pagination.php');  
//$paging = new Pagination();
$validation = new Validation();
$databaseFuncs = new DatabaseFuncs();

$data = $databaseFuncs->read('products',array('*'),array(),array('ma'=>'DESC'));
?>

<div class="admin" id="admin">	
	<div class="container-fluid" id="btn-control">		
		<div class="col-sm-2 dropdown">			
				<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" id="btn-select-active" href="#">Chọn thao tác <span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li><a href="?view=admin">Hiện danh sách hiển thị</a></li>
					<li><a href="?view=admin&status=all">Hiện toàn bộ danh sách</a></li>
					<li><a href="?view=admin&status=hidden">Hiện danh sách ẩn</a></li>
					<li><a href="?view=admin&status=deleted">Hiện danh sách bị xóa</a></li>				
				</ul>			
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
    <div class="table-responsive">
	  <table class="table table-bordered table-striped table-hover">
	    <thead >
	    	<tr class="success">	<!-- style="width: 15% -->
	    		<th>Todo</th>	    		
	    		<th>Mã</th>				 	    		
	    		<th>Tên</th>
	    		<th>Alias</th>
	    		<th>Mã nhóm</th>
	    		<th >Nội dung tóm tắt</th>	    		
	    		<th>Hình</th>
	    		<th>Mã loại</th>
	    		<th>Đơn giá</th>
	    		<th>Số lượng</th>	    		
	    		<th>Trạng thái</th>
	    		<th>Ngày tạo</th>
	    		<th>Ngày cập nhật</th>
	    	</tr>
	    </thead>
	    <tbody>
	    <?php 	    	
	    	foreach ($data as $row) {
	    		$ma = isset($row->ma) ? $row->ma : '';
	    		$ten = isset($row->ten) ? $row->ten : '';  
	    		$alias = isset($row->alias) ? $row->alias : '';   		
		    	$ma_nhom = isset($row->ma_nhom) ? $row->ma_nhom : '';  	
		    	$noi_dung_tom_tat = isset($row->noi_dung_tom_tat) ? $row->noi_dung_tom_tat : '';
				$hinhArr = isset($row->hinh) ? $row->hinh : '';
		    	$ma_loai = isset($row->ma_loai) ? $row->ma_loai : '';
		    	$don_gia = isset($row->don_gia) ? $row->don_gia : '';    		
		    	$so_luong = isset($row->so_luong) ? $row->so_luong : '';
		    	$trang_thai = isset($row->trang_thai) ? $row->trang_thai : '';    		
		    	$ngay_tao = isset($row->ngay_tao) ? $row->ngay_tao : '';    		
		    	$ngay_cap_nhat = isset($row->ngay_cap_nhat) ? $row->ngay_cap_nhat : '';	    		
	    ?>	
	    	<tr> 
	    		<td>
	    			<a href="?view=product_edit&id=<?= $ma ?>"><span class="glyphicon glyphicon-list-alt" title="View"></span></a>
					 | 
					<a href="?view=product_delete&id=<?= $ma ?>"><span class="glyphicon glyphicon-trash" title="Delete"></span></a>
	    		</td> 
	    		<td><?= $ma ?></td>
	    		<td style="text-align: left;"><?= $ten ?></td>
	    		<td style="text-align: left;"><?= $alias ?></td>
	    		<td><?= $ma_nhom ?></td>
	    		<td style="text-align: left;"><?= $noi_dung_tom_tat ?></td>
	    		<td style="text-align: left;">
	    			<?php 
	    			$hinhs = explode("|",$hinhArr);
    				foreach($hinhs as $hinh){
    					echo '<img src="./images/products/'.$hinh.'" alt="" width="50" height="50">';
    				}
	    			?>
	    		</td>
	    		<td><?= $ma_loai ?></td>
	    		<td><?= $don_gia ?></td>
	    		<td><?= $so_luong ?></td>
	    		<td><?= $trang_thai ?></td>
	    		<td><?= $ngay_tao ?></td>
	    		<td><?= $ngay_cap_nhat ?></td>	    		
	    	</tr>
	    <?php 
	    	}
	    ?>		    	
	    </tbody>
	  </table>
	</div>	
</div>
