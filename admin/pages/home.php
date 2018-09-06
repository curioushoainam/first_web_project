<?php 
if (isset($_SESSION['msg']) && $_SESSION['msg']){
	$msg = $_SESSION['msg'];
	unset($_SESSION['msg']);
} else
	$msg = '';

require_once ('./class/User.php');
$users =  new User();

?>

<div class="home" style="">	
	<div align="center" style="color:red"><i><?= $msg ?></i></div>
	<div class="container-fluid" id="btn-control">		
		<p class="col-sm-3">
			<a type="button" class="btn btn-success" id="btn-mng-img" href="#newuser">New Users</a>
			<a type="button" class="btn btn-success" id="btn-up-many-imgs" href="#newcmt">New Comments</a>
		</p>
			
		<p class="col-sm-3 col-sm-offset-6">
			<a type="button" class="btn btn-success" id="btn-post-content" href="#">Hướng dẫn post bài viết</a>
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
    <div class="order">
		<h4 class="alert-info">New orders</h4>
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>					
					<th>Mã</th>
					<th>Account</th>
					<th>Tổng tiền</th>					
					<th>Ngày tạo</th>
				</thead>
				<tbody>
				<?php 
					$newOrders = $users->loadNewOrders();					
					// viewArr($newOrders);
					if(isset($newOrders) && $newOrders){
						foreach ($newOrders as $item){
							$ma = isset($item->ma) ? $item->ma : '';
							$account = isset($item->account) ? $item->account : '';
							$amount = isset($item->amount) ? $item->amount : 0;
							$createdDate = isset($item->createdDate) ? $item->createdDate : '';							
				?>	
					<tr id="userid_<?= $ma ?>">						
						<td><?= $ma ?></td>
						<td><?= $account ?></td>
						<td><?= number_format($amount) ?></td>
						<td><?= $createdDate ?></td>						
					</tr>
				<?php 
						}
					}
				?>					
				</tbody>	


			</table>
		</div>		
	</div>
	<!-- /order -->
	<hr>

	<div class="user" id="newuser">
		<h4 class="alert-info">New Users</h4>
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<th>Todo</th>
					<th>Mã</th>
					<th>Tên đăng nhập</th>
					<th>Email</th>
					<th>Họ tên</th>
					<th>Địa chỉ</th>
					<th>Số điện thoại</th>
					<th>Ngày tạo</th>
				</thead>
				<tbody>
				<?php 
					$newUsers = $users->loadNewUsers();
					// viewArr($newUsers);
					if(isset($newUsers) && $newUsers){
						foreach ($newUsers as $item){
							$ma = isset($item->ma) ? $item->ma : '';
							$ten_dang_nhap = isset($item->ten_dang_nhap) ? $item->ten_dang_nhap : '';
							$email = isset($item->email) ? $item->email : '';
							$ho_ten = isset($item->ho_ten) ? $item->ho_ten : '';
							$dia_chi = isset($item->dia_chi) ? $item->dia_chi : '';
							$sdt = isset($item->sdt) ? $item->sdt : '';
							$ngay_tao = isset($item->ngay_tao) ? $item->ngay_tao : '';
				?>	
					<tr>
						<td><a href=""><span class="glyphicon glyphicon-ok user_accept" title="Accept" data-ma="<?= $ma ?>" data-result="1"></span></a>
	    			 | 
					<a href=""><span class="glyphicon glyphicon-remove user_reject" title="Reject" style="color: red" data-ma="<?= $ma ?>" data-result="0" ></span></a></td>
						<td><?= $ma ?></td>
						<td><?= $ten_dang_nhap ?></td>
						<td><?= $email ?></td>
						<td><?= $ho_ten ?></td>
						<td><?= $dia_chi ?></td>
						<td><?= $sdt ?></td>
						<td><?= $ngay_tao ?></td>
					</tr>
				<?php 
						}
					}
				?>					
				</tbody>	


			</table>
		</div>		
	</div>
	<!-- /user -->
	<hr>

	<div class="comment" id="newcmt">
		<h4 class="alert-info">New Comments</h4>
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<th >Todo</th>
					<th>Mã</th>
					<th>Mã sp</th>
					<th>Mã cha</th>
					<th width="50%">Nội dung</th>
					<th>Họ tên</th>	
					<th>Ngày tạo</th>					
				</thead>
				<tbody>
				<?php 
					$newCmts = $users->loadNewCmts();
					// viewArr($newCmts);
					if(isset($newCmts) && $newCmts){
						foreach ($newCmts as $item){
							$ma = isset($item->ma) ? $item->ma : '';
							$ma_sp = isset($item->ma_sp) ? $item->ma_sp : '';
							$ma_cha = isset($item->ma_cha) ? $item->ma_cha : '';
							$noi_dung = isset($item->noi_dung) ? $item->noi_dung : '';
							$ten = isset($item->ten) ? $item->ten : '';							
							$ngay_tao = isset($item->ngay_tao) ? $item->ngay_tao : '';
				?>	
					<tr>
						<td><a href=""><span class="glyphicon glyphicon-ok cmt_accept" title="Accept" data-ma="<?= $ma ?>" data-result="1"></span></a>
	    			 | 
					<a href=""><span class="glyphicon glyphicon-remove cmt_reject" title="Reject" style="color: red" data-ma="<?= $ma ?>" data-result="0" ></span></a></td>
						<td><?= $ma ?></td>
						<td><?= $ma_sp ?></td>
						<td><?= $ma_cha ?></td>
						<td><?= $noi_dung ?></td>
						<td><?= $ten ?></td>
						<td><?= $ngay_tao ?></td>
					</tr>
				<?php 
						}
					}
				?>					
				</tbody>	


			</table>
		</div>		
	</div>
	<!-- /comment -->


</div>

<script>
	$(document).on("click", ".user_accept", function(event){
		event.preventDefault();
		var _that = $(this);
		$.ajax({
			url	: './class/user_approval.php',
			type: 'post',
			dataType: 'json',
			data : {
				ma : _that.data('ma'),
				res : _that.data('result')
			},
			success : function(res){			
				if(res.error == '1'){
					toastr["error"](res.msg,"Error");
					alert('acp err is ' + res.error);
				} else {
					toastr["success"]("Đã duyệt thành công mã " + _that.data('ma'),"Approved");
					_that.remove();
				}
			},
			error : function(jqXHR, textStatus, errorThrown){
				toastr["error"]("Lỗi connecting với server","Error");
			}
		});
		return false;
	})

	$(document).on("click", ".user_reject", function(event){
		event.preventDefault();
		var _that = $(this);
		
		$.ajax({
			url	: './class/user_approval.php',
			type: 'post',
			dataType: 'json',
			data : {
				ma : _that.data('ma'),
				res : _that.data('result')
			},
			success : function(res){			
				if(res.error == '1'){
					toastr["error"](res.msg,"Error");
				} else {
					toastr["warning"]("Đã xóa thành công mã " + _that.data('ma'),"Deleted");
					_that.remove()
				}
			},
			error : function(jqXHR, textStatus, errorThrown){
				toastr["error"]("Lỗi connecting với server","Error");
			}
		});

		return false;
	})

	// comment section
	$(document).on("click", ".cmt_accept", function(event){
		event.preventDefault();
		var _that = $(this);
		$.ajax({
			url	: './class/cmt_approval.php',
			type: 'post',
			dataType: 'json',
			data : {
				ma : _that.data('ma'),
				res : _that.data('result')
			},
			success : function(res){			
				if(res.error == '1'){
					toastr["error"](res.msg,"Error");
					alert('acp err is ' + res.error);
				} else {
					toastr["success"]("Đã duyệt thành công mã " + _that.data('ma'),"Approved");
					_that.remove();
				}
			},
			error : function(jqXHR, textStatus, errorThrown){
				toastr["error"]("Lỗi connecting với server","Error");
			}
		});
		return false;
	})

	$(document).on("click", ".cmt_reject", function(event){
		event.preventDefault();
		var _that = $(this);
		
		$.ajax({
			url	: './class/cmt_approval.php',
			type: 'post',
			dataType: 'json',
			data : {
				ma : _that.data('ma'),
				res : _that.data('result')
			},
			success : function(res){			
				if(res.error == '1'){
					toastr["error"](res.msg,"Error");
				} else {
					toastr["warning"]("Đã xóa thành công mã " + _that.data('ma'),"Deleted");
					_that.remove()
				}
			},
			error : function(jqXHR, textStatus, errorThrown){
				toastr["error"]("Lỗi connecting với server","Error");
			}
		});

		return false;
	})
</script>
