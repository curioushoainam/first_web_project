<?php 
require_once('./class/DatabaseFuncs.php');
$db = new DatabaseFuncs();

$ipfooter1 = array(
	'coName'=>NULL,
	'coInfo'=>NUll,
	'fblink'=>NUll,
	'twtlink'=>NUll,
	'ytlink'=>NUll,
	'inlink'=>NUll
);

if(isset($_POST['btn_f1']) && $_POST['btn_f1']){
	if($_POST['coName'])
		$ipfooter1['coName'] = $_POST['coName'];
	if($_POST['coInfo'])
		$ipfooter1['coInfo'] = $_POST['coInfo'];
	if($_POST['fblink'])
		$ipfooter1['fblink'] = $_POST['fblink'];
	if($_POST['twtlink'])
		$ipfooter1['twtlink'] = $_POST['twtlink'];
	if($_POST['ytlink'])
		$ipfooter1['ytlink'] = $_POST['ytlink'];
	if($_POST['inlink'])
		$ipfooter1['inlink'] = $_POST['inlink'];
	
	$ipf1 = json_encode($ipfooter1);
	$ngay_tao = date('Y-m-d H:i:s');
	$result = $db->update('config',array('gia_tri'=>$ipf1, 'trang_thai'=>1, 'ngay_tao'=>$ngay_tao), array('khoa'=>'footer1'));
	if($result){
		$_SESSION['msg'] = 'Cập nhật footer 1 thành công';
		unset($_POST);
	}
	else
		$_SESSION['msg'] = 'Cập nhật footer 1 THẤT BẠI';
}

$loadf1 = $db->read('config',array('gia_tri'), array('khoa'=>'footer1'));

if(isset($loadf1) && $loadf1)
	foreach ($loadf1 as $item)
		$ipfooter1 = json_decode($item->gia_tri,512);
?>
<div class="text-center">		
	<?php 
		if(isset($_SESSION['msg'])){
			echo '<p style="color: blue"><i>'. $_SESSION['msg'] .'</i></p>';
			unset($_SESSION['msg']);
		}
	?>
</div>

<div> 
    <div class="tabbable">
      	<ul class="nav nav-tabs" id="footer">
	        <li class="active"><a href="#footer1" data-toggle="tab">footer #1</a></li>
	        <li><a href="#footer2" data-toggle="tab">footer #2</a></li>
	        <li><a href="#footer3" data-toggle="tab">footer #3</a></li>
	        <li><a href="#footer4" data-toggle="tab">footer #4</a></li>

      	</ul>
      	<div class="tab-content">
	        <div class="tab-pane active" id="footer1"> 
				<div class="col-md-8 col-md-offset-2 table-responsive">
				<form action="" method="post">
					<table class="table">
						<tr><label for="">Tên cty</label></tr>
						<tr><input type="text" name="coName" placeholder="Nhập tên cty" style="width: 100%" value="<?= $ipfooter1['coName'] ?>"></tr>
						<br><br>
						
						<tr><label for="">Nội dung hiển thị</label></tr>											
						<tr><?php echo ckeditor("coInfo", $ipfooter1['coInfo'], array('20em','100%')) ?></tr>
						<br>
						<tr><label for="">Link facebook</label></tr>
						<tr><input type="text" name="fblink" style="width: 100%" value="<?= $ipfooter1['fblink'] ?>"></tr>
						<br><br>
						<tr><label for="">Link twitter</label></tr>
						<tr><input type="text" name="twtlink" style="width: 100%" value="<?= $ipfooter1['twtlink'] ?>"></tr>
						<br><br>
						<tr><label for="">Link youtube</label></tr>
						<tr><input type="text" name="ytlink" style="width: 100%" value="<?= $ipfooter1['ytlink'] ?>"></tr>
						<br><br>
						<tr><label for="">Link linkedln</label></tr>
						<tr><input type="text" name="inlink" style="width: 100%" value="<?= $ipfooter1['inlink'] ?>"></tr>
						
					</table>

					<button type="submit" class="btn btn-success pull-right" name="btn_f1" value="1">Submit</button>
					<a type="button" class="btn btn-default btn_cancel" href="#">Cancel</a>						
				
				</form>

				</div>				
	        </div>
	        <!-- /footer1 -->


<?php
$ipfooter2 = array(	
	'naviHtml'=>NUll
);

if(isset($_POST['btn_f2']) && $_POST['btn_f2']){	
	if($_POST['naviHtml'])
		// $ipfooter2['naviHtml'] = $_POST['naviHtml'];
		$ipf2 = $_POST['naviHtml'];
		
	// $ipf2 = json_encode($ipfooter2);
	
	$ngay_tao = date('Y-m-d H:i:s');
	$result = $db->update('config',array('gia_tri'=>$ipf2, 'trang_thai'=>1, 'ngay_tao'=>$ngay_tao), array('khoa'=>'footer2'));
	if($result){
		$_SESSION['msg'] = 'Cập nhật footer 2 thành công';
		unset($_POST);
	}
	else
		$_SESSION['msg'] = 'Cập nhật footer 2 THẤT BẠI';
}

