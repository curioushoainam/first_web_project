<?php 
require_once ('./libs/funcs.php');
require_once ('./class/Process_account.php');
require_once ('./class/Validation.php');

// define variables and set to empty values
$ten_dang_nhapErr = $emailErr = $mat_khauErr = $avatar = $ho_tenErr = $dia_chiErr = $ma_nhomErr = $trang_thaiErr = '';
$ten_dang_nhap = $email = $mat_khau = $avatarErr = $ho_ten = $dia_chi = $ma_nhom = $trang_thai = '';
 
$process_account = new Process_account();
$validation = new Validation(); 

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty($_POST['ten_dang_nhap'])){
        $ten_dang_nhapErr = "Tên đăng nhập là bắt buộc";        
    } else {
        $ten_dang_nhap = $validation->test_input($_POST['ten_dang_nhap']);
        // kiểm tra $ten_dang_nhap có đúng quy tắc hay không
        if (!$validation->isCommonChars($ten_dang_nhap)){           
            $ten_dang_nhapErr = "Chỉ gồm chữ cái, chữ số và _";
            
        } else {
            // kiểm tra $ten_dang_nhap đã tồn tại trong database chưa; true nếu tồn tại
            $ten_dang_nhapErr . ' in ten_dang_nhapErr' ;
            if ($process_account->isAccount($ten_dang_nhap)){
                $ten_dang_nhapErr = "Tài khoản đã tồn tại";                
            }
        }
    }

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
                $emailErr = "Email đã tồn tại";
            }
        }
    }

    if(empty($_POST['mat_khau'])){
        $mat_khauErr = "Mật khẩu là bắt buộc";
    } else {
        $mat_khau = $validation->test_input($_POST['mat_khau']);
        // kiểm tra $email có đúng quy tắc hay không
        if (!$validation->isPassword($mat_khau)){
            $mat_khauErr = "Mật khẩu không hợp lệ";
        } else {
            $mat_khau = md5($mat_khau);
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

    if(empty($_POST['trang_thai'])){
        $trang_thailErr = "Trạng thái là bắt buộc";
    } else {
        $trang_thai = $validation->test_input($_POST['trang_thai']);        
        // kiểm tra $email có đúng quy tắc hay không
        if (!$validation->isNumber($trang_thai)){
            $mtrang_thaiErr = "Trạng thái không hợp lệ";
        } 
    }

    if (isset($_FILES['avatar'])){        
        if (!($ten_dang_nhapErr || $emailErr ||$mat_khauErr || $ho_tenErr || $dia_chiErr || $ma_nhomErr || $trang_thaiErr)){
            $result = upload_file($_FILES['avatar'], AVATAR_PATH, $ten_dang_nhap, AVATAR_SIZE); 
            if($result["error"])                         
                $_SESSION['msg'] = 'Avatar xảy ra lỗi => '.$result["msg"] .' <= Hãy vào edit để upload lại.';                 
             else 
                $avatar = $validation->test_input($result["msg"]);         
                                     
            $createdDate = date("Y-m-d h:m:s");
            $process_account->addAccount(array($ten_dang_nhap, $email, $mat_khau, $avatar, $ho_ten, $dia_chi, $ma_nhom, $trang_thai , $createdDate));                            
            chuyentrang('?view=admin');            
        }
    } else {         
        $avatarErr = "Hình làm avatar avatar không tồn tại";
    }
    
    // if (!($ten_dang_nhapErr || $emailErr || $mat_khauErr || $ho_tenErr || $dia_chiErr || $ma_nhomErr || $trang_thaiErr)){
    //      $createdDate = date("Y-m-d h:m:s");       
    //     $process_account->addAccount(array($ten_dang_nhap, $email, $mat_khau, $ho_ten, $dia_chi, $ma_nhom, $trang_thai , $createdDate));                            
    //     chuyentrang('?view=admin');        
    // } 
}
?>

<div class="add_account" style="">	
	<form class="well form-horizontal" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) . '?view=admin_add'; ?>" method="post" enctype="multipart/form-data">
		<fieldset class="creation-border">
			<legend class="creation-border">Thêm quản trị</legend>			
             <div class="form-group">
                <label class="col-md-2 control-label">Tên đăng nhập</label>
                <div class="col-md-8 inputGroupContainer">
                   <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="ten_dang_nhap" name="ten_dang_nhap" placeholder="" class="form-control" required="true" value="<?= $ten_dang_nhap; ?>" type="text"></div>
                </div>
                <div class="col-md-2 error">
                    <p><?= $ten_dang_nhapErr; ?></p>
                </div>
             </div>
             <div class="form-group">
                <label class="col-md-2 control-label">Email</label>
                <div class="col-md-8 inputGroupContainer">
                   <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span><input id="email" name="email" placeholder="" class="form-control" required="true" value="<?= $email; ?>" type="email"></div>
                </div>
                <div class="col-md-2 error">
                    <p><?= $emailErr; ?></p>
                </div>
             </div>
             <div class="form-group">
                <label class="col-md-2 control-label">Mật khẩu</label>
                <div class="col-md-8 inputGroupContainer">
                   <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span><input id="mat_khau" name="mat_khau" placeholder="" class="form-control" required="true" value="12#$abCD" type="password" readonly></div>
                </div>
                <div class="col-md-2 error">
                    <p><?= $mat_khauErr; ?></p>
                </div>
             </div>             
             <div class="form-group">
                <label class="col-md-2 control-label">Họ tên</label>
                <div class="col-md-8 inputGroupContainer">
                   <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="ho_ten" name="ho_ten" placeholder="" class="form-control" required="true" value="<?= $ho_ten; ?>" type="text"></div>
                </div>
                <div class="col-md-2 error">
                    <p><?= $ho_tenErr; ?></p>
                </div>
             </div>             
             <div class="form-group">
                <label class="col-md-2 control-label">Địa chỉ</label>
                <div class="col-md-8 inputGroupContainer">
                   <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span><input id="dia_chi" name="dia_chi" placeholder="" class="form-control" value="<?= $dia_chi; ?>" type="text"></div>
                </div>
                <div class="col-md-2 error">
                    <p><?= $dia_chiErr; ?></p>
                </div>
             </div>
             <div class="form-group">
                <label class="col-md-2 control-label">Mã nhóm</label>
                <div class="col-md-8 inputGroupContainer">                   
                   <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span><select id="ma_nhom" name="ma_nhom" class="form-control" value="<?= $ma_nhom; ?>">
                       <option value="1">1</option>
                       <option value="2">2</option>
                       <option value="3">3</option>
                   </select></div>
                </div>
                <div class="col-md-2 error">
                    <p><?= $ma_nhomErr; ?></p>
                </div>
             </div>
             
             <div class="form-group">
                <label class="col-md-2 control-label">Trạng Thái</label>
                <div class="col-md-8 inputGroupContainer">
                   <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-star"></i></span><select id="trang_thai" name="trang_thai" class="form-control" readonly>
                        <option value="0" >0</option>
                        <option value="1" selected>1</option>
                        <option value="2" >2</option>                       
                   </select></div>
                </div>
                <div class="col-md-2 error">
                    <p><?= $trang_thaiErr; ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Avatar</label>
                <div class="col-md-8 inputGroupContainer">
                    <div><input type="file" name="avatar" /></div>
                </div>
                <div class="col-md-2 error">
                    <p><?= $avatarErr; ?></p>
                </div>
            </div>
			<div class="form-group" >
				<div class="col-sm-4 col-xs-4" style="text-align: right;">
					<button type="submit" class="btn btn-success" name="" id="">Submit</button>
				</div>
				<div class="col-sm-offset-4 col-xs-offset-8">
					<a class="btn btn-default" name="cancel" id="cancel" href="?view=admin">Cancel</a>
				</div>				
			</div>						
		</fieldset>
	</form>
</div>
