<?php 
require_once('./class/DatabaseFuncs.php');
$db = new DatabaseFuncs();

$seo = '';

if(isset($_POST['btn_seo']) && $_POST['btn_seo']){	
	if(isset($_POST['seoval']))
		if(is_numeric($_POST['seoval']))
			$seo = $_POST['seoval'];
		else
			$seo = 1;
	
	$ngay_tao = date('Y-m-d H:i:s');
	$result = $db->update('config',array('gia_tri'=>$seo, 'trang_thai'=>1, 'ngay_tao'=>$ngay_tao), array('khoa'=>'seo'));
	if($result){
		$_SESSION['msgseo'] = 'Cập nhật SEO thành công';
		unset($_POST);
	}
	else
		$_SESSION['msgseo'] = 'Cập nhật SEO THẤT BẠI';
}

$loadseo = $db->read('config',array('gia_tri'), array('khoa'=>'seo'));

// viewArr($loadseo);
if(isset($loadseo) && $loadseo)
	$seo = $loadseo[0]->gia_tri;
?>

<div class="text-center">		
	<?php 
		if(isset($_SESSION['msgseo'])){
			echo '<p style="color: blue"><i>'. $_SESSION['msgseo'] .'</i></p>';
			unset($_SESSION['msgseo']);
		}
	?>
</div>
<div class="tabbable">
	<div class="col-md-8 col-md-offset-2 table-responsive">
		<form action="" method="post">
			<table class="table">
				<br>
				<tr><label for="">Thay đổi giá trị seo</label></tr>
				<br><br>
				<tr>
					<select name="seoval" style="width: 100%; height: 2.0em">
						<option> --- </option>
						<option value="1">Kích hoạt SEO</option>
						<option value="0">Tắt SEO</option>						
					</select>
				</tr>
				<br><br>
				<tr><p>Trạng thái seo hiện tại : <span><?= isset($seo) && $seo==1?'Đang kích hoạt' : 'Đang tắt' ?></span></p></tr>
			</table>
			<button type="submit" class="btn btn-success pull-right" name="btn_seo" value="1">Submit</button>
			<a type="button" class="btn btn-default btn_cancel" href="#">Cancel</a>
		</form>
	</div>
</div>  