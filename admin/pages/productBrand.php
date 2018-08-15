<?php 
require_once ('./class/Productbrand.php');

//$paging = new Pagination();
$validation = new Validation();
$Productbrand = new Productbrand();


$tenErr=$aliasErr=$hinhErr=$trang_thaiErr=$hack='';

if ($_SERVER["REQUEST_METHOD"] == "POST"){	
	$input = array(	
		'ten'=>NULL,
		'alias'=>NULL,
		'hinh'=>NULL,
		'trang_thai'=>NULL
	);
	if(isset($_POST['add']) && $_POST['add']){
		if(!(empty($_POST['ten']) && $_POST['ten'] != 0)){
			$input['ten'] = $validation->test_input($_POST['ten']);
		} else {
			$tenErr = 'Thông tin không hợp lệ';
		}

		if(!(empty($_POST['alias']) && $_POST['alias'] != 0)){
			$input['alias'] = $validation->test_input($_POST['alias']);
		} else {
			$aliasErr = 'Thông tin không hợp lệ';
		}

		if(!(empty($_POST['hinh']) && $_POST['hinh'] != 0)){
			$input['hinh'] = $validation->test_input($_POST['hinh']);
		} else {
			$hinhErr = 'Thông tin không hợp lệ';
		}

		if(!(empty($_POST['trang_thai']) && $_POST['trang_thai'] != 0)){
			$input['trang_thai'] = $validation->test_input($_POST['trang_thai']);
		} else {
			$tenErr = 'Thông tin không hợp lệ';
		}

		if (!($tenErr||$aliasErr||$hinhErr||$trang_thaiErr)){			
			$result = $Productbrand->add($input);
			unset($input);			
			if($result){
				$_SESSION['msg'] = '<h5 style="color:blue"><i>Thêm thành công</i></h5>';
				chuyentrang('?view=productBrand');
			} else 
				$_SESSION['msg'] = '<h5 style="color:red"><i>Thêm thất bại</i></h5>';

		}
	}

	if(isset($_POST['edit']) && $_POST['edit']){

		if(isset($_GET['status'], $_GET['id']) && $_GET['status'] && $_GET['id']){
		 	if($_GET['status'] == 'edit')				
				$input['ma'] = $_GET['id'];	
			else			 		
				$hack = 'Lỗi link truy cập';
		} else			 		
				$hack = 'Lỗi link truy cập';

		if(!(empty($_POST['ten_ed']) && $_POST['ten_ed'] != 0)){
			$input['ten'] = $validation->test_input($_POST['ten_ed']);
		} else {
			$tenErr = 'Thông tin không hợp lệ';
		}

		if(!(empty($_POST['alias_ed']) && $_POST['alias_ed'] != 0)){
			$input['alias'] = $validation->test_input($_POST['alias_ed']);
		} else {
			$aliasErr = 'Thông tin không hợp lệ';
		}

		if(!(empty($_POST['hinh_ed']) && $_POST['hinh_ed'] != 0)){
			$input['hinh'] = $validation->test_input($_POST['hinh_ed']);
		} else {
			$hinhErr = 'Thông tin không hợp lệ';
		}

		if(!(empty($_POST['trang_thai_ed']) && $_POST['trang_thai_ed'] != 0)){
			$input['trang_thai'] = $validation->test_input($_POST['trang_thai_ed']);
		} else {
			$tenErr = 'Thông tin không hợp lệ';
		}

		if (!($tenErr||$aliasErr||$hinhErr||$trang_thaiErr||$hack)){			
			$result = $Productbrand->update($input);					
			if($result){
				$_SESSION['msg'] = '<h5 style="color:blue"><i>Cập nhật item '.$input['ma'].' thành công</i></h5>';				
				chuyentrang('?view=productBrand');
			} else 
				$_SESSION['msg'] = '<h5 style="color:red"><i>Cập nhật '.$input['ma'].' thất bại</i></h5>';
			unset($input);	
		}
	}

}

$ma_edit = '';
if(isset($_GET['status'], $_GET['id']) && $_GET['status'] && $_GET['id']){
 	if($_GET['status'] == 'edit')
		$edit_div = '';
		$ma_edit = $_GET['id'];
		$datum = $Productbrand->loadOne($ma_edit);		
} else {
 	$edit_div = 'edit_div';
} 

$data = $Productbrand->loadAll();
?>

