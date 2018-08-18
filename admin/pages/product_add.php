<?php
$validation = new Validation(); 
$databaseFuncs = new DatabaseFuncs();

// define variables and set to empty values
$input = array("ten"=>NULL, "alias"=>NULL, "ma_nhom"=>NULL, "noi_dung_chi_tiet"=>NULL, "noi_dung_tom_tat"=>NULL, "danh_sach_hinh"=>NULL, "tieu_de"=>NULL, "tu_khoa"=>NULL, "mo_ta"=>NULL, "ma_loai"=>NULL, "so_luong"=>NULL, "don_gia"=>NULL, "trang_thai"=>NULL, "ngay_tao"=>NULL, "ngay_cap_nhat"=>NULL, "hinh"=>NULL, "hinh_chia_se"=>NULL);

$tenErr=$aliasErr=$ma_nhomErr=$noi_dung_chi_tietErr=$noi_dung_tom_tatErr=$danh_sach_hinhErr=$tieu_deErr=$tu_khoaErr=$mo_taErr=$ma_loaiErr=$so_luongErr=$don_giaErr=$trang_thaiErr=$ngay_taoErr=$hinhErr=$hinh_chia_seErr='';

$hinhArr=$hinh_chia_seArr=array();
$feedback='';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['product_add']) && $_POST['product_add']){ 

        if(isset($_POST['ten']) && $_POST['ten']){
            $input['ten'] = $validation->test_input($_POST['ten']);          
        } else {
            $tenErr = '* Có lỗi xảy ra';         
        } 

        if(isset($_POST['alias']) && $_POST['alias']){
            $input['alias'] = $validation->test_input($_POST['alias']);
        } else {
            $aliasErr = '* Có lỗi xảy ra';
        }        

        if(isset($_POST['ma_nhom']) && $_POST['ma_nhom']){
            $input['ma_nhom'] = $validation->test_input($_POST['ma_nhom']);
        } else {
            $ma_nhomErr = '* Có lỗi xảy ra';
        }

        if(isset($_POST['noi_dung_chi_tiet'])){
            $input['noi_dung_chi_tiet'] = $validation->test_input($_POST['noi_dung_chi_tiet']);            
        } else {
            $noi_dung_chi_tietErr = '* Có lỗi xảy ra';
        }

        if(isset($_POST['noi_dung_tom_tat'])){
            $input['noi_dung_tom_tat'] = $validation->test_input($_POST['noi_dung_tom_tat']);
        } else {
            $noi_dung_tom_tatErr = '* Có lỗi xảy ra';
        }        

        if(isset($_POST['imgselected'])){
            $imgs = '';
            foreach ($_POST['imgselected'] as $img){
                $imgs .= $img .'||';
            }
            $imgs = rtrim($imgs,'||');            
            $input['danh_sach_hinh'] = $imgs;            
        } 

        if(isset($_POST['tieu_de'])){
            $input['tieu_de'] = $validation->test_input($_POST['tieu_de']);
        } else {
            $tieu_deErr = '* Có lỗi xảy ra';
        }

        if(isset($_POST['tu_khoa'])){
            $input['tu_khoa'] = $validation->test_input($_POST['tu_khoa']);
        } else {
            $tu_khoaErr = '* Có lỗi xảy ra';
        }

        if(isset($_POST['mo_ta'])){
            $input['mo_ta'] = $validation->test_input($_POST['mo_ta']);
        } else {
            $mo_taErr = '* Có lỗi xảy ra';
        }

        if(empty($_POST['ma_loai']) && $_POST['ma_loai'] !== '0'){
            $ma_loaiErr = '* Có lỗi xảy ra';                     
        } else {
            $input['ma_loai'] = $validation->test_input($_POST['ma_loai']);
            if (!$validation->isNumber($input['ma_loai'])){
                $input['ma_loai'] = '';
                $ma_loaiErr = "Mã loại không hợp lệ";
            }           
        }

        if(isset($_POST['so_luong'])){
            $input['so_luong'] = $validation->test_input($_POST['so_luong']);
        } else {
            $so_luongErr = '* Có lỗi xảy ra';
        }

        if(isset($_POST['don_gia'])){
            $input['don_gia'] = $validation->test_input($_POST['don_gia']);
        } else {
            $don_giaErr = '* Có lỗi xảy ra';
        }

        if(empty($_POST['trang_thai']) && $_POST['trang_thai'] !== '0'){
            $trang_thaiErr = '* Có lỗi xảy ra';                     
        } else {
            $input['trang_thai'] = $validation->test_input($_POST['trang_thai']);
            if (!$validation->isNumber($input['trang_thai'])){
                $input['trang_thai'] = '';
                $trang_thaiErr = "Trạng thái không hợp lệ";
            }           
        }

        if(isset($_POST['hinh'])){                       
            $input['hinh'] = $validation->test_input($_POST['hinh']);
        }

         if(isset($_POST['hinh_cs'])){                       
            $input['hinh_chia_se'] = $validation->test_input($_POST['hinh_cs']);
        }

// viewArr($input);
        if(!($tenErr||$aliasErr||$ma_nhomErr||$noi_dung_chi_tietErr||$noi_dung_tom_tatErr||$danh_sach_hinhErr||$tieu_deErr||$tu_khoaErr||$mo_taErr||$ma_loaiErr||$so_luongErr||$don_giaErr||$trang_thaiErr)){

            $input['ngay_tao'] = date('Y-m-d H:i:s');
// viewArr($input);                       
            $kq = $databaseFuncs->create('products',$input);
            if($kq){
                foreach($input as $key => $val){
                    $input[$key] = NULL;
                }                
                 $feedback = '<h4 style="color:blue"><i>Thêm sản phẩm vào database thành công</i></h4>';
            } else 
                 $feedback = '<h4 style="color:red"><i>Thêm sản phẩm vào database Thất Bại</i></h4>';
        }         
    }
}

