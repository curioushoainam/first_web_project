<?php 
//require_once ('./class/Pagination.php'); 
require_once ('./libs/funcs.php'); 
require_once ('./class/Articles.php');

//$paging = new Pagination();
$articles_mng = new Articles();
$articles = $articles_mng->get_articles();
?>

<div class="admin" id="admin">	
	<div class="container-fluid" id="btn-control">		
		<div class="col-sm-2">
			<a type="button" class="btn btn-success" id="add-service" href="?view=article_add"><span class="glyphicon glyphicon-plus"></span> Thêm tin</a>			
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
	    		<th>Alias</th>
	    		<th>Tên</th>
	    		<th>Tiêu đề</th>
	    		<th>Mô tả</th>
	    		<th>Từ khóa</th>	    		
	    		<th>Hình</th>
	    		<th>Hình chia sẻ</th>
	    		<th>Tóm tắt</th>
	    		<!-- <th>Chi tiết</th> -->
	    		<th>Mã nhóm tin</th>
	    		<th>Trạng thái</th>
	    		<th>Ngày tạo</th>
	    		<th>Ngày cập nhật</th>
	    	</tr>
	    </thead>
	    <tbody>
	    <?php 	    	
	    	foreach ($articles as $article) {	    		
	    ?>	
	    	<tr> 
	    		<td>
	    			<a href="?view=article_edit&id=<?= $article->ma ?>"><span class="glyphicon glyphicon-edit" title="Edit"></span></a>
					 | 
					<a href="?view=article_delete&id=<?= $article->ma ?>"><span class="glyphicon glyphicon-trash" title="Delete"></span></a>
	    		</td> 
	    		<td><?= $article->ma ?></td>
	    		<td style="text-align: left;"><?= $article->alias ?></td>
	    		<td style="text-align: left;"><?= $article->ten ?></td>
	    		<td style="text-align: left;"><?= $article->tieu_de ?></td>
	    		<td style="text-align: left;"><?= $article->mo_ta ?></td>
	    		<td style="text-align: left;"><?= $article->tu_khoa ?></td> 
	    		<td style="text-align: left;">	    			
	    			<?php 
	    				$hinhs = explode("|",$article->hinh);
	    				foreach($hinhs as $hinh){
	    					echo '<img src="./images/articles/'.$hinh.'" alt="" width="50" height="50">';
	    				}
	    			?> 
	    		</td>	    		
	    		<td>
	    			<?php 
	    				$hinhs = explode("|",$article->hinh_chia_se);
	    				foreach($hinhs as $hinh){
	    					echo '<img src="./images/articles/'.$hinh.'" alt="" width="50"  height="50">';
	    				}
	    			?>
	    		</td>	    		
	    		<td><?= $article->tom_tat ?></td>	    		
	    		<!-- <td><?= $article->chi_tiet ?></td> -->	    		
	    		<td><?= $article->ma_nhom_tin ?></td>	    		
	    		<td><?= $article->trang_thai ?></td>	    		
	    		<td><?= $article->ngay_tao ?></td>	    		
	    		<td><?= $article->ngay_cap_nhat ?></td> 
	    	</tr>
	    <?php 
	    	}
	    ?>		    	
	    </tbody>
	  </table>
	</div>	
</div>