<div class="admin" id="admin">	
	<div class="text-center"><?= notify() ?></div>

	<div class="container-fluid" id="btn-control">		
		<div class="col-sm-2">			
			<button type="submit" class="btn btn-success" id="add_btn" name="add_btn" value="true"><span class="glyphicon glyphicon-plus"></span> Thêm thương hiệu</button>
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
	    		<th>Tên</th>
	    		<th>Alias</th> 
	    		<th>Hình</th> 
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
		    	$hinh = isset($row->hinh) ? $row->hinh : ''; 
		    	$trang_thai = isset($row->trang_thai) ? $row->trang_thai : '';    		
		    	$ngay_tao = isset($row->ngay_tao) ? $row->ngay_tao : '';    		
		    	$ngay_cap_nhat = isset($row->ngay_cap_nhat) ? $row->ngay_cap_nhat : '';		    	
	    ?>
	    <form action="" method="post">	
	    	<tr> 
	    		<td>
	    			<a href="?view=productBrand&status=edit&id=<?= $row->ma ?>"><span class="glyphicon glyphicon-edit" title="Edit"></span></a>					 
	    		</td> 
	    		<td><?= $ma ?></td>	    		
	    		<td style="text-align: left"><?= $ten ?></td>	    		
	    		<td style="text-align: left"><?= $alias ?></td>	    		
	    		<td><img src="<?= $hinh ?>" alt="" width="150" height="50"></td>	    		
	    		<td><?= $trang_thai ?></td>
	    		<td><?= $ngay_tao ?></td>	    		
	    		<td><?= $ngay_cap_nhat ?></td>	    		
	    	</tr>
	    </form>
	    <?php 
	    	}
	    ?>		    	
	    </tbody>
	  </table>
	</div>

<!-- ======================================================================= -->
	<!-- add slider -->
	<div id="add_div">
		<form class="well form-horizontal" method="post" enctype="multipart/form-data">
        <fieldset class="creation-border">
            <legend class="creation-border">
                <div class="pull-left">Thêm slider </div>
                <!-- <div class="pull-right"><input type="button" class="btn btn-info" id="smtp_edit" name="smtp_edit" value="Edit"></div> -->       
            </legend>        

            <div class="form-group">
                <label class="col-md-3 control-label">Tên thương hiệu</label>
                <div class="col-md-5">						    		
                   <input id="ten" name="ten" class="form-control" type="text" required>
                </div>
                <div class="col-md-3 error">
                	<p><?= $tenErr ?></p>
                </div>
            </div> 

            <div class="form-group">
                <label class="col-md-3 control-label">Alias</label>
                <div class="col-md-5">						    		
                   <input id="alias" name="alias" class="form-control" type="text" required>
                </div>
                <div class="col-md-3 error">
                	<p><?= $aliasErr ?></p>
                </div>
            </div>           

            <div class="form-group">
                <label class="col-md-3 control-label">Hình slider</label>
                <div class="col-md-5">
                	<div class="col-sm-3" style="padding: 0px">
                		<input type="button" name="button1" id="button1" onclick="BrowseServer();" value="Select an image" class="btn btn-info">
                	</div>
                	<div class="col-sm-9" style="padding: 0px">
                		<input id="hinh" name="hinh" class="form-control" type="text" required="">
                	</div>                 	             	                   	
                </div>
                <div class="col-md-3 error">
                    <p><?= $hinhErr ?></p>
                </div>
            </div>	

            <div class="form-group">
                <label class="col-md-3 control-label">Trạng thái</label>
                <div class="col-md-5">
                   <select id="trang_thai" name="trang_thai" class="form-control">
                       <?php 
                        $trang_thais = [1,0,2];
                        foreach ($trang_thais as $item){
                            // $selectVar = $trang_thai == $item ? 'selected' : '';
                            echo '<option '.$selectVar.' value="'. $item .'">'.   $item .'</option>'; 
                        }
                        ?>
                   </select>
                   <p><i>1: hiển thị;&nbsp&nbsp&nbsp&nbsp 0: ẩn;&nbsp&nbsp&nbsp&nbsp 2: xóa</i></p>
                </div>
                <div class="col-md-3 error">
                    <p><?= $trang_thaiErr ?></p>
                </div>
            </div>

             <!-- inputGroupContainer -->
            <div class="form-group" >
                <div class="col-md-8">
                    <div class="pull-right" style="text-align: right;">
                        <button type="submit" class="btn btn-success" name="add" id="add" value="true">Add</button>
                        <a type="button" class="btn btn-default" href="?view=productBrand">Cancel</a>
                    </div>
                </div>      
            </div>                      
        </fieldset>
    	</form>
	</div>	
	<!-- // add slider -->