?>

<div class="product_add">	
	<div class="">
		<div class="row">
			<div class="col-sm-6"><h3>Thêm sản phẩm mới</h3></div>
			<div class="col-sm-6 align-content-center" style="margin-top: 20px">
				<button class="btn btn-success" type="submit" value="true">Add</button>
				<a type="button" class="btn btn-default" href="#">Cancel</a>
			</div>
		</div>
	<hr>		
		
	<form action="" method="post" enctype="multipart/form-data">
		<div class="tabbable">
			<ul class="nav nav-tabs">
	            <li class="active"><a href="#general" data-toggle="tab"><b>Thông tin chung</b></a></li>
	            <li><a href="#detail" data-toggle="tab"><b>Chi tiết sản phẩm</b></a></li>	            
	            <li><a href="#seo" data-toggle="tab"><b>SEO</b></a></li>
	            <li><a href="#mage" data-toggle="tab"><b>Hình ảnh</b></a></li>
          	</ul>
          	<div class="tab-content">
          		<div class="tab-pane active" id="general">          			
					<div class="col-md-8 col-md-offset-2">
		            	<table class="table">
		        			<tbody>
		            		<tr>
		            			<td class="leftCol success col-sm-3" style="font-size: 14px">Tên sản phẩm: </td>
		            			<td class="rightCol"><input type="text" name="ten" style="width: 100%; "></td>
		            		</tr>
		            		<tr>
		            			<td class="leftCol success" style="font-size: 14px">Alias: </td>
		            			<td class="rightCol"><input type="text" name="alias" style="width: 100%; "></td>
		            		</tr>
		            		<tr>
		            			<td class="leftCol success" style="font-size: 14px">Mã nhóm: </td>
		            			<td class="rightCol"> 
		            				<select id="ma_nhom" name="ma_nhom" style="width: 100%; ">
									<?php
				                    $product_group = $databaseFuncs->read('product_group',array('ma','ten'));
				                    foreach($product_group as $item){
				                        $selectVar = $input['ma_nhom'] == $item->ma ? 'selected' : '';
				                        echo '<option '.$selectVar.' value="'. $item->ma .'">'.   $item->ten .'</option>';
				                    }
				                    ?>  
				                    </select>
		            			</td>
		            		</tr>
		            		<tr>
		            			<td class="leftCol success" style="font-size: 14px">Tóm tắt: </td>
		            			<td class="rightCol">		            				
		            				<textarea rows="3" id="noi_dung_tom_tat" name="noi_dung_tom_tat" style="width: 100%; " class="form-control" type="text"><?= $input['noi_dung_tom_tat'] ?></textarea>
		            			</td>
		            		</tr>
		            		<tr>
		            			<td class="leftCol success" style="font-size: 14px">Mã loại: </td>
		            			<td class="rightCol">		            				
		            				<select id="ma_loai" name="ma_loai" style="width: 100%; ">
				                    <?php
				                    $product_catalog = $databaseFuncs->read('product_catalog',array('ma','ten'));
				                    foreach($product_catalog as $item){
				                        $selectVar = $input['ma_nhom'] == $item->ma ? 'selected' : '';
				                        echo '<option '.$selectVar.' value="'. $item->ma .'">'.   $item->ten .'</option>';
				                    }
				                    ?>  
				                    </select>
		            			</td>
		            		</tr>
		            		<tr>
		            			<td class="leftCol success" style="font-size: 14px">Số lượng: </td>
		            			<td class="rightCol">
									<input id="so_luong" name="so_luong" type="number" style="width: 100%;" value="<?= $input['so_luong'] ?>">
		            			</td>
		            		</tr>

		            		<tr>
		            			<td class="leftCol success" style="font-size: 14px">Đơn giá: </td>
		            			<td class="rightCol">		            				
		            				<input id="don_gia" name="don_gia" style="width: 100%; " type="text" value="<?= $input['don_gia'] ?>">
		            			</td>
		            		</tr>


		            		<tr>
		            			<td class="leftCol success" style="font-size: 14px">Trạng thái: </td>
		            			<td class="rightCol">
		            				
		            				<select id="trang_thai" name="trang_thai"style="width: 100%; ">
			                       <?php 
			                        $trang_thais = [0,1];
			                        foreach ($trang_thais as $item){
			                            $selectVar = $input['trang_thai'] == $item ? 'selected' : '';
			                            echo '<option '.$selectVar.' value="'. $item .'">'.   $item .'</option>'; 
			                        }
			                        ?>
			                   </select>
		            			</td>
		            		</tr>
		            		</tbody>
		        		</table>
		    		</div>
        		</div>

        		<div class="tab-pane" id="detail">
					<?php 
						include ('/pages/product_add_detail.php');
					?>
				</div>				

        		<div class="tab-pane" id="seo">
					<div class="col-md-8 col-md-offset-2">
		            	<table class="table">
		        			<tbody>
		            		<tr>
		            			<td class="leftCol success col-sm-3" style="font-size: 14px">Tiêu đề: </td>
		            			<td class="rightCol">		            				
		            				<input id="tieu_de" name="tieu_de" type="text" style="width: 100%;" value="<?= $input['tieu_de'] ?>">
		            			</td>
		            		</tr>
		            		<tr>
		            			<td class="leftCol success" style="font-size: 14px">Từ khóa: </td>
		            			<td class="rightCol">
		            				<input id="tu_khoa" name="tu_khoa" style="width: 100%;" type="text" value="<?= $input['tu_khoa'] ?>">
		            			</td>
		            		</tr>
		            		<tr>
		            			<td class="leftCol success" style="font-size: 14px">Mô tả: </td>
		            			<td class="rightCol">
		            				<textarea id="mo_ta" name="mo_ta" style="width: 100%;" type="text" rows="5"><?= $input['mo_ta'] ?></textarea>
		            			</td>
		            		</tr>	                		
		            		</tbody>
		        		</table>
		    		</div>
        		</div>

				<div class="tab-pane" id="mage">
					<div class="col-md-8 col-md-offset-2">
		            	<table class="table">
		        			<tbody>
		            		<tr>
		            			<!-- <td class="leftCol success col-sm-3" style="font-size: 14px">Hình: </td> -->
		            			<td class="leftCol success col-sm-3" style="font-size: 14px"><input type="button" name="button1" id="button1" onclick="BrowseServer();" value="Chọn hình" class="btn btn-info" style="width:100%"> </td>
		            			<td class="rightCol">		            				
		            				<div class="col-sm-8" style="padding: 0px">				                        
				                        <input id="hinh" name="hinh" class="form-control lock2" type="text" value="" readonly>
				                    </div>
				                    <div class="col-sm-4" style="padding: 0px">                     
				                        <img alt="" width="100" height="75" id="img" src="" class="pull-right">
				                    </div>   
		            			</td>
		            		</tr>
		            		<tr>
		            			<td class="leftCol success" style="font-size: 14px"><input type="button" name="button1" id="button1" onclick="BrowseServerCS();" value="Hình chia sẽ" class="btn btn-info" style="width:100%"> </td>
		            			<td class="rightCol">		            				
		            				<div class="col-sm-8" style="padding: 0px">				                        
				                        <input id="hinh_cs" name="hinh_cs" class="form-control lock2" type="text" value="" readonly>
				                    </div>
				                    <div class="col-sm-4" style="padding: 0px">                     
				                        <img alt="" width="100" height="75" id="img_cs" src="" class="pull-right">
				                    </div>
		            			</td>
		            		</tr>
		            		<tr>		            			
		            			<td class="leftCol success">
		            				<input type="button" name="btn_slmulimg" id="btn_slmulimg" value="Chọn danh sách hình" class="btn btn-info"  style="width:100%">
		            			</td>
		            			<td class="rightCol">
		            				<div id="mulImages">
			            					<!-- Show Images -->
		            				</div>
		            			</td>
		            		</tr>	                		
		            		</tbody>
		        		</table>
		    		</div>
        		</div>
			</div>
		</div>
		<!-- /tabs -->	
	</form>
	</div>	
