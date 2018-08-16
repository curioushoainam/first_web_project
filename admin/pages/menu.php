<?php 
require_once ('./class/Menu.php');

//$paging = new Pagination();
$validation = new Validation();
$menu = new Menu();


$tenErr=$linkErr=$ma_chaErr=$trang_thaiErr=$hack='';

if ($_SERVER["REQUEST_METHOD"] == "POST"){	
	$input = array(	
		'ten'=>NULL,
		'link'=>NULL,
		'action'=>NULL,
		'ma_cha'=>NULL,
		'trang_thai'=>NULL
	);
	if(isset($_POST['add']) && $_POST['add']){
		if(!(empty($_POST['ten']) && $_POST['ten'] != 0)){
			$input['ten'] = $validation->test_input($_POST['ten']);
		} else {
			$tenErr = 'Thông tin không hợp lệ';
		}

		if(!(empty($_POST['link']) && $_POST['link'] != 0)){
			$input['link'] = $validation->test_input($_POST['link']);
			// ============= get action from link ======================
			$input['action'] = getAction($input['link']);	
			if(!$input['action'])	
				$linkErr = 'Không đúng định dạng link';
		} else {
			$linkErr = 'Thông tin không hợp lệ';
		}

		
		if(!(empty($_POST['ma_cha']) && $_POST['ma_cha'] != 0)){
			$input['ma_cha'] = $validation->test_input($_POST['ma_cha']);
			if(!is_numeric($input['ma_cha']))
				$ma_chaErr = 'Mã cha không đúng định dạng';
		} else {
			$ma_chaErr = 'Thông tin không hợp lệ';
		}

		if(!(empty($_POST['trang_thai']) && $_POST['trang_thai'] != 0)){
			$input['trang_thai'] = $validation->test_input($_POST['trang_thai']);
		} else {
			$tenErr = 'Thông tin không hợp lệ';
		}

		if (!($tenErr||$linkErr||$ma_chaErr||$trang_thaiErr)){			
			$result = $menu->add($input);
			unset($input);			
			if($result){
				$_SESSION['msg'] = '<h5 style="color:blue"><i>Thêm thành công</i></h5>';
				chuyentrang('?view=menu');
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

		if(!(empty($_POST['link_ed']) && $_POST['link_ed'] != 0)){
			$input['link'] = $validation->test_input($_POST['link_ed']);
			// ============= get action from link ======================
			$input['action'] = getAction($input['link']);	
			if(!$input['action'])	
				$linkErr = 'Không đúng định dạng link';			
		} else {
			$linkErr = 'Thông tin không hợp lệ';
		}		

		if(!(empty($_POST['ma_cha_ed']) && $_POST['ma_cha_ed'] != 0)){
			$input['ma_cha'] = $validation->test_input($_POST['ma_cha_ed']);			
			if(!is_numeric($input['ma_cha']))
				$ma_chaErr = 'Mã cha không đúng định dạng';
		} else {
			$ma_chaErr = 'Thông tin không hợp lệ';
		}

		if(!(empty($_POST['trang_thai_ed']) && $_POST['trang_thai_ed'] != 0)){
			$input['trang_thai'] = $validation->test_input($_POST['trang_thai_ed']);
		} else {
			$tenErr = 'Thông tin không hợp lệ';
		}

		if (!($tenErr||$linkErr||$ma_chaErr||$trang_thaiErr||$hack)){			
			$result = $menu->update($input);	
			// viewArr($input);
			if($result){
				$_SESSION['msg'] = '<h5 style="color:blue"><i>Cập nhật item '.$input['ma'].' thành công</i></h5>';				
				chuyentrang('?view=menu');
			} else 
				$_SESSION['msg'] = '<h5 style="color:red"><i>Cập nhật '.$input['ma'].' thất bại</i></h5>';
			unset($input);	
		}
	}

}

function getAction($link){
	$link = explode('&',$link);
	$len = count($link);
	for ($i=0; $i<$len; $i++){
		$act = explode('=',$link[$i]);
		if (in_array('action',$act))
			return $act[1];
	}
	return false;
}

$ma_edit = '';
if(isset($_GET['status'], $_GET['id']) && $_GET['status'] && $_GET['id']){
 	if($_GET['status'] == 'edit')
		$edit_div = '';
		$ma_edit = $_GET['id'];
		$datum = $menu->loadOne($ma_edit);		
} else {
 	$edit_div = 'edit_div';
} 

$data = $menu->loadAll();
?>

<div class="admin" id="admin">	
	<div class="text-center"><?= notify() ?></div>

	<div class="container-fluid" id="btn-control">		
		<div class="col-sm-2">			
			<button type="submit" class="btn btn-success" id="add_btn" name="add_btn" value="true"><span class="glyphicon glyphicon-plus"></span> Thêm menu</button>
		</div>	
	</div>
	
    <div class="table-responsive edit_table">
	  <table class="table table-bordered table-striped table-hover">
	    <thead >
	    	<tr class="success">	<!-- style="width: 15%" -->
	    		<th>Todo</th>	    		
	    		<th>Mã</th>	
	    		<th>Tên</th>
	    		<th>Link</th> 
	    		<th>Action</th>
	    		<th>Mã cha</th> 
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
		    	$link = isset($row->link) ? $row->link : '';
		    	$action = isset($row->action) ? $row->action : '';
		    	$ma_cha = isset($row->ma_cha) ? $row->ma_cha : ''; 
		    	$trang_thai = isset($row->trang_thai) ? $row->trang_thai : '';    		
		    	$ngay_tao = isset($row->ngay_tao) ? $row->ngay_tao : '';    		
		    	$ngay_cap_nhat = isset($row->ngay_cap_nhat) ? $row->ngay_cap_nhat : '';		    	
	    ?>
	    <form action="" method="post">	
	    	<tr> 
	    		<td>
	    			<a href="?view=menu&status=edit&id=<?= $row->ma ?>"><span class="glyphicon glyphicon-edit" title="Edit"></span></a>					 
	    		</td> 
	    		<td><?= $ma ?></td>	    		
	    		<td style="text-align: left"><?= $ten ?></td>	    		
	    		<td style="text-align: left"><?= $link ?></td>	    		
	    		<td style="text-align: left"><?= $action ?></td>	    		
	    		<td><?= $ma_cha ?></td>	    		
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
                <div class="pull-left">Thêm menu </div>
                <!-- <div class="pull-right"><input type="button" class="btn btn-info" id="smtp_edit" name="smtp_edit" value="Edit"></div> -->       
            </legend>        

            <div class="form-group">
                <label class="col-md-3 control-label">Tên menu</label>
                <div class="col-md-5">						    		
                   <input id="ten" name="ten" class="form-control" type="text" required>
                </div>
                <div class="col-md-3 error">
                	<p><?= $tenErr ?></p>
                </div>
            </div> 

            <div class="form-group">
                <label class="col-md-3 control-label">Link</label>
                <div class="col-md-5">						    		
                   <input id="link" name="link" class="form-control" type="text" required placeholder="định dạng link ...&action=yyy hoặc ...&action=yyy&...">
                </div>
                <div class="col-md-3 error">
                	<p><?= $linkErr ?></p>
                </div>
            </div>           

             <div class="form-group">
                <label class="col-md-3 control-label">Mã cha</label>
                <div class="col-md-5">						    		
                   <input id="ma_cha" name="ma_cha" class="form-control" type="number" required>
                </div>
                <div class="col-md-3 error">
                	<p><?= $ma_chaErr ?></p>
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
                        <a type="button" class="btn btn-default" href="?view=menu">Cancel</a>
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
                <div class="pull-left">Chỉnh sửa thông menu </div>
                <!-- <div class="pull-right"><input type="button" class="btn btn-info" id="smtp_edit" name="smtp_edit" value="Edit"></div> -->       
            </legend> 
			<div class="form-group"><div class="col-md-3 error"><p><?= $hack ?></p></div></div>

            <?php
            	$ten = isset($datum) && $datum ? $datum->ten : '';
            	$link = isset($datum) && $datum ? $datum->link : '';
            	$ma_cha = isset($datum) && $datum ? $datum->ma_cha : '';            	
            	$trang_thai = isset($datum) && $datum ? $datum->trang_thai : '';
            ?> 
			<div class="form-group">				
                <label class="col-md-3 control-label">Mã menu</label>
                <div class="col-md-5">						    		
                   <input class="form-control" type="text" readonly value="<?= $ma_edit ?>">
                </div>                
            </div>

			<div class="form-group">
                <label class="col-md-3 control-label">Tên menu</label>
                <div class="col-md-5">						    		
                   <input id="ten_ed" name="ten_ed" class="form-control" type="text" required value="<?= $ten ?>">
                </div>
                <div class="col-md-3 error">
                	<p><?= $tenErr ?></p>
                </div>
            </div> 

            <div class="form-group">
                <label class="col-md-3 control-label">link</label>
                <div class="col-md-5">						    		
                   <input id="link_ed" name="link_ed" class="form-control" type="text" required value="<?= $link ?>" placeholder="định dạng link ...&action=yyy hoặc ...&action=yyy&...">
                </div>
                <div class="col-md-3 error">
                	<p><?= $linkErr ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Mã cha</label>
                <div class="col-md-5">						    		
                   <input id="ma_cha_ed" name="ma_cha_ed" class="form-control" type="number" required value="<?= $ma_cha ?>">
                </div>
                <div class="col-md-3 error">
                	<p><?= $ma_chaErr ?></p>
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
                        <a type="button" class="btn btn-default" href="?view=menu">Cancel</a>
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