<!-- ======================================================================= -->
	<!-- edit slider -->
	<div id="<?=$edit_div?>" >
		<form class="well form-horizontal" method="post" enctype="multipart/form-data">
        <fieldset class="creation-border">
            <legend class="creation-border">
                <div class="pull-left">Chỉnh sửa thông slider </div>
                <!-- <div class="pull-right"><input type="button" class="btn btn-info" id="smtp_edit" name="smtp_edit" value="Edit"></div> -->       
            </legend> 
			<div class="form-group"><div class="col-md-3 error"><p><?= $hack ?></p></div></div>

            <?php
            	$ten = isset($datum) && $datum ? $datum->ten : '';
            	$alias = isset($datum) && $datum ? $datum->alias : '';
            	$hinh = isset($datum) && $datum ? $datum->hinh : '';            	
            	$trang_thai = isset($datum) && $datum ? $datum->trang_thai : '';
            ?> 
			<div class="form-group">				
                <label class="col-md-3 control-label">Mã thương hiệu</label>
                <div class="col-md-5">						    		
                   <input class="form-control" type="text" readonly value="<?= $ma_edit ?>">
                </div>                
            </div>

			<div class="form-group">
                <label class="col-md-3 control-label">Tên thương hiệu</label>
                <div class="col-md-5">						    		
                   <input id="ten_ed" name="ten_ed" class="form-control" type="text" required value="<?= $ten ?>">
                </div>
                <div class="col-md-3 error">
                	<p><?= $tenErr ?></p>
                </div>
            </div> 

            <div class="form-group">
                <label class="col-md-3 control-label">Alias</label>
                <div class="col-md-5">						    		
                   <input id="alias_ed" name="alias_ed" class="form-control" type="text" required value="<?= $alias ?>">
                </div>
                <div class="col-md-3 error">
                	<p><?= $aliasErr ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Hình slider</label>
                <div class="col-md-5">
                	<!-- <div class="row"> -->
	                	<div class="col-sm-3" style="padding: 0px">
	                		<input type="button" name="button1" id="button1" onclick="BrowseServer();" value="Select an image" class="btn btn-info">
	                	</div>
	                	<div class="col-sm-9" style="padding: 0px">
	                		<input id="hinh_ed" name="hinh_ed" class="form-control" type="text" value="<?= $hinh ?>">
	                	<!-- </div> -->
                	</div>                   	
                </div>
                <div class="col-md-3 error">
                    <p><?= $hinhErr ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Trạng thái</label>
                <div class="col-md-5">
                   <select id="trang_thai" name="trang_thai_ed" class="form-control" required>
                   		<option value=""></option>
                       <?php 
                        $trang_thais = ['1','0','2'];
                        foreach ($trang_thais as $item){
                            $selectVar = $trang_thai === $item ? 'selected' : '';
                            echo '<option '.$selectVar.' value="'. $item .'">'.   $item .'</option>'; 
                        }
                        ?>
                   </select>
                   <p><i>1: hiển thị;&nbsp&nbsp&nbsp&nbsp 0: ẩn;&nbsp&nbsp&nbsp&nbsp 2: xóa</i></p>
                </div>
                <div class="col-md-3 error">
                    <p><?= $trang_thaiErr ?></p>
                </div>
            </div>

             <!-- inputGroupContainer -->
            <div class="form-group" >
                <div class="col-md-8">
                    <div class="pull-right" style="text-align: right;">
                        <button type="submit" class="btn btn-success" name="edit" id="edit" value="true">Edit</button>
                        <a type="button" class="btn btn-default" href="?view=productBrand">Cancel</a>
                    </div>
                </div>      
            </div>                      
        </fieldset>
    </form>
	</div>
	<!-- // edit slider -->	
</div>

<!-- =========================================================================== -->
<script>
	$(document).ready(function(){
		$("#add_div").hide();
		$("#edit_div").hide();		

		$("#add_btn").click(function(){			
			$("#add_div").show();		
		});
		
	});
</script>

<script type="text/javascript" src="libs/asset/ckfinder/ckfinder.js"></script>
<script type="text/javascript">	
	function BrowseServer(){
		// You can use the "CKFinder" class to render CKFinder in a page:
		var finder = new CKFinder();
		finder.basePath = '/First web project/admin/';	// The path for the installation of CKFinder (default = "/ckfinder/").
		finder.selectActionFunction = SetFileField;
		finder.popup();
	}

	// This is a sample function which is called when a file is selected in CKFinder.
	function SetFileField( fileUrl ){
		document.getElementById( 'hinh' ).value = fileUrl;
		document.getElementById( 'hinh_ed' ).value = fileUrl;
	}
</script>