<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>First Web Project</title>
	<meta name="viewport" content="width=device-width initial-scale=1.0">
	<script src="./libs/js/jquery-3.3.1.min.js" type="text/javascript"></script>
	<script src="./libs/js/bootstrap.min.js" type="text/javascript"></script>
	<link href="./libs/css/bootstrap.min.css" rel="stylesheet" />
	<!-- login -->
	<script src="./libs/js/login.js" type="text/javascript"></script>
	<link href="./libs/css/login.css" rel="stylesheet" />
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
                        Đăng Nhập</p>
                    <form class="login">
                    <input type="text" placeholder="Username" />
                    <input type="password" placeholder="Password" />
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
        <!-- <div class="posted-by">Posted By: <a href="http://www.jquery2dotnet.com">Bhaumik Patel</a></div> -->
    </div>
</body>
</html>