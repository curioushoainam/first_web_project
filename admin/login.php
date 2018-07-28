<?php
include_once ("./config.php");
include_once ("./libs/funcs.php");
require_once ('./class/Database.php');
require_once ('./class/Process_account.php');
require_once ('./class/Validation.php');
include_once ('./libs/funcs.php');
$process_account = new Process_account();
$validation = new Validation();

// define variables and set to empty values
$account = $password = '';
$accountErr = $passwordErr = '';

if (isset($_POST['account'], $_POST['password']) && $_POST['account'] && $_POST['password']){
    $account = $validation->test_input($_POST['account']);
	if ($process_account->isAccount($account)){
        $password = $validation->test_input($_POST['password']);       
        if ($validation->isPassword($password)){
            $password = md5($password);                       
            if ($process_account->checkPassword($account, $password)){
                $_SESSION['login'] = true; 
                $_SESSION['account'] = $account;
                $_SESSION['password'] = $password;                
                $_SESSION['avatar'] = $process_account->getAvatar($account);
                
                if (isset($_POST['remember']) && $_POST['remember']){
                    setcookie('login', $_SESSION['login'], time() + 3600*24*30);
                    setcookie('account', $_SESSION['account'], time() + 3600*24*30);
                    setcookie('password', $_SESSION['password'], time() + 3600*24*30); 
                    setcookie('avatar', $_SESSION['avatar'], time() + 3600*24*30);                  
                }
                
                chuyentrang('index');

            } else {
                $passwordErr = 'Mật khẩu không đúng';
            }
        } else {
            $passwordErr = 'Mật khẩu không hợp lệ';
        }
    } else {
        $accountErr = 'Tài khoản không tồn tại';
    }	
}
?>

<!-- =========================================================================== -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>First Web Project</title>
	<meta name="viewport" content="width=device-width initial-scale=1.0">
	<script src="./js/jquery-3.3.1.min.js" type="text/javascript"></script>
	<script src="./js/bootstrap.min.js" type="text/javascript"></script>
	<link href="./css/bootstrap.min.css" rel="stylesheet" />
	<!-- login -->
	<script src="./js/login.js" type="text/javascript"></script>
	<link href="./css/login.css" rel="stylesheet" />
    <link href="./css/home.css" rel="stylesheet" />
	<!-- /login -->	

</head>
<body>	
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="pr-wrap">
                    <div class="pass-reset">
                        <label>
                            Nhập địa chỉ email mà bạn đã dùng để đăng ký tài khoản</label>
                        <input type="email" placeholder="Email" />
                        <input type="submit" value="Submit" class="pass-reset-submit btn btn-success btn-sm" />
                    </div>
                </div>
                <div class="wrap">
                    <p class="form-title">Đăng Nhập</p>
                    <form class="login" action="" method="post">
                    <input type="text" name="account" placeholder="Username" value="<?= $account ?>" /><span class="error"><?= $accountErr ?></span>
                    <input type="password" name="password" placeholder="Password" value=""/><span class="error"><?= $passwordErr ?></span>
                    <input type="submit" value="Đăng Nhập" class="btn btn-success btn-sm" />
                    <div class="remember-forgot">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" value="1" />
                                        Ghi nhớ tôi
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 forgot-pass-content">
                                <a href="javascription:void(0)" class="forgot-pass">Quên mật khẩu</a>
                            </div>
                        </div>
                    </div>                    
                    </form>
                </div>
            </div>
        </div>      
    </div>
</body>
</html>