$loadf2 = $db->read('config',array('gia_tri'), array('khoa'=>'footer2'));

if(isset($loadf2) && $loadf2)
	foreach ($loadf2 as $item)
		$ipfooter2 = $item->gia_tri;
		// $ipfooter2 = json_decode($item->gia_tri,512);
?>

	        <div class="tab-pane " id="footer2">
	        	<div class="col-md-8 col-md-offset-2 table-responsive">
				<form action="" method="post">
					<table class="table">
						<br>
						<tr><label for="">Mục User navigation</label></tr><br>
						<tr><textarea name="naviHtml" id="" rows="20em" style="width: 100%"><?= $ipfooter2 ?></textarea></tr>
					</table>

					<button type="submit" class="btn btn-success pull-right" name="btn_f2" value="1">Submit</button>
					<a type="button" class="btn btn-default btn_cancel" href="#">Cancel</a>						
				
				</form>

				</div>
	    	</div>
	        <!-- /footer2 -->

<?php
$ipfooter3 = array(	
	'catalog'=>NUll
);

if(isset($_POST['btn_f3']) && $_POST['btn_f3']){	
	if($_POST['catalog'])
		$ipf3 = $_POST['catalog'];
		// $ipfooter3['catalog'] = $_POST['catalog'];
	
	
	// $ipf3 = json_encode($ipfooter3);
	$ngay_tao = date('Y-m-d H:i:s');
	$result = $db->update('config',array('gia_tri'=>$ipf3, 'trang_thai'=>1, 'ngay_tao'=>$ngay_tao), array('khoa'=>'footer3'));
	if($result){
		$_SESSION['msg'] = 'Cập nhật footer 3 thành công';
		unset($_POST);
	}
	else
		$_SESSION['msg'] = 'Cập nhật footer 3 THẤT BẠI';
}

$loadf3 = $db->read('config',array('gia_tri'), array('khoa'=>'footer3'));

if(isset($loadf3) && $loadf3)
	foreach ($loadf3 as $item)
		$ipfooter3 = $item->gia_tri;
		// $ipfooter3 = json_decode($item->gia_tri,512);
?>

	        <div class="tab-pane" id="footer3">
	       		<div class="col-md-8 col-md-offset-2 table-responsive">
				<form action="" method="post">
					<table class="table">
						<tr><label for="">Mục Categories</label></tr>
						<tr><textarea name="catalog" id="" rows="20em" style="width: 100%"><?= $ipfooter3 ?></textarea></tr>
					</table>

					<button type="submit" class="btn btn-success pull-right" name="btn_f3" value="1">Submit</button>
					<a type="button" class="btn btn-default btn_cancel" href="#">Cancel</a>						
				
				</form>

				</div>
	    	</div>
	        <!-- /footer3 -->

<?php
$ipfooter4 = array(	
	'newsletter'=>NUll
);
$ipf4 ='';
if(isset($_POST['btn_f4']) && $_POST['btn_f4']){	
	if($_POST['newsletter'])
		$ipf4 = $_POST['newsletter'];
		// $ipfooter4['newsletter'] = $_POST['newsletter'];
	
	
	// $ipf4 = json_encode($ipfooter4);
	$ngay_tao = date('Y-m-d H:i:s');
	$result = $db->update('config',array('gia_tri'=>$ipf4, 'trang_thai'=>1, 'ngay_tao'=>$ngay_tao), array('khoa'=>'footer4'));
	if($result){
		$_SESSION['msg'] = 'Cập nhật footer 4 thành công';
		unset($_POST);
	}
	else
		$_SESSION['msg'] = 'Cập nhật footer 4 THẤT BẠI';
}

$loadf4 = $db->read('config',array('gia_tri'), array('khoa'=>'footer4'));

if(isset($loadf4) && $loadf4)
	foreach ($loadf4 as $item)
		$ipfooter4 = $item->gia_tri;
?>

	        <div class="tab-pane" id="footer4">
	        	<div class="col-md-8 col-md-offset-2 table-responsive">
				<form action="" method="post">
					<table class="table">
						<tr><label for="">Mục Newsletter</label></tr>
						<tr><textarea name="newsletter" id="" rows="20em" style="width: 100%"><?= $ipfooter4 ?></textarea></tr>
					</table>

					<button type="submit" class="btn btn-success pull-right" name="btn_f4" value="1">Submit</button>
					<a type="button" class="btn btn-default btn_cancel" href="#">Cancel</a>						
				
				</form>

				</div>
	    	</div>
			<!-- /footer4 -->

       	</div>
       	<!-- tab-content -->
    </div>
    <!-- /tabbable -->

</div>

<script>
$(document).on("click",".btn_cancel", function(event){
	event.preventDefault();
    window.location.reload();    
    return false;
});


$(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#footer a[href="' + activeTab + '"]').tab('show');
    }
});


</script>