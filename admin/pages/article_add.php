<?php 
require_once ('./libs/funcs.php');
require_once ('./class/Articles.php');
require_once ('./class/DatabaseFuncs.php');
require_once ('./class/Validation.php');

$articles = new Articles();
$validation = new Validation(); 
$databaseFuncs = new DatabaseFuncs();

// define variables and set to empty values
$input = array("alias"=>NULL, "ten"=>NULL, "tieu_de"=>NULL, "mo_ta"=>NULL, "tu_khoa"=>NULL, "hinh"=>NULL, "hinh_chia_se"=>NULL, "tom_tat"=>NULL, "chi_tiet"=>NULL, "ma_nhom_tin"=>NULL, "trang_thai"=>NULL, "ngay_tao"=>NULL, "ngay_cap_nhat"=>NULL);

$aliasErr=$tenErr=$tieu_deErr=$mo_taErr=$tu_khoaErr=$hinhErr=$hinh_chia_seErr=$tom_tatErr=$chi_tietErr=$ma_nhom_tinErr=$trang_thaiErr='';
$hinhArr=$hinh_chia_seArr=array();
$hinhErrArr=$hinh_chia_seErrArr=array();
$feedback = NULL;
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['article_add']) && $_POST['article_add']) {  

        if(isset($_POST['alias']) && $_POST['alias']){
            $input['alias'] = $validation->test_input($_POST['alias']);
        } else {
            $aliasErr = '* Có lỗi xảy ra';
        }

        if(isset($_POST['ten']) && $_POST['ten']){
            $input['ten'] = $validation->test_input($_POST['ten']);          
        } else {
            $tenErr = '* Có lỗi xảy ra';         
        }

        if(isset($_POST['tieu_de']) && $_POST['tieu_de']){
            $input['tieu_de'] = $validation->test_input($_POST['tieu_de']);
        } else {
            $tieu_deErr = '* Có lỗi xảy ra';
        }

        if(isset($_POST['mo_ta']) && $_POST['mo_ta']){
            $input['mo_ta'] = $validation->test_input($_POST['mo_ta']);            
        } else {
            $mo_taErr = '* Có lỗi xảy ra';
        }

        if(isset($_POST['tu_khoa']) && $_POST['tu_khoa']){
            $input['tu_khoa'] = $validation->test_input($_POST['tu_khoa']);
        } else {
            $tu_khoaErr = '* Có lỗi xảy ra';
        }

        if(isset($_FILES['hinh']) && !($_FILES['hinh']['error'][0]>0)){                     
            $result = myuploads($_FILES['hinh'], ARTICLE_PATH,$hinhArr,$hinhErrArr,'h_');
            if($result){                
                $input['hinh'] = implode("|",$hinhArr);                
                $hinhErr = implode("|",$hinhErrArr);                  
            } else {
                $hinhErr = 'Kiểm tra việc chọn file';
            }
        }

        if(isset($_FILES['hinh_chia_se']) && !($_FILES['hinh_chia_se']['error'][0]>0)){
            $result = myuploads($_FILES['hinh_chia_se'], ARTICLE_PATH,$hinh_chia_seArr,$hinh_chia_seErrArr,'hcs');
            if($result){                
                $input['hinh_chia_se'] = implode("|",$hinh_chia_seArr);                
                $hinh_chia_seErr = implode("|",$hinh_chia_seErrArr);                   
            } else {
                $hinh_chia_seErr = 'Kiểm tra việc chọn file';
            }
        }

        if(isset($_POST['tom_tat']) && $_POST['tom_tat']){
            $input['tom_tat'] = $validation->test_input($_POST['tom_tat']);
        } else {
            $tom_tatErr = '* Có lỗi xảy ra';
        }

        if(isset($_POST['chi_tiet']) && $_POST['chi_tiet']){
            $input['chi_tiet'] = $validation->test_input($_POST['chi_tiet']);
        } else {
            $chi_tietErr = '* Có lỗi xảy ra';
        }

        if(empty($_POST['ma_nhom_tin']) && $_POST['ma_nhom_tin'] !== '0'){
            $ma_nhom_tinErr = '* Có lỗi xảy ra';                     
        } else {
            $input['ma_nhom_tin'] = $validation->test_input($_POST['ma_nhom_tin']);
            if (!$validation->isNumber($input['ma_nhom_tin'])){
                $input['ma_nhom_tin'] = '';
                $ma_nhom_tinErr = "Mã nhóm tin không hợp lệ";
            }           
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

        if(!($aliasErr||$tenErr||$tieu_deErr||$mo_taErr||$tu_khoaErr||$tom_tatErr||$chi_tietErr||$ma_nhom_tinErr||$trang_thaiErr)){
            $input['ngay_tao'] = date('Y-m-d H:i:s');            
            $kq = $databaseFuncs->create('articles',$input);
            if($kq){
                foreach($input as $key => $val){
                    $input[$key] = NULL;
                }
                 $feedback = '<h4 style="color:blue"><i>Thêm vào database thành công</i></h4>';
            } else 
                 $feedback = '<h4><i>Thêm vào database Thất Bại</i></h4>';
        }         
    }
}

