<?php
ob_start();
require_once ('./config.php');
include_once ('./class/Database.php');
include_once ('./libs/ckeditor_funcs.php');
include_once ('./libs/funcs.php');


if (!checklogin())
	chuyentrang('login.php');
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
	<!-- Sidebar -->
	<script src="./js/sidebar.js" type="text/javascript"></script>
	<link href="./css/sidebar.css" rel="stylesheet" />
	<link href="./css/home.css" rel="stylesheet" />
	<link href="./css/view.css" rel="stylesheet" />
	<link href="./css/content.css" rel="stylesheet" />
	<link href="./css/error.css" rel="stylesheet" />
	<link href="./css/add_account.css" rel="stylesheet" />
	<link href="./css/pagination.css" rel="stylesheet" />
	<!-- /Sidebar -->	

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
	// $(document).ready(function(){
	// 	alert("Hello World");
	// });	
</script>
<!-- echo '<script type="text/javascript">alert("'. $var .'")</script>'; -->
</body>
</html>
<?php ob_end_flush();?>