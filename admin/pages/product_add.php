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

        if(isset($_POST['danh_sach_hinh'])){
            $input['danh_sach_hinh'] = $validation->test_input($_POST['danh_sach_hinh']);
        } else {
            $danh_sach_hinhErr = '* Có lỗi xảy ra';
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

        if(isset($_FILES['hinh']) && !($_FILES['hinh']['error'][0]>0)){                       
            $result = myuploads($_FILES['hinh'], PRODUCT_PATH,$hinhArr,$hinhErrArr);
            if($result){                
                $input['hinh'] .= implode("|",$hinhArr);
                $hinhErr = implode("|",$hinhErrArr);                               
            } else {
                $hinhErr = 'Kiểm tra việc chọn file';
            }
        }

        if(isset($_FILES['hinh_chia_se']) && !($_FILES['hinh_chia_se']['error'][0]>0)){             
            $result = myuploads($_FILES['hinh_chia_se'], PRODUCT_PATH,$hinh_chia_seArr,$hinh_chia_seErrArr);
            if($result){                
                $input['hinh_chia_se'] .= implode("|",$hinh_chia_seArr);              
                $hinh_chia_seErr = implode("|",$hinh_chia_seErrArr);                   
            } else {
                $hinh_chia_seErr = 'Kiểm tra việc chọn file';
            }
        }
viewArr($input);
        if(!($tenErr||$aliasErr||$ma_nhomErr||$noi_dung_chi_tietErr||$noi_dung_tom_tatErr||$danh_sach_hinhErr||$tieu_deErr||$tu_khoaErr||$mo_taErr||$ma_loaiErr||$so_luongErr||$don_giaErr||$trang_thaiErr)){

            $input['ngay_tao'] = date('Y-m-d H:i:s');
viewArr($input);                       
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

<div class="product_edit" style="">
    <div class="text-center"><?= $feedback ?></div>
	<form class="well form-horizontal" method="post" enctype="multipart/form-data">
        <fieldset class="creation-border">
            <legend class="creation-border">
                <div class="pull-left"><span><a href="?view=product">Sản phẩm  </a></span> >>  Thêm sản phẩm </div>
                <!-- <div class="pull-right"><input type="button" class="btn btn-info" id="edit" name="edit" value="Edit"></div> -->
            </legend>
            <div class="form-group">
                <label class="col-md-2 control-label">Tên sản phẩm</label>
                <div class="col-md-8">
                   <input id="ten" name="ten" class="form-control" type="text" required value="<?= $input['ten'] ?>">
                </div>
                <div class="col-md-2 error">
                    <p><?= $tenErr ?></p>
                </div>
            </div>            
			<div class="form-group">
                <label class="col-md-2 control-label">Alias</label>
                <div class="col-md-8">
                   <input id="alias" name="alias" class="form-control" type="text" required value="<?= $input['alias'] ?>">
                </div>
                <div class="col-md-2 error">
                    <p><?= $aliasErr ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Mã nhóm</label>
                <div class="col-md-8">                    
                    <select id="ma_nhom" name="ma_nhom" class="form-control">
                    <?php
                    $product_group = $databaseFuncs->read('product_group',array('ma','ten'));
                    foreach($product_group as $item){
                        $selectVar = $input['ma_nhom'] == $item->ma ? 'selected' : '';
                        echo '<option '.$selectVar.' value="'. $item->ma .'">'.   $item->ten .'</option>';
                    }
                    ?>  
                    </select>
                    <!-- <option value="<?= $article->ma ?>"><?= $article->ten ?></option> -->
                </div>
                <div class="col-md-2 error">
                    <p><?= $ma_nhomErr ?></p>
                </div>
            </div>     

            <div class="form-group">
                <label class="col-md-2 control-label">Tóm tắt</label>
                <div class="col-md-8">
                   <textarea rows="3" id="noi_dung_tom_tat" name="noi_dung_tom_tat" class="form-control" type="text"><?= $input['noi_dung_tom_tat'] ?></textarea>
                </div>
                <div class="col-md-2 error">
                    <p><?= $noi_dung_tom_tatErr ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Chi tiết</label>
                <div class="col-md-8">                  
                   <?php
                    echo ckeditor("noi_dung_chi_tiet", $input['noi_dung_chi_tiet']);
                    ?>
                </div>
                <div class="col-md-2 error">
                    <p><?= $noi_dung_chi_tietErr ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Danh sách hình</label>
                <div class="col-md-8">
                   <input id="danh_sach_hinh" name="danh_sach_hinh" class="form-control" type="text" value="<?= $input['danh_sach_hinh'] ?>">
                </div>
                <div class="col-md-2 error">
                    <p><?= $danh_sach_hinhErr ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Mã loại</label>
                <div class="col-md-8">                    
                    <select id="ma_loai" name="ma_loai" class="form-control">
                    <?php
                    $product_catalog = $databaseFuncs->read('product_catalog',array('ma','ten'));
                    foreach($product_catalog as $item){
                        $selectVar = $input['ma_nhom'] == $item->ma ? 'selected' : '';
                        echo '<option '.$selectVar.' value="'. $item->ma .'">'.   $item->ten .'</option>';
                    }
                    ?>  
                    </select>
                    <!-- <option value="<?= $article->ma ?>"><?= $article->ten ?></option> -->
                </div>
                <div class="col-md-2 error">
                    <p><?= $ma_loaiErr ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Số lượng</label>
                <div class="col-md-8">
                   <input id="so_luong" name="so_luong" class="form-control" type="text" value="<?= $input['so_luong'] ?>">
                </div>
                <div class="col-md-2 error">
                    <p><?= $so_luongErr ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Đơn giá</label>
                <div class="col-md-8">
                   <input id="don_gia" name="don_gia" class="form-control" type="text" value="<?= $input['don_gia'] ?>">
                </div>
                <div class="col-md-2 error">
                    <p><?= $don_giaErr ?></p>
                </div>
            </div>            

            <div class="form-group">
                <label class="col-md-2 control-label">Trạng thái</label>
                <div class="col-md-8">
                   <select id="trang_thai" name="trang_thai" class="form-control">
                       <?php 
                        $trang_thais = [0,1];
                        foreach ($trang_thais as $item){
                            $selectVar = $input['trang_thai'] == $item ? 'selected' : '';
                            echo '<option '.$selectVar.' value="'. $item .'">'.   $item .'</option>'; 
                        }
                        ?>
                   </select>
                </div>
                <div class="col-md-2 error">
                    <p><?= $trang_thaiErr ?></p>
                </div>
            </div>            

       
        <!-- =============================================== -->
        <hr>        
            <legend class="creation-border">
                <div class="pull-left">SEO </div>
            </legend>
         <hr>
            <div class="form-group">
                <label class="col-md-2 control-label">Tiêu đề</label>
                <div class="col-md-8">
                   <input id="tieu_de" name="tieu_de" class="form-control lock" type="text" value="<?= $input['tieu_de'] ?>">
                </div>
                <div class="col-md-2 error">
                    <p><?= $tieu_deErr ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Từ khóa</label>
                <div class="col-md-8">
                   <input id="tu_khoa" name="tu_khoa" class="form-control lock" type="text" value="<?= $input['tu_khoa'] ?>">
                </div>
                <div class="col-md-2 error">
                    <p><?= $tu_khoaErr ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Mô tả</label>
                <div class="col-md-8">
                   <textarea id="mo_ta" name="mo_ta" class="form-control lock" type="text" rows="5"><?= $input['mo_ta'] ?></textarea>
                </div>
                <div class="col-md-2 error">
                    <p><?= $mo_taErr ?></p>
                </div>
            </div>

            <!-- =============================================== -->
        <hr>        
            <legend class="creation-border">
                <div class="pull-left">Hình ảnh </div>
            </legend>
        <hr>
            <div class="form-group">
                <label class="col-md-2 control-label">Cập nhật hình mới</label>
                <div class="col-md-8">
                   <input id="hinh" name="hinh[]" class="form-control" type="file" multiple="multiple"  style="padding-left: 0">
                </div>
                <div class="col-md-2 error">
                    <p><?= $hinhErr ?></p>
                </div>
            </div>            
            <div class="form-group">
                <label class="col-md-2 control-label">Hình chia sẻ</label>
                <div class="col-md-8">
                    <input id="hinh_chia_se" name="hinh_chia_se[]" class="form-control" type="file" multiple="multiple" style="padding-left: 0">
                </div>
                <div class="col-md-2 error">
                    <p><?= $hinh_chia_seErr ?></p>
                </div>
            </div>            

            <!-- =============================================== -->
            <div class="form-group" >
                <div class="col-md-8 col-md-offset-2">
                    <div class="pull-right" style="text-align: right;">
                        <button type="submit" class="btn btn-success" name="product_add" id="add" value="true">Create</button>
                        <a type="button" class="btn btn-default" href="?view=product" >Cancel</a>
                    </div>
                </div>      
            </div>                      
        </fieldset>
    </form>
</div>      