</div>



<script type="text/javascript" src="libs/asset/ckfinder/ckfinder.js"></script>
<script type="text/javascript"> 
    function BrowseServer(){
        // You can use the "CKFinder" class to render CKFinder in a page:
        var finder = new CKFinder();
        finder.basePath = '/First web project/admin/';  // The path for the installation of CKFinder (default = "/ckfinder/").
        finder.selectActionFunction = SetFileField;
        finder.popup();
    }
    // This is a sample function which is called when a file is selected in CKFinder.
    function SetFileField( fileUrl ){
        document.getElementById( 'hinh' ).value = fileUrl;      
        document.getElementById( 'img' ).setAttribute('src',fileUrl);
    }

    function BrowseServerCS(){
        // You can use the "CKFinder" class to render CKFinder in a page:
        var finder = new CKFinder();
        finder.basePath = '/First web project/admin/';  // The path for the installation of CKFinder (default = "/ckfinder/").
        finder.selectActionFunction = SetFileFieldCS;
        finder.popup();
    }
    // This is a sample function which is called when a file is selected in CKFinder.
    function SetFileFieldCS( fileUrl ){
        document.getElementById( 'hinh_cs' ).value = fileUrl;      
        document.getElementById( 'img_cs' ).setAttribute('src',fileUrl);
    }  

    $(document).ready(function(){
		 $.ajax({
	        url: 'class/API.php',
	        type : "post",			// post method
            dataType : "text",		// data type of server respose
            data : {				// list of arguments will be sent to server

            	location : 'images'
            },
            success : function(response){	// call-back function uses for process server response which will store inside variable result
                $('#mulImages').html(response);
            },
            error : function (err){
            	 $('#mulImages').html(err);
            }
	    });	    
	});  

    $('#mulImages').on("click",".imgssl", function(event){
    	// alert($(this).attr('href'));
	    event.preventDefault(); 
	    $.ajax({
	        url: 'class/API.php',
	        type : "post",			// post method
            dataType : "text",		// data type of server respose
            data : {				// list of arguments will be sent to server

            	location : $(this).attr('href')
            },
            success : function(response){	// call-back function uses for process server response which will store inside variable result
                $('#mulImages').html(response);
            },
            error : function (err){
            	 $('#mulImages').html(err);
            }
	    });
	    return false; // for good measure
	});

	$('#btn_slmulimg').click(function(){
		 $.ajax({
	        url: 'class/API.php',
	        type : "post",			// post method
            dataType : "text",		// data type of server respose
            data : {				// list of arguments will be sent to server

            	location : 'images'
            },
            success : function(response){	// call-back function uses for process server response which will store inside variable result
                $('#mulImages').html(response);
            },
            error : function (err){
            	 $('#mulImages').html(err);
            }
	    });	    
	});

</script> 