?>

<div class="article_add" style="">	
	<form class="well form-horizontal" method="post" enctype="multipart/form-data">
        <fieldset class="creation-border">
            <legend class="creation-border">
                <div class="pull-left">Thêm bản tin </div>
                <div class="pull-right"><?= $feedback ?></div>       
            </legend>

			<div class="form-group">
                <label class="col-md-2 control-label">Alias</label>
                <div class="col-md-8">
                   <input id="alias" name="alias" class="form-control smtp" type="text" required value="<?= $input['alias'] ?>">
                </div>
                <div class="col-md-2 error">
                    <p><?= $aliasErr ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Tên bản tin</label>
                <div class="col-md-8">
                   <input id="ten" name="ten" class="form-control smtp" type="text" required value="<?= $input['ten'] ?>">
                </div>
                <div class="col-md-2 error">
                    <p><?= $tenErr ?></p>
                </div>
            </div>  

            <div class="form-group">
                <label class="col-md-2 control-label">Hình</label>
                <div class="col-md-8">
                   <input id="hinh" name="hinh[]" class="form-control smtp" type="file" multiple="multiple">
                </div>
                <div class="col-md-2 error">
                    <p><?= $hinhErr ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Tóm tắt</label>
                <div class="col-md-8">
                   <textarea rows="3" id="tom_tat" name="tom_tat" class="form-control smtp" type="text" required ><?= $input['tom_tat'] ?></textarea>
                </div>
                <div class="col-md-2 error">
                    <p><?= $tom_tatErr ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Chi tiết</label>
                <div class="col-md-8">                  
                   <?php
                    echo ckeditor("chi_tiet", $input['chi_tiet']);
                    ?>
                </div>
                <div class="col-md-2 error">
                    <p><?= $chi_tietErr ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Mã nhóm tin</label>
                <div class="col-md-8">                    
                    <select id="ma_nhom_tin" name="ma_nhom_tin" class="form-control">
                    <?php
                    $article_group = $databaseFuncs->read('article_group',array('ma','ten'));
                    foreach($article_group as $article){
                        $selectVar = $input['ma_nhom_tin'] == $article->ma ? 'selected' : '';
                        echo '<option '.$selectVar.' value="'. $article->ma .'">'.   $article->ten .'</option>';
                    }
                    ?>  
                    </select>
                    <!-- <option value="<?= $article->ma ?>"><?= $article->ten ?></option> -->
                </div>
                <div class="col-md-2 error">
                    <p><?= $ma_nhom_tinErr ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Trạng thái</label>
                <div class="col-md-8">
                   <select id="trang_thai" name="trang_thai" class="form-control">
                       <?php 
                        $trang_thais = [0,1,2];
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
        </fieldset>
        <!-- =============================================== -->
        <fieldset class="creation-border">
            <legend class="creation-border">
                <div class="pull-left">SEO </div>
            </legend>

            <div class="form-group">
                <label class="col-md-2 control-label">Tiêu đề</label>
                <div class="col-md-8">
                   <input id="tieu_de" name="tieu_de" class="form-control smtp" type="text" value="<?= $input['tieu_de'] ?>">
                </div>
                <div class="col-md-2 error">
                    <p><?= $tieu_deErr ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Từ khóa</label>
                <div class="col-md-8">
                   <input id="tu_khoa" name="tu_khoa" class="form-control smtp" type="text" value="<?= $input['tu_khoa'] ?>">
                </div>
                <div class="col-md-2 error">
                    <p><?= $tu_khoaErr ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Mô tả</label>
                <div class="col-md-8">
                   <textarea id="mo_ta" name="mo_ta" class="form-control smtp" type="text" rows="5"><?= $input['mo_ta'] ?></textarea>
                </div>
                <div class="col-md-2 error">
                    <p><?= $mo_taErr ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Hình chia sẻ</label>
                <div class="col-md-8">
                    <input id="hinh_chia_se" name="hinh_chia_se[]" class="form-control smtp" type="file" multiple="multiple" style="padding-left: 0">
                </div>
                <div class="col-md-2 error">
                    <p><?= $hinh_chia_seErr ?></p>
                </div>
            </div>
            
            <!-- =============================================== -->
            <div class="form-group" >
                <div class="col-md-8 col-md-offset-2">
                    <div class="pull-right" style="text-align: right;">
                        <button type="submit" class="btn btn-success" name="article_add" id="article_group_add" value="true">Add</button>
                        <a type="button" class="btn btn-default" href="?view=article">Cancel</a>
                    </div>
                </div>      
            </div>                      
        </fieldset>
    </form>
</div>
