<?php 
require_once ('./class/Slider.php');
//$paging = new Pagination();
$validation = new Validation();
$slider = new Slider();

$ma_spErr=$hinhErr=$titleErr=$primErr=$subtitleErr=$trang_thaiErr='';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$ma_spErr=$hinhErr=$trang_thaiErr='';	
	if(isset($_POST['add']) && $_POST['add']){	
		$input = array(	
			'ma_sp'=>NULL,	
			'ten_sp'=>NULL,	
			'hinh'=>NULL,	
			'title'=>NULL,	
			'prim'=>NULL,	
			'subtitle'=>NULL,	
			'trang_thai'=>NULL
			// 'ngay_tao'=>NULL	
		);

		if(!(empty($_POST['ma_sp']) && $_POST['ma_sp'] != 0)){
			$input['ma_sp'] =$validation->test_input($_POST['ma_sp']);
			if(!$validation->isNumber($input['ma_sp']))
				$ma_spErr = 'Mã sản phẩm không hợp lệ';
			else {
				$input['ten_sp'] = $slider->ten_sp($input['ma_sp']);
				if (!$input['ma_sp'])
					$ma_spErr = 'Mã sản phẩm không chưa có tên';
			}
		} else {
			$ma_spErr = 'Mã sản phẩm không hợp lệ';
		}	

		if(!(empty($_POST['hinh']) && $_POST['hinh'] != 0)){
			$input['hinh'] = $validation->test_input($_POST['hinh']);
		} else {
			$hinhErr = 'Hình không hợp lệ';
		}

		if(!(empty($_POST['title']) && $_POST['title'] != 0)){
			$input['title'] = $validation->test_input($_POST['title']);
			if(!$validation->isCommonChars($input['title'],1,15))
				$titleErr = 'Thông tin không hợp lệ';
		} else {
			$titleErr = 'Thông tin không tồn tại';
		}

		if(!(empty($_POST['prim']) && $_POST['prim'] != 0)){
			$input['prim'] = $validation->test_input($_POST['prim']);
			if(!$validation->isCommonChars($input['prim'],1,15))
				$primErr = 'Thông tin không hợp lệ';
		} else {
			$primErr = 'Thông tin không tồn tại';
		}

		if(!(empty($_POST['subtitle']) && $_POST['subtitle'] != 0)){
			$input['subtitle'] = $validation->test_input($_POST['subtitle']);
			if(!$validation->isCommonChars($input['subtitle'],1,20))
				$subtitleErr = 'Thông tin không hợp lệ';
		} else {
			$subtitleErr = 'Thông tin không tồn tại';
		}
		
		if(!(empty($_POST['trang_thai']) && $_POST['trang_thai'] != 0)){
			$input['trang_thai'] = $validation->test_input($_POST['trang_thai']);			
		} else {
			$trang_thaiErr = 'Trạng thái không hợp lệ';
		}
		
		if (!($ma_spErr||$hinhErr||$titleErr||$primErr||$subtitleErr||$trang_thaiErr)){			
			$result = $slider->addSlider($input);
			unset($input);			
			if($result){
				$_SESSION['msg'] = '<h5 style="color:blue"><i>Thêm thành công</i></h5>';
				chuyentrang('?view=media_slider');
			} else 
				$_SESSION['msg'] = '<h5 style="color:red"><i>Thêm thất bại</i></h5>';

		}
	}

	// Edit section
	if(isset($_POST['edit']) && $_POST['edit']){
		$input = array(	
			'ma_sp'=>NULL,	
			'ten_sp'=>NULL,	
			'hinh'=>NULL,	
			'trang_thai'=>NULL,
			'ma'=>NULL	
		);
		if(isset($_GET['status'], $_GET['id']) && $_GET['status'] && $_GET['id']){
		 	if($_GET['status'] == 'edit')				
				$input['ma'] = $_GET['id'];				 		
		}

		if(!(empty($_POST['ma_sp_ed']) && $_POST['ma_sp_ed'] != 0)){
			$input['ma_sp'] =$validation->test_input($_POST['ma_sp_ed']);
			if(!$validation->isNumber($input['ma_sp']))
				$ma_spErr = 'Mã sản phẩm không hợp lệ';
			else {
				$input['ten_sp'] = $slider->ten_sp($input['ma_sp']);
				if (!$input['ma_sp'])
					$ma_spErr = 'Mã sản phẩm không chưa có tên';
			}
		} else {
			$ma_spErr = 'Mã sản phẩm không hợp lệ';
		}	

		if(!(empty($_POST['hinhedit']) && $_POST['hinhedit'] != 0)){
			$input['hinh'] = $validation->test_input($_POST['hinhedit']);
		} else {
			$hinhErr = 'Hình không hợp lệ';
		}

		if(!(empty($_POST['title_ed']) && $_POST['title_ed'] != 0)){
			$input['title'] = $validation->test_input($_POST['title_ed']);
			if(!$validation->isCommonChars($input['title'],1,15))
				$titleErr = 'Thông tin không hợp lệ';
		} else {
			$titleErr = 'Thông tin không tồn tại';
		}

		if(!(empty($_POST['prim_ed']) && $_POST['prim_ed'] != 0)){
			$input['prim'] = $validation->test_input($_POST['prim_ed']);
			if(!$validation->isCommonChars($input['prim'],1,15))
				$primErr = 'Thông tin không hợp lệ';
		} else {
			$primErr = 'Thông tin không tồn tại';
		}

		if(!(empty($_POST['subtitle_ed']) && $_POST['subtitle_ed'] != 0)){
			$input['subtitle'] = $validation->test_input($_POST['subtitle_ed']);
			if(!$validation->isCommonChars($input['subtitle'],1,20))
				$subtitleErr = 'Thông tin không hợp lệ';
		} else {
			$subtitleErr = 'Thông tin không tồn tại';
		}
		
		if(!(empty($_POST['trang_thai_ed']) && $_POST['trang_thai_ed'] != 0)){
			$input['trang_thai'] = $validation->test_input($_POST['trang_thai_ed']);
		} else {
			$trang_thaiErr = 'Trạng thái không hợp lệ';
		}
		
		if (!($ma_spErr||$hinhErr||$titleErr||$primErr||$subtitleErr||$trang_thaiErr)){
			$result = $slider->updateSlider($input);			
			unset($input);			
			if($result){
				$_SESSION['msg'] = '<h5 style="color:blue"><i>Cập nhật item '.$_GET['id'].' thành công</i></h5>';
				chuyentrang('?view=media_slider');
			} else 
				$_SESSION['msg'] = '<h5 style="color:red"><i>Cập nhật thất bại</i></h5>';

		}
	}
}

