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
	<link href="./libs/css/mainpage.css" rel="stylesheet" />
	<link href="./libs/css/sidebar.css" rel="stylesheet" />
	<!-- /Sidebar -->	

</head>
<body>	

<!-- navigation -->
<?php 
	include ('./includes/nav.php');
?>
<!-- /navigation -->    

<!-- Main page	 -->
<div class="main" id="wrapper" style="">	
	<div class="container-fluid" id="btn-control">
		<!-- <div class="col-sm-3">
			<button type="button" class="btn btn-success" id="btn-mng-img" href="#">Quản lý ảnh</button>
		</div>	
		<div class="col-sm-3">
			<button type="button" class="btn btn-success" id="btn-up-many-imgs" href="#">Upload nhiều ảnh</button>
		</div>	
		<div class="col-sm-3">
			<button type="button" class="btn btn-success" id="btn-up-one-img" href="#">Upload 1 ảnh</button>
		</div>	
		<div class="col-sm-3">
			<button type="button" class="btn btn-success" id="btn-post-content" href="#">Hướng dẫn post bài viết</button>
		</div> -->	

		<p class="col-sm-3">
			<button type="button" class="btn btn-success" id="btn-mng-img" href="#">Quản lý ảnh</button>
		</p>	
		<p class="col-sm-3">
			<button type="button" class="btn btn-success" id="btn-up-many-imgs" href="#">Upload nhiều ảnh</button>
		</p>	
		<p class="col-sm-3">
			<button type="button" class="btn btn-success" id="btn-up-one-img" href="#">Upload 1 ảnh</button>
		</p>	
		<p class="col-sm-3">
			<button type="button" class="btn btn-success" id="btn-post-content" href="#">Hướng dẫn post bài viết</button>
		</p>
	</div>
	
    <div id="page-wrapper">    	

        <div class="container-fluid">        	
            <!-- Page Heading -->
            <div class="row" id="main" >            	

                <div class="col-sm-12 col-md-12 well" id="content">
                    <h1>Welcome Admin!</h1>
                </div>                

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    
</div>
<!-- /Main page	 -->



<script>
	// $(document).ready(function(){
	// 	alert("Hello World");
	// });
</script>

</body>
</html>