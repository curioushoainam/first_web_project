<?php
ob_start();
require ('./config.php');
include ('./class/Database.php');
include ('./class/Validation.php');
include ('./libs/funcs.php');
require ('./class/DatabaseFuncs.php');
include ('./libs/ckeditor_funcs.php');

if (!checklogin())
	chuyentrang('login.php');

if (!checkpermission()){
	$_SESSION['msg'] = 'Xin lỗi bạn. Bạn đã truy cập vào link không thuộc quyền của bạn.';	
	chuyentrang('?view=home');
} 

?>
<!-- =============================================================== -->

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
	<link href="./css/font-awesome.min.css" rel="stylesheet" />
	<!-- Sidebar -->
	<script src="./js/sidebar.js" type="text/javascript"></script>
	<link href="./css/sidebar.css" rel="stylesheet" />
	<!-- /Sidebar -->
	<link href="./css/home.css" rel="stylesheet" />
	<link href="./css/view.css" rel="stylesheet" />
	<link href="./css/content.css" rel="stylesheet" />
	<link href="./css/error.css" rel="stylesheet" />
	<link href="./css/add_account.css" rel="stylesheet" />
	<link href="./css/pagination.css" rel="stylesheet" />
	<link href="./css/product_add.css" rel="stylesheet" />		
	
	<script src="./js/checktree.js" type="text/javascript"></script>
	<link href="./css/checktree.css" rel="stylesheet" />

	<script src="./js/toastr.js" type="text/javascript"></script>
	<link href="./css/toastr.css" rel="stylesheet" >

</head>
<body>	


<!-- navigation -->
<?php 
	include ('./includes/nav.php');
	include ('./includes/header.php');

?>
<!-- /navigation -->    

<!-- Main page	 -->
<?php 
	$page = isset($_GET['view']) && $_GET['view'] ? $_GET['view'] : 'home';
	$path = './pages/' . $page .'.php';
	if (file_exists($path))
		include ($path);
	else
		include './pages/error.php';
?>

<!-- /Main page	 -->

<!-- Footer -->
<?php 	
	include ('./includes/footer.php');
?>
<!-- /Footer -->

<script>
	// Hàm biến đổi string to alias	
	function str2alias(id_src, id_des){
		var str = ($('#' + id_src).val()).trim();
	    str = str.toLowerCase();
	    str = str.replace(/à|á|ạ|ả|ã|ằ|ắ|ặ|ẳ|ẵ|ă|â|ấ|ầ|ậ|ẩ|ẫ/g,"a");
	    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
	    str = str.replace(/í|ì|ị|ỉ|ĩ/g,"i");
	    str = str.replace(/ó|ò|ọ|ỏ|õ|ơ|ớ|ờ|ợ|ở|ỡ|ô|ố|ồ|ộ|ổ|ỗ/g,"o");
	    str = str.replace(/ú|ù|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
	    str = str.replace(/ý|ỳ|ỵ|ỷ|ỹ/g,"y");
	    str = str.replace(/đ/g,"d");
	    str = str.replace(/[^a-z0-9]+/g, "-")
	              .replace(/^-+|-+$/g, "-")
	              .replace(/^-+|-+$/g, '');
	    var des = document.getElementById(id_des);
	    des.value = str;
	}

</script>
<!-- echo '<script type="text/javascript">alert("'. '==> DEBUG <==' .'")</script>'; -->
<script>
	// Go to top
	window.onscroll = function() {scrollFunction()};

	function scrollFunction() {
	    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
	        document.getElementById("gototop").style.display = "block";
	    } else {
	        document.getElementById("gototop").style.display = "none";
	    }
	}
	
	$("#gototop").click(function() {
	     $("html, body").animate({ scrollTop: 0 }, "slow");
	     return false;
	});
	//  -/- Go to top

</script>


</body>
</html>

<?php ob_end_flush();?>