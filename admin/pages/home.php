<?php 
	if (isset($_SESSION['msg']) && $_SESSION['msg']){
		$msg = $_SESSION['msg'];
		unset($_SESSION['msg']);
	} else
		$msg = '';
?>

<div class="home" style="">	
	<div align="center" style="color:red"><i><?= $msg ?></i></div>
	<div class="container-fluid" id="btn-control">		
		<p class="col-sm-3">
			<a type="button" class="btn btn-success" id="btn-mng-img" href="?view=ql_anh">Quản lý ảnh</a>
		</p>	
		<p class="col-sm-3">
			<a type="button" class="btn btn-success" id="btn-up-many-imgs" href="?view=up_nhieu_hinh">Upload nhiều ảnh</a>
		</p>	
		<p class="col-sm-3">
			<a type="button" class="btn btn-success" id="btn-up-many-imgs" href="?view=up_mot_hinh">Upload 1 ảnh</a>
		</p>	
		<p class="col-sm-3">
			<a type="button" class="btn btn-success" id="btn-post-content" href="?view=huong_dan_post_bai">Hướng dẫn post bài viết</a>
		</p>
	</div>

    <div class="container-fluid">
        <div class="row" id="main" >            	

            <div class="col-sm-12 col-md-12 well" id="content">
                <h1>Welcome Admin!</h1>
            </div>                

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->    
</div>
