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
	<!-- Sidebar -->
	<script src="./libs/js/sidebar.js" type="text/javascript"></script>
	<link href="./libs/css/sidebar.css" rel="stylesheet" />
	<link href="./libs/css/home.css" rel="stylesheet" />
	<link href="./libs/css/view.css" rel="stylesheet" />
	<!-- /Sidebar -->	

</head>
<body>	

<!-- navigation -->
<?php 
	include ('./includes/nav.php');
?>
<!-- /navigation -->    

<!-- Main page	 -->
<?php		
	include ('./pages/view.php');
?>
<!-- /Main page	 -->

<!-- Footer -->

<!-- /Footer -->


<script>
	// $(document).ready(function(){
	// 	alert("Hello World");
	// });
</script>

</body>
</html>