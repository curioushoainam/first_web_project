<?php 
require_once('./class/DatabaseFuncs.php');
$db = new DatabaseFuncs();

$about = '';
if(isset($_POST['btn_aboout']) && $_POST['btn_aboout']){
	if(isset($_POST['about_content']) && $_POST['about_content']) 
		$about = $_POST['about_content'];
	
	$ngay_tao = date('Y-m-d H:i:s');
	$result = $db->update('config',array('gia_tri'=>$about, 'trang_thai'=>1, 'ngay_tao'=>$ngay_tao), array('khoa'=>'about'));
	if($result){
		$_SESSION['msgabout'] = 'Cập nhật About us thành công';		
	}
	else
		$_SESSION['msgabout'] = 'Cập nhật About us THẤT BẠI';
}

$loadabout = $db->read('config',array('gia_tri'), array('khoa'=>'about'));

if(isset($loadabout) && $loadabout)
	foreach ($loadabout as $item)
		$about = $item->gia_tri;
?>

<div class="text-center">		
	<?php 
		if(isset($_SESSION['msgabout'])){
			echo '<p style="color: blue"><i>'. $_SESSION['msgabout'] .'</i></p>';
			unset($_SESSION['msgabout']);
		}
	?>
</div>

<div tabbable> 
    <div class="col-md-10 col-md-offset-1 table-responsive">
		<form action="" method="post">
			<table class="table">
				<br>				
				<tr><label for="">Nội dung hiển thị</label></tr>											
				<tr><?php echo ckeditor("about_content", $about, array('35em','100%'),'advance') ?></tr>
			</table>

			<button type="submit" class="btn btn-success pull-right" name="btn_aboout" value="1">Submit</button>
			<a type="button" class="btn btn-default btn_cancel" href="#">Cancel</a>						
		
		</form>

	</div>				
</div>
  
