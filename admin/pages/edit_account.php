<?php 
require_once ('./class/Process_account.php');
require_once ('./class/Validation.php');

$process_account = new Process_account();
$validation = new Validation();

// define variables and set to empty values
$emailErr = $ho_tenErr = $dia_chiErr = $ma_nhomErr = $trang_thaiErr = '';
$email = $ho_ten = $dia_chi = $ma_nhom = $trang_thai = '';

$ma = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(empty($_POST['email'])){
        $emailErr = "Email là bắt buộc";
    } else {
        $email = $validation->test_input($_POST['email']);
        // kiểm tra $email có đúng quy tắc hay không
        if (!$validation->isEmail($email)){
            $emailErr = "Email không hợp lệ";
        } else {
            // kiểm tra $email đã tồn tại trong database chưa; true nếu tồn tại
            if ($process_account->isEmail($email)){
                $id = $process_account->getIDofEmail($email);
                if ($id[0]->ma !== $ma)
                    $emailErr = "Email đã tồn tại";
            }
        }
    }    

    if(empty($_POST['ho_ten'])){
        $ho_tenlErr = "Họ tên là bắt buộc";
    } else {
        $ho_ten = $validation->test_input($_POST['ho_ten']);        
    }

    $dia_chi = $validation->test_input($_POST['dia_chi']);
    
    if(empty($_POST['ma_nhom'])){
        $ma_nhomErr = "Mã nhóm là bắt buộc";
    } else {
        $ma_nhom = $validation->test_input($_POST['ma_nhom']);
        // kiểm tra $email có đúng quy tắc hay không
        if (!$validation->isNumber($ma_nhom)){
            $ma_nhomErr = "Mã nhóm không hợp lệ";
        } 
    }
    
    if(empty($_POST['trang_thai']) && $_POST['trang_thai'] !== '0'){
        $trang_thaiErr = "Trạng thái là bắt buộc";
    } else {
        $trang_thai = $validation->test_input($_POST['trang_thai']);                 
        // kiểm tra $email có đúng quy tắc hay không
        if (!$validation->isNumber($trang_thai)){
            $mtrang_thaiErr = "Trạng thái không hợp lệ";
        }        
    }
    
    if (!($emailErr || $ho_tenErr || $dia_chiErr || $ma_nhomErr || $trang_thaiErr)){             
        $ngay_cap_nhat = date("Y-m-d h:m:s");       
        $process_account->updateAccount(array($email, $ho_ten, $dia_chi, $ma_nhom, $trang_thai , $ngay_cap_nhat, $ma));
        chuyentrang('?view=admin');
    }
}

?>

<?php
$action_link = htmlspecialchars($_SERVER["PHP_SELF"]) . '?view=edit_account&id='. $ma;
$account = $process_account->getAccountInfo($ma);

?>

<div class="edit_account" style="">    
    <form class="well form-horizontal" action="<?= $action_link; ?>" method="post">
        <fieldset class="creation-border">
            <legend class="creation-border">Thêm quản trị</legend>          
             <div class="form-group">
                <label class="col-md-2 control-label">Tên đăng nhập</label>
                <div class="col-md-8 inputGroupContainer">
                   <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="ten_dang_nhap" name="ten_dang_nhap" placeholder="" class="form-control" required="true" value="<?= $account->ten_dang_nhap; ?>" type="text" readonly></div>
                </div>
                <div class="col-md-2 error">
                    <p></p>
                </div>
             </div>
             
             <div class="form-group">
                <label class="col-md-2 control-label">Email</label>
                <div class="col-md-8 inputGroupContainer">
                   <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span><input id="email" name="email" placeholder="" class="form-control" required="true" value="<?= $account->email; ?>" type="email"></div>
                </div>
                <div class="col-md-2 error">
                    <p><?= $emailErr; ?></p>
                </div>
             </div>    
             <div class="form-group">
                <label class="col-md-2 control-label">Họ tên</label>
                <div class="col-md-8 inputGroupContainer">
                   <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="ho_ten" name="ho_ten" placeholder="" class="form-control" required="true" value="<?= $account->ho_ten; ?>" type="text"></div>
                </div>
                <div class="col-md-2 error">
                    <p><?= $ho_tenErr; ?></p>
                </div>
             </div>             
             <div class="form-group">
                <label class="col-md-2 control-label">Địa chỉ</label>
                <div class="col-md-8 inputGroupContainer">
                   <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span><input id="dia_chi" name="dia_chi" placeholder="" class="form-control" value="<?= $account->dia_chi; ?>" type="text"></div>
                </div>
                <div class="col-md-2 error">
                    <p><?= $dia_chiErr; ?></p>
                </div>
             </div>
             <div class="form-group">
                <label class="col-md-2 control-label">Mã nhóm</label>
                <div class="col-md-8 inputGroupContainer">                   
                   <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span><select id="ma_nhom" name="ma_nhom" class="form-control">
                    <?php 
                    $ma_nhoms = [1,2,3];                   
                    foreach ($ma_nhoms as $item){
                        $selectVar = $account->ma_nhom == $item ? 'selected' : '';
                        echo '<option '.$selectVar.' value="'. $item .'">'.   $item .'</option>'; 
                    }
                    ?>
                   </select></div>
                </div>
                <div class="col-md-2 error">
                    <p><?= $ma_nhomErr; ?></p>
                </div>
             </div>
             
             <div class="form-group">
                <label class="col-md-2 control-label">Trạng Thái</label>
                <div class="col-md-8 inputGroupContainer">
                   <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-star"></i></span><select id="trang_thai" name="trang_thai" class="form-control">
                        <?php 
                        $trang_thais = [0,1];
                        foreach ($trang_thais as $item){
                            $selectVar = $account->trang_thai == $item ? 'selected' : '';
                            echo '<option '.$selectVar.' value="'. $item .'">'.   $item .'</option>'; 
                        }
                        ?>                
                   </select></div>
                </div>
                <div class="col-md-2 error">
                    <p><?= $trang_thaiErr; ?></p>
                </div>
            </div>            
            <div class="form-group" >
                <div class="col-sm-4 col-xs-4" style="text-align: right;">
                    <button type="submit" class="btn btn-success" name="" id="">Update</button>
                </div>
                <div class="col-sm-offset-4 col-xs-offset-8">
                    <a class="btn btn-default" name="cancel" id="cancel" href="?view=admin">Cancel</a>
                </div>
                
            </div>                      
        </fieldset>
    </form>   
</div>
