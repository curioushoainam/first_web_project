<?php 
require_once ('./libs/funcs.php');
require_once ('./class/Articles.php');
require_once ('./class/DatabaseFuncs.php');
require_once ('./class/Validation.php');

$articles = new Articles();
$validation = new Validation(); 
$databaseFuncs = new DatabaseFuncs();

// define variables and set to empty values
$input = array("alias"=>NULL, "ten"=>NULL, "tieu_de"=>NULL, "mo_ta"=>NULL, "tu_khoa"=>NULL, "tom_tat"=>NULL, "chi_tiet"=>NULL, "ma_nhom_tin"=>NULL, "trang_thai"=>NULL, "ngay_cap_nhat"=>NULL);

$input2 = array("hinh"=>NULL, "hinh_chia_se"=>NULL);
$aliasErr=$tenErr=$tieu_deErr=$mo_taErr=$tu_khoaErr=$hinhErr=$hinh_chia_seErr=$tom_tatErr=$chi_tietErr=$ma_nhom_tinErr=$trang_thaiErr='';
$hinhArr=$hinh_chia_seArr=array();
$hinhErrArr=$hinh_chia_seErrArr=array();

$feedback = $feedback2 = NULL;

if(isset($_GET['id']) && $_GET['id']){
    $data = $databaseFuncs->read('articles',array('*'),array('ma'=>$_GET['id']));
    // viewArr($data);    
    $input["alias"] = isset($data[0]->alias) ? $data[0]->alias : NULL;
    $input["ten"] = isset($data[0]->ten) ? $data[0]->ten : NULL;
    $input["tieu_de"] = isset($data[0]->tieu_de) ? $data[0]->tieu_de : NULL;
    $input["mo_ta"] = isset($data[0]->mo_ta) ? $data[0]->mo_ta : NULL;
    $input["tu_khoa"] = isset($data[0]->tu_khoa) ? $data[0]->tu_khoa : NULL;
    $input["tom_tat"] = isset($data[0]->tom_tat) ? $data[0]->tom_tat : NULL;
    $input["chi_tiet"] = isset($data[0]->chi_tiet) ? $data[0]->chi_tiet : NULL;
    $input["ma_nhom_tin"] = isset($data[0]->ma_nhom_tin) ? $data[0]->ma_nhom_tin : NULL;
    $input["trang_thai"] = isset($data[0]->trang_thai) ? $data[0]->trang_thai : NULL;
    $input["ngay_cap_nhat"] = isset($data[0]->ngay_cap_nhat) ? $data[0]->ngay_cap_nhat : NULL;
    $input["trang_thai"] = isset($data[0]->trang_thai) ? $data[0]->trang_thai : NULL;
    $input["ngay_cap_nhat"] = isset($data[0]->ngay_cap_nhat) ? $data[0]->ngay_cap_nhat : NULL;
    
    $input2["hinh"] = isset($data[0]->hinh) ? $data[0]->hinh : NULL;
    $input2["hinh_chia_se"] = isset($data[0]->hinh_chia_se) ? $data[0]->hinh_chia_se : NULL;
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['article_update']) && $_POST['article_update']) {  

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
            $input['ngay_cap_nhat'] = date('Y-m-d H:i:s');            
            $kq = $databaseFuncs->update('articles',$input,array('ma'=>$_GET['id']));
            if($kq){
                foreach($input as $key => $val){
                    $input[$key] = NULL;
                }
                 $feedback = '<h4 style="color:blue"><i>Cập nhật vào database thành công</i></h4>';
            } else 
                 $feedback = '<h4 style="color:red"><i>Cập nhật vào database Thất Bại</i></h4>';
        }         
    }
}

?>

<div class="article_edit" style="">
    <div class="text-center"><?= $feedback ?></div>
	<form class="well form-horizontal" method="post" enctype="multipart/form-data">
        <fieldset class="creation-border">
            <legend class="creation-border">
                <div class="pull-left"><span><a href="?view=article">Bản tin  </a></span> >>  Thêm bản tin </div>
                <div class="pull-right"><input type="button" class="btn btn-info" id="article_edit" name="article_edit" value="Edit"></div>
            </legend>            
			<div class="form-group">
                <label class="col-md-2 control-label">Alias</label>
                <div class="col-md-8">
                   <input id="alias" name="alias" class="form-control lock" type="text" required value="<?= $input['alias'] ?>">
                </div>
                <div class="col-md-2 error">
                    <p><?= $aliasErr ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Tên bản tin</label>
                <div class="col-md-8">
                   <input id="ten" name="ten" class="form-control lock" type="text" required value="<?= $input['ten'] ?>">
                </div>
                <div class="col-md-2 error">
                    <p><?= $tenErr ?></p>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Tóm tắt</label>
                <div class="col-md-8">
                   <textarea rows="3" id="tom_tat" name="tom_tat" class="form-control lock" type="text" required ><?= $input['tom_tat'] ?></textarea>
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
                    <select id="ma_nhom_tin" name="ma_nhom_tin" class="form-control lock">
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
                   <select id="trang_thai" name="trang_thai" class="form-control lock">
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
        </fieldset>
        <!-- =============================================== -->
        <fieldset class="creation-border">
            <legend class="creation-border">
                <div class="pull-left">SEO </div>
            </legend>

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
            <div class="form-group" >
                <div class="col-md-8 col-md-offset-2">
                    <div class="pull-right" style="text-align: right;">
                        <button type="submit" class="btn btn-success" name="article_update" id="article_update" value="true">Update</button>
                        <a type="button" class="btn btn-default" href="<?= htmlspecialchars($_SERVER["PHP_SELF"]).'?view='.$_GET['view'].'&id='.$_GET['id']; ?>" >Cancel</a>
                    </div>
                </div>      
            </div>                      
        </fieldset>
    </form>
<!-- ===========================================================================     -->

<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['article_update_h']) && $_POST['article_update_h']) {    
        
        if(!(empty($_POST['hinh_prv']) && $_POST['hinh_prv'] != false)){            
            $input2['hinh'] = $validation->test_input($_POST['hinh_prv']);            
        }
        
        if(isset($_FILES['hinh']) && !($_FILES['hinh']['error'][0]>0)){                       
            $result = myuploads($_FILES['hinh'], ARTICLE_PATH,$hinhArr,$hinhErrArr,'h_');
            if($result){                
                $input2['hinh'] .= implode("|",$hinhArr);
                $hinhErr = implode("|",$hinhErrArr);                               
            } else {
                $hinhErr = 'Kiểm tra việc chọn file';
            }
        }

        if(!(empty($_POST['hinh_chia_se_prv']) && $_POST['hinh_chia_se_prv'] != false)){
            $input2['hinh_chia_se'] = $validation->test_input($_POST['hinh_chia_se_prv']);
        }

        if(isset($_FILES['hinh_chia_se']) && !($_FILES['hinh_chia_se']['error'][0]>0)){             
            $result = myuploads($_FILES['hinh_chia_se'], ARTICLE_PATH,$hinh_chia_seArr,$hinh_chia_seErrArr,'hcs');
            if($result){                
                $input2['hinh_chia_se'] .= implode("|",$hinh_chia_seArr);              
                $hinh_chia_seErr = implode("|",$hinh_chia_seErrArr);                   
            } else {
                $hinh_chia_seErr = 'Kiểm tra việc chọn file';
            }
        }
        
        $input2['ngay_cap_nhat'] = date('Y-m-d H:i:s');                    
        $kq = $databaseFuncs->update('articles',$input2,array('ma'=>$_GET['id']));
        if($kq){
            foreach($input as $key => $val){
                $input[$key] = NULL;
            }
             $feedback2 = '<h4 style="color:blue"><i>Hình cập nhật vào database thành công</i></h4>';
        } else 
             $feedback2 = '<h4 style="color:red"><i>Hình cập nhật vào database Thất Bại</i></h4>';
                 
    }
}

?>
    <div class="text-center"><?= $feedback2 ?></div>
    <form class="well form-horizontal" method="post" enctype="multipart/form-data">
        <fieldset class="creation-border">
            <legend class="creation-border">
                <div class="pull-left"><span><a href="?view=article">Bản tin  </a></span> >>  Cập nhật hình ảnh</div>
                <div class="pull-right"><input type="button" class="btn btn-info" id="article_edit_h" name="article_edit_h" value="Edit"></div>
            </legend>            
            <div class="form-group">
                <label class="col-md-2 control-label">Hinh đã up</label>
                <div class="col-md-8">
                   <input id="hinh_prv" name="hinh_prv" class="form-control lock2" type="text" value="<?= $input2['hinh'] ?>">
                </div>                
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Cập nhật hình mới</label>
                <div class="col-md-8">
                   <input id="hinh" name="hinh[]" class="form-control lock2" type="file" multiple="multiple">
                </div>
                <div class="col-md-2 error">
                    <p><?= $hinhErr ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Hinh chia sẻ đã up</label>
                <div class="col-md-8">
                   <input id="hinh_chia_se_prv" name="hinh_chia_se_prv" class="form-control lock2" type="text" value="<?= $input2['hinh_chia_se'] ?>">
                </div>
                <div class="col-md-2 error">
                    <p><?= $aliasErr ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Hình chia sẻ</label>
                <div class="col-md-8">
                    <input id="hinh_chia_se" name="hinh_chia_se[]" class="form-control lock2" type="file" multiple="multiple" style="padding-left: 0">
                </div>
                <div class="col-md-2 error">
                    <p><?= $hinh_chia_seErr ?></p>
                </div>
            </div>
            <!-- =============================================== -->
            <div class="form-group" >
                <div class="col-md-8 col-md-offset-2">
                    <div class="pull-right" style="text-align: right;">
                        <button type="submit" class="btn btn-success" name="article_update_h" id="article_update_h" value="true">Update</button>
                        <a type="button" class="btn btn-default" href="<?= htmlspecialchars($_SERVER["PHP_SELF"]).'?view='.$_GET['view'].'&id='.$_GET['id']; ?>">Cancel</a>
                    </div>
                </div>      
            </div>                      
        </fieldset>
    </form>
</div>


<!-- ===========================================================================     -->
<script>
    $(document).ready(function(){
        $('.lock').attr('readonly', 'readonly');
        $("#article_update").hide();

        $("#article_edit").click(function(){           
            $('.lock').removeAttr('readonly');          
            $("#article_update").show();           
            $("#article_edit").hide();
        });

        $('.lock2').attr('readonly', 'readonly'); 
        $("#article_update_h").hide();
        $("#article_edit_h").click(function(){           
            $('.lock2').removeAttr('readonly');          
            $("#article_update_h").show();           
            $("#article_edit_h").hide();
        });
    });
</script>
