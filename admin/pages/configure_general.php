<?php 
require_once ('./class/Validation.php');
$validation = new Validation();
require_once('./class/DatabaseFuncs.php');
$db = new DatabaseFuncs();

$cpNameErr = $phoneErr = $addressErr = $mapErr = $cpEmailErr = NULL;

$gnr = array(
	'cpName' => NULL,
	'phone' => NULL,
	'address' => NULL,
	'map' => NULL,
	'cpEmail' => NULL
);


if ($_SERVER["REQUEST_METHOD"] == "POST"){	
	if(isset($_POST['btn_gnr']) && $_POST['btn_gnr']) {				
		if(isset($_POST['cpName']) && $_POST['cpName']){
			$gnr['cpName'] = $validation->test_input($_POST['cpName']);			
		} else {
			$cpNameErr = 'Không được trống';			
		}

		if(isset($_POST['phone']) && $_POST['phone']){
			$gnr['phone'] = $validation->test_input($_POST['phone']);
		} else {
			$phoneErr = 'Không được trống';			
		}

		if(isset($_POST['address']) && $_POST['address']){
			$gnr['address'] = $validation->test_input($_POST['address']);
		} else {
			$addressErr = 'Không được trống';
		}

		if(isset($_POST['map']) && $_POST['map']){
			$gnr['map'] = $validation->test_input($_POST['map']);
		} else {
			$mapErr = 'Không được trống';
		}

		if(isset($_POST['cpEmail']) && $_POST['cpEmail']){
			if($validation->isEmail($_POST['cpEmail']))
				$gnr['cpEmail'] = $validation->test_input($_POST['cpEmail']);
			else
				$cpEmailErr = 'Lỗi dữ liệu';
		} else {
			$cpEmailErr = 'Không được trống';
		}
		
		// viewArr($smtp); exit();
		if(!($cpNameErr || $phoneErr || $addressErr || $mapErr || $cpEmailErr )){
				$ipgnr = json_encode($gnr);
				$ngay_tao = date('Y-m-d H:i:s');
				$result = $db->update('config',array('gia_tri'=>$ipgnr, 'trang_thai'=>1, 'ngay_tao'=>$ngay_tao), array('khoa'=>'generalInfo'));
			if($result){
				$_SESSION['msggnr'] = 'Cập nhật General thành công';
				
			} else {
				$_SESSION['msggnr'] = 'Cập nhật General thất bại';
				
			}
		} 
	}
}

$loadgnr = $db->read('config',array('gia_tri'), array('khoa'=>'generalInfo'));

// viewArr($loadgnr);
if(isset($loadgnr) && $loadgnr)
	foreach ($loadgnr as $item)
		$gnr = json_decode($item->gia_tri,512);
?>



<div class="text-center">		
	<?php 
		if(isset($_SESSION['msggnr'])){
			echo '<p style="color: blue"><i>'. $_SESSION['msggnr'] .'</i></p>';
			unset($_SESSION['msggnr']);
		}
	?>
</div>
<div class="tabbable">
	<div class="col-md-8 col-md-offset-2 table-responsive">
		<form action="" method="post">			
			<table class="table">	
				<br>
				<tr><label for="">Company Name</label></tr>
				<tr><input type="text" name="cpName" style="width: 100%" value="<?= $gnr['cpName'] ?>"></tr>
				<tr><p style="color: red"><?= $cpNameErr ?></p></tr>
				<br>
				<tr><label for="">Phone Number</label></tr>
				<tr><input type="text" name="phone" style="width: 100%" value="<?= $gnr['phone'] ?>"></tr>
				<tr><p style="color: red"><?= $phoneErr ?></p></tr>
				<br>
				<tr><label for="">Adress</label></tr>
				<tr><input type="text" name="address" style="width: 100%" value="<?= $gnr['address'] ?>"></tr>
				<tr><p style="color: red"><?= $addressErr ?></p></tr>
				<br>
				<tr><label for="">Map</label></tr>
				<tr><?php echo ckeditor("map", $gnr['map'], array('10em','100%')) ?></tr>				
				<tr><p style="color: red"><?= $mapErr ?></p></tr>
				<br>
				<tr><label for="">Company Email</label></tr>
				<tr><input type="email" name="cpEmail" style="width: 100%" value="<?= $gnr['cpEmail'] ?>"></tr>
				<tr><p style="color: red"><?= $cpEmailErr ?></p></tr>				
				
			</table>
			<button type="submit" class="btn btn-success pull-right" name="btn_gnr" value="1">Submit</button>
			<a type="button" class="btn btn-default btn_cancel" href="#">Cancel</a>
		</form>
	</div>
</div>