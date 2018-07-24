<?php
require_once ('./class/database.php');
include_once ('./libs/funcs.php');

if(isset($_SESSION['login'], $_SESSION['account'], $_SESSION['password']) && $_SESSION['login'] && $_SESSION['account'] &&  $_SESSION['password']){
	$_SESSION['login'] = $_COOKIE['login']; 
	$_SESSION['account'] = $_COOKIE['account'];
	$_SESSION['password'] = $_COOKIE['password'];
}

if (isset($_POST['account'], $_POST['password']) && $_POST['account'] && $_POST['password']){
	// check user
	
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
                    <p class="form-title">
                        Đăng Nhập</p>n
                    <form class="login" action="" method="post">
                    <input type="text" name="account" placeholder="Username" />
                    <input type="password" name="password" placeholder="Password" />
                    <input type="submit" value="Đăng Nhập" class="btn btn-success btn-sm" />
                    <div class="remember-forgot">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" />
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