<?php 
require_once ('./libs/funcs.php');
require_once ('./class/Article_group.php');
require_once ('./class/Validation.php');

$articles = new Article_group();
$validation = new Validation(); 
// define variables and set to empty values
$ten=$ma_cha=$alias=$tieu_de=$tu_khoa=$mo_ta=$hinh_chia_se=$trang_thai=$ngay_tao='';
$tenErr=$ma_chaErr=$aliasErr=$tieu_deErr=$tu_khoaErr=$mo_taErr=$trang_thaiErr='';
$hinh_chia_seErr='';    // upload nhiều hình sẽ tính sau

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['article_group_add']) && $_POST['article_group_add']) {             
        if(isset($_POST['ten']) && $_POST['ten']){
            $ten = $validation->test_input($_POST['ten']);          
        } else {
            $tenErr = '* Xin kiểm tra lại';         
        }

        if(empty($_POST['ma_cha']) && $_POST['ma_cha'] !== '0' ){
            $ma_chaErr = '* Xin kiểm tra lại';
        } else {             
            $ma_cha = $validation->test_input($_POST['ma_cha']);
            if (!$validation->isNumber($ma_cha)){
            $ma_chaErr = "Mã cha không hợp lệ";
        }         
        }

        if(isset($_POST['alias']) && $_POST['alias']){
            $alias = $validation->test_input($_POST['alias']);
        } else {
            $aliasErr = '* Xin kiểm tra lại';
        }

        if(isset($_POST['tieu_de']) && $_POST['tieu_de']){
            $tieu_de = $validation->test_input($_POST['tieu_de']);
        } else {
            $tieu_deErr = '* Xin kiểm tra lại';
        }

        if(isset($_POST['tu_khoa']) && $_POST['tu_khoa']){
            $tu_khoa = $validation->test_input($_POST['tu_khoa']);
        } else {
            $tu_khoaErr = '* Xin kiểm tra lại';
        }

        if(isset($_POST['mo_ta']) && $_POST['mo_ta']){
            $mo_ta = $validation->test_input($_POST['mo_ta']);            
        } else {
            $mo_taErr = '* Xin kiểm tra lại';
        }        
        

        if(empty($_POST['trang_thai']) && $_POST['trang_thai'] !== '0'){
            $trang_thaiErr = '* Xin kiểm tra lại';                     
        } else {
            $trang_thai = $validation->test_input($_POST['trang_thai']);
            if (!$validation->isNumber($trang_thai)){
                $trang_thaiErr = "Trạng thái không hợp lệ";
            }           
        }

        if(isset($_FILES['hinh_chia_se'])){            
            if(!($tenErr||$ma_chaErr||$aliasErr||$tieu_deErr||$tu_khoaErr||$mo_taErr||$trang_thaiErr)){
                $result = upload_file($_FILES['hinh_chia_se'], ARTICLE_PATH, $alias, ARTICLE_SIZE);
                if($result['error']){
                    $hinh_chia_seErr = $result['msg'];                
                } else {                
                    $hinh_chia_se = $validation->test_input($result['msg']); 
                    echo '<script type="text/javascript">alert("hinh_chia_se => '. $hinh_chia_se .'")</script>';                        
                    $ngay_tao = date('Y-m-d H:i:s');
                    $creation = $articles->add_article_group(array($ten,$ma_cha,$alias,$tieu_de,$tu_khoa,$mo_ta,$hinh_chia_se,$trang_thai,$ngay_tao,NULL));
                    if($creation){                
                        echo '<script type="text/javascript">alert("'. 'Thêm nhóm tin vào database thành công' .'")</script>';
                    } else {
                        echo '<script type="text/javascript">alert("'. 'Thêm nhóm tin vào database THẤT BẠI' .'")</script>';
                    }                            
                    chuyentrang('?view=article_group');
                }
            }
        } else {
            if(!($tenErr||$ma_chaErr||$aliasErr||$tieu_deErr||$tu_khoaErr||$mo_taErr||$trang_thaiErr)){
                $hinh_chia_se = NULL;
                $ngay_tao = date('Y-m-d H:i:s');
                $creation = $articles->add_article_group(array($ten,$ma_cha,$alias,$tieu_de,$tu_khoa,$mo_ta,$hinh_chia_se,$trang_thai,$ngay_tao,NULL));
                if($creation){                
                    echo '<script type="text/javascript">alert("'. 'Thêm nhóm tin vào database thành công' .'")</script>';
                } else {
                    echo '<script type="text/javascript">alert("'. 'Thêm nhóm tin vào database THẤT BẠI' .'")</script>';
                }                            
                chuyentrang('?view=article_group');                
            }
        }
    }
}

