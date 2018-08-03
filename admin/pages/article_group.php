<?php 
//require_once ('./class/Pagination.php'); 
require_once ('./libs/funcs.php'); 
require_once ('./class/Article_group.php');

//$paging = new Pagination();
$articles = new Article_group();
$article_group = $articles->get_article_groups();
?>

<div class="admin" id="admin">	
	<div class="container-fluid" id="btn-control">		
		<div class="col-sm-2">
			<a type="button" class="btn btn-success" id="add-service" href="?view=article_group_add"><span class="glyphicon glyphicon-plus"></span> Thêm nhóm tin</a>			
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
	    	<tr class="success">	
	    		<th>Todo</th>    		
	    		<th>Mã</th>				 <!-- style="width: 15% -->
	    		<th>Tên group</th>
	    		<th>Mã cha</th>
	    		<th>Alias</th>
	    		<th>Tiêu đề</th>
	    		<th>Từ khóa</th>
	    		<th>Mô tả</th>
	    		<th>Hình chia sẻ</th>
	    		<th>Trạng thái</th>
	    		<th>Ngày tạo</th>
	    		<th>Ngày cập nhật</th>	    		
	    	</tr>
	    </thead>
	    <tbody>
	    <?php 	    	
	    	foreach ($article_group as $group) {	    		
	    ?>	
	    	<tr>
	    		<td>
	    			<a href="?view=article_group_edit&id=<?= $group->ma ?>"><span class="glyphicon glyphicon-edit" title="Edit"></span></a>
					 | 
					<a href="?view=article_group_delete&id=<?= $group->ma ?>"><span class="glyphicon glyphicon-trash" title="Delete"></span></a>

	    		</td>	    		
	    		<td><?= $group->ma ?></td>
	    		<td style="text-align: left;"><?= $group->ten ?></td>
	    		<td style="text-align: left;"><?= $group->ma_cha ?></td>
	    		<td style="text-align: left;"><?= $group->alias ?></td>
	    		<td style="text-align: left;"><?= $group->tieu_de ?></td>
	    		<td style="text-align: left;"><?= $group->tu_khoa ?></td>
	    		<td style="text-align: left;"><?= $group->mo_ta ?></td> 
	    		<td style="text-align: left;"><?= $group->hinh_chia_se ?></td>	    		
	    		<td><?= $group->trang_thai ?></td>	    		
	    		<td><?= $group->ngay_tao ?></td>	    		
	    		<td><?= $group->ngay_cap_nhat ?></td> 
	    	</tr>
	    <?php 
	    	}
	    ?>		    	
	    </tbody>
	  </table>
	</div>	
</div>