$ma_edit = '';
if(isset($_GET['status'], $_GET['id']) && $_GET['status'] && $_GET['id']){
 	if($_GET['status'] == 'edit')
		$edit_slider = '';
		$ma_edit = $_GET['id'];
		$datum = $slider->loadSlider($ma_edit);		
} else {
 	$edit_slider = 'edit_slider';
} 

	

$data = $slider->loadSliders();
$ma_sps = $slider->ma_sp();
// viewArr($data);
?>

<div class="media_slider" id="media_slider">
	<div class="text-center"><?= notify() ?></div>

	<div class="container-fluid" id="btn-control">		
		<div class="col-sm-2">			
			<button type="button" class="btn btn-success" id="btn_add" name="btn_add"><span class="glyphicon glyphicon-plus"></span> Thêm slider</button>			
			
		</div>
	</div>

    <div class="table-responsive edit_table">
	  <table class="table table-bordered table-striped table-hover">
	    <thead >
	    	<tr class="success">	<!-- style="width: 15%" -->
	    		<th>Todo</th>	    		
	    		<th>Mã</th>	
	    		<th>Mã sản phẩm</th>
	    		<th>Tên sản phẩm</th>
	    		<th>Slide</th>
	    		<th>Title</th>
	    		<th>Primary</th>
	    		<th>Subtitile</th>
	    		<th>Trạng thái</th>
	    		<th>Ngày tạo</th>
	    		<th>Ngày cập nhật</th>	    		
	    	</tr>
	    </thead>
	    <tbody>
	    <?php 	    	
	    	foreach ($data as $row) {
		    	$ma = isset($row->ma) ? $row->ma : '';    		
		    	$ma_sp = isset($row->ma_sp) ? $row->ma_sp : ''; 
		    	$ten_sp = isset($row->ten_sp) ? $row->ten_sp : '';  
		    	$hinh = isset($row->hinh) ? $row->hinh : ''; 
		    	$title= isset($row->title) ? $row->title : ''; 
		    	$prim = isset($row->prim) ? $row->prim : ''; 
		    	$subtitle = isset($row->subtitle) ? $row->subtitle : ''; 
		    	$trang_thai = isset($row->trang_thai) ? $row->trang_thai : '';    		
		    	$ngay_tao = isset($row->ngay_tao) ? $row->ngay_tao : '';    		
		    	$ngay_cap_nhat = isset($row->ngay_cap_nhat) ? $row->ngay_cap_nhat : '';
		    	
	    ?>	    
    	<tr> 
    		<td>
    			<a href="?view=media_slider&status=edit&id=<?= $row->ma ?>"><span class="glyphicon glyphicon-edit" title="Edit"></span></a>					
    		</td> 
    		<td><?= $ma ?></td>
    		<td><?= $ma_sp ?></td>
    		<td style="text-align: left"><?= $ten_sp ?></td>
    		<td><img src="<?= $hinh ?>" alt="" width="200" height="50"></td> 
    		<td style="text-align: left"><?= $title ?></td> 
    		<td style="text-align: left"><?= $prim ?></td> 
    		<td style="text-align: left"><?= $subtitle ?></td> 
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

	<!-- add slider -->
	<div id="add_slider">
		<form class="well form-horizontal" method="post" enctype="multipart/form-data">
        <fieldset class="creation-border">
            <legend class="creation-border">
                <div class="pull-left">Thêm slider </div>
                <!-- <div class="pull-right"><input type="button" class="btn btn-info" id="smtp_edit" name="smtp_edit" value="Edit"></div> -->       
            </legend>        

            <div class="form-group">
                <label class="col-md-3 control-label">Mã sản phẩm</label>
                <div class="col-md-5">
					<select name="ma_sp" class="form-control">
	    		<?php                    
                    foreach ($ma_sps as $item ){                        
                        echo '<option '.$selectVar.' value="'. $item->ma_sp .'">'.   $item->ma_sp .'</option>'; 
                    }
                ?>
	    		</select>	    		
                   <!-- <input id="ma_sp" name="ma_sp" class="form-control" type="text" required value="<?= $ma_sp ?>"> -->
                </div>
                <div class="col-md-3 error">
                    <p><?= $ma_spErr ?></p>
                </div>
            </div>            

            <div class="form-group">
                <label class="col-md-3 control-label">Hình slider</label>
                <div class="col-md-5">
                	<div class="col-sm-2" style="padding: 0px">
                		<input type="button" name="button1" id="button1" onclick="BrowseServer();" value="Select slider" class="btn btn-info">
                	</div>
                	<div class="col-sm-10" style="padding: 0px">
                		<input id="hinh" name="hinh" class="form-control" type="text" required="">
                	</div>                 	             	                   	
                </div>
                <div class="col-md-3 error">
                    <p><?= $hinhErr ?></p>
                </div>
            </div>
			
			<div class="form-group">
                <label class="col-md-3 control-label">Titile</label>
                <div class="col-md-5">					
                   <input id="title" name="title" class="form-control" type="text" placeholder="số ký tự < 15">                   
                </div> 
                <div class="col-md-3 error">
                    <p><?= $titleErr ?></p>
                </div>               
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Primary</label>
                <div class="col-md-5">					
                   <input id="prim" name="prim" class="form-control" type="text" placeholder="số ký tự < 15">
                </div> 
                <div class="col-md-3 error">
                    <p><?= $primErr ?></p>
                </div>               
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Subtitle</label>
                <div class="col-md-5">					
                   <input id="subtitle" name="subtitle" class="form-control" type="text" placeholder="số ký tự < 20"> 
                 </div>          
                <div class="col-md-3 error">
                    <p><?= $subtitleErr ?></p>
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
                        <a type="button" class="btn btn-default" href="?view=media_slider">Cancel</a>
                    </div>
                </div>      
            </div>                      
        </fieldset>
    	</form>
	</div>	
	<!-- // add slider -->

	<!-- edit slider -->
	<div id="<?=$edit_slider?>" >
		<form class="well form-horizontal" method="post" enctype="multipart/form-data">
        <fieldset class="creation-border">
            <legend class="creation-border">
                <div class="pull-left">Chỉnh sửa thông slider </div>
                <!-- <div class="pull-right"><input type="button" class="btn btn-info" id="smtp_edit" name="smtp_edit" value="Edit"></div> -->       
            </legend> 
            <?php 
            	$ma_sp = isset($datum) && $datum ? $datum->ma_sp : '';
            	$ten_sp = isset($datum) && $datum ? $datum->ten_sp : '';
            	$hinh = isset($datum) && $datum ? $datum->hinh : '';
            	$title = isset($datum) && $datum ? $datum->title : '';
            	$prim = isset($datum) && $datum ? $datum->prim : '';
            	$subtitle = isset($datum) && $datum ? $datum->subtitle : '';
            	$trang_thai = isset($datum) && $datum ? $datum->trang_thai : '';
            ?>       
			<div class="form-group">
                <label class="col-md-3 control-label">Mã slider</label>
                <div class="col-md-5">					
                   <input id="ma" name="ma" class="form-control" type="text" value="<?= $ma_edit ?>" readonly>
                </div>               
            </div>	

            <div class="form-group">
                <label class="col-md-3 control-label">Mã sản phẩm</label>
                <div class="col-md-5">
					<select name="ma_sp_ed" class="form-control" required>
						<option value=""></option>
	    		<?php	    			
                    foreach ($ma_sps as $item){
                    	$selectVar = $ma_sp == $item->ma_sp ? 'selected' : ''; 
                        echo '<option '.$selectVar.' value="'. $item->ma_sp .'">'.   $item->ma_sp .'</option>'; 
                    }
                ?>
	    		</select>
                   <!-- <input id="ma_sp" name="ma_sp" class="form-control" type="text" required value="<?= $ma_sp ?>"> -->
                </div>
                <div class="col-md-3 error">
                    <p><?= $ma_spErr ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Tên sản phẩm</label>
                <div class="col-md-5">					
                   <input id="ten_sp_ed" name="ten_sp_ed" class="form-control" type="text" value="<?= $ten_sp ?>" readonly>
                </div>                
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Hình slider</label>
                <div class="col-md-5">
                	<!-- <div class="row"> -->
	                	<div class="col-sm-2" style="padding: 0px">
	                		<input type="button" name="button1" id="button1" onclick="BrowseServer();" value="Select slider" class="btn btn-info">
	                	</div>
	                	<div class="col-sm-10" style="padding: 0px">
	                		<input id="hinhedit" name="hinhedit" class="form-control" type="text" value="<?= $hinh ?>">
	                	<!-- </div> -->
                	</div>                   	
                </div>
                <div class="col-md-3 error">
                    <p><?= $hinhErr ?></p>
                </div>
            </div>
				
			<div class="form-group">
                <label class="col-md-3 control-label">Titile</label>
                <div class="col-md-5">					
                   <input id="title_ed" name="title_ed" class="form-control" type="text" value="<?= $title ?>" placeholder="số ký tự < 15">                   
                </div> 
                <div class="col-md-3 error">
                    <p><?= $titleErr ?></p>
                </div>               
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Primary</label>
                <div class="col-md-5">					
                   <input id="prim_ed" name="prim_ed" class="form-control" type="text" value="<?= $prim ?>" placeholder="số ký tự < 15">
                </div> 
                <div class="col-md-3 error">
                    <p><?= $primErr ?></p>
                </div>               
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Subtitle</label>
                <div class="col-md-5">					
                   <input id="subtitle_ed" name="subtitle_ed" class="form-control" type="text" value="<?= $subtitle ?>" placeholder="số ký tự < 20"> 
                 </div>          
                <div class="col-md-3 error">
                    <p><?= $subtitleErr ?></p>
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
                        <a type="button" class="btn btn-default" href="?view=media_slider">Cancel</a>
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
		$('.smtp').attr('disabled', 'disabled');		
		$("#add_slider").hide();
		$("#edit_slider").hide();		

		$("#btn_add").click(function(){			
			$('.smtp').removeAttr('disabled');			
			$("#add_slider").show();		
		});

		$("#smtp_cancel").click(function(){			
			$('.smtp').attr('disabled', 'disabled');
			$("#smtp_save").hide();			
			$("#smtp_cancel").hide();
			$("#smtp_edit").show();
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
		document.getElementById( 'hinhedit' ).value = fileUrl;
	}
</script>