?>

<div class="article_group_add" style="">	
	<form class="well form-horizontal" method="post" enctype="multipart/form-data">
        <fieldset class="creation-border">
            <legend class="creation-border">
                <div class="pull-left">Thêm nhóm tin </div>
                <!-- <div class="pull-right"><input type="button" class="btn btn-info" id="smtp_edit" name="smtp_edit" value="Edit"></div> -->       
            </legend>        

            <div class="form-group">
                <label class="col-md-2 control-label">Tên nhóm tin</label>
                <div class="col-md-8">
                   <input id="ten" name="ten" class="form-control smtp" type="text" required value="<?= $ten ?>">
                </div>
                <div class="col-md-2 error">
                    <p><?= $tenErr ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Mã cha</label>
                <div class="col-md-8">
                   <input id="ma_cha" name="ma_cha" class="form-control smtp" type="text" required value="<?= $ma_cha ?>">
                </div>
                <div class="col-md-2 error">
                    <p><?= $ma_chaErr ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Alias</label>
                <div class="col-md-8">
                   <input id="alias" name="alias" class="form-control smtp" type="text" required value="<?= $alias ?>">
                </div>
                <div class="col-md-2 error">
                    <p><?= $aliasErr ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Tiêu đề</label>
                <div class="col-md-8">
                   <input id="tieu_de" name="tieu_de" class="form-control smtp" type="text" required value="<?= $tieu_de ?>">
                </div>
                <div class="col-md-2 error">
                    <p><?= $tieu_deErr ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Từ khóa</label>
                <div class="col-md-8">
                   <input id="tu_khoa" name="tu_khoa" class="form-control smtp" type="text" required value="<?= $tu_khoa ?>">
                </div>
                <div class="col-md-2 error">
                    <p><?= $tu_khoaErr ?></p>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label">Mô tả</label>
                <div class="col-md-8">
                   <textarea rows="5" id="mo_ta" name="mo_ta" class="form-control smtp" type="text" required ><?= $mo_ta ?></textarea>
                </div>
                <div class="col-md-2 error">
                    <p><?= $mo_taErr ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Hình chia sẻ</label>
                <div class="col-md-8">
                   <input id="hinh_chia_se" name="hinh_chia_se" class="form-control smtp" type="file" style="padding-left: 0">
                </div>
                <div class="col-md-2 error">
                    <p><?= $hinh_chia_seErr ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Trạng thái</label>
                <div class="col-md-8">
                   <select id="trang_thai" name="trang_thai" class="form-control">
                       <?php 
                        $trang_thais = [0,1,2];
                        foreach ($trang_thais as $item){
                            $selectVar = $trang_thai == $item ? 'selected' : '';
                            echo '<option '.$selectVar.' value="'. $item .'">'.   $item .'</option>'; 
                        }
                        ?>
                   </select>
                </div>
                <div class="col-md-2 error">
                    <p><?= $trang_thaiErr ?></p>
                </div>
            </div>

             <!-- inputGroupContainer -->
            <div class="form-group" >
                <div class="col-md-8 col-md-offset-2">
                    <div class="pull-right" style="text-align: right;">
                        <button type="submit" class="btn btn-success" name="article_group_add" id="article_group_add" value="true">Add</button>
                        <a type="button" class="btn btn-default" href="?view=article_group">Cancel</a>
                    </div>
                </div>      
            </div>                      
        </fieldset>
    </form>
</div>
