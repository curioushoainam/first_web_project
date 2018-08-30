<?php 
require_once ('./class/Validation.php');
$validation = new Validation();
require_once('./class/DatabaseFuncs.php');
$db = new DatabaseFuncs();

$mail_fromErr = $from_nameErr = $smtp_authErr = $smtp_hostErr = $smtp_userErr = $smtp_passErr = $smtp_secureErr = $smtp_portErr = NULL;

$smtp = array(
	'mail_from' => NULL,
	'from_name' => NULL,
	'smtp_auth' => NULL,
	'smtp_host' => NULL,
	'smtp_user' => NULL,
	'smtp_pass' => NULL,
	'smtp_secure' => NULL,
	'smtp_port' => NULL
);


if ($_SERVER["REQUEST_METHOD"] == "POST"){	
	if(isset($_POST['btn_smtp']) && $_POST['btn_smtp']) {				
		if(isset($_POST['mail_from']) && $_POST['mail_from']){
			$smtp['mail_from'] = $validation->test_input($_POST['mail_from']);			
		} else {
			$mail_fromErr = 'Không được trống';			
		}

		if(isset($_POST['from_name']) && $_POST['from_name']){
			$smtp['from_name'] = $validation->test_input($_POST['from_name']);
		} else {
			$from_nameErr = 'Không được trống';			
		}

		if(isset($_POST['smtp_auth']) && $_POST['smtp_auth']){
			$smtp['smtp_auth'] = $validation->test_input($_POST['smtp_auth']);
		} else {
			$smtp_authErr = 'Không được trống';
		}

		if(isset($_POST['smtp_host']) && $_POST['smtp_host']){
			$smtp['smtp_host'] = $validation->test_input($_POST['smtp_host']);
		} else {
			$smtp_hostErr = 'Không được trống';
		}

		if(isset($_POST['smtp_user']) && $_POST['smtp_user']){
			$smtp['smtp_user'] = $validation->test_input($_POST['smtp_user']);
		} else {
			$smtp_userErr = 'Không được trống';
		}

		if(isset($_POST['smtp_pass']) && $_POST['smtp_pass']){
			$smtp['smtp_pass'] = $validation->test_input($_POST['smtp_pass']);
		} else {
			$smtp_passErr = 'Không được trống';
		}
		
		if(isset($_POST['smtp_secure']) && $_POST['smtp_secure']){
			$smtp['smtp_secure'] = $validation->test_input($_POST['smtp_secure']);
		} else {
			$smtp_secureErr = 'Không được trống';
		}

		if(isset($_POST['smtp_port']) && $_POST['smtp_port']){
			if(is_numeric($_POST['smtp_port']))
				$smtp['smtp_port'] = $validation->test_input($_POST['smtp_port']);
			else
				$smtp_portErr = 'Lỗi dữ liệu';
		} else {
			$smtp_portErr = 'Không được trống';			
		}
		// viewArr($smtp); exit();
		if(!($mail_fromErr||$from_nameErr||$smtp_authErr||$smtp_hostErr||$smtp_userErr||$smtp_passErr||$smtp_secureErr||$smtp_portErr)){
				$ipsmtp = json_encode($smtp);
				$ngay_tao = date('Y-m-d H:i:s');
				$result = $db->update('config',array('gia_tri'=>$ipsmtp, 'trang_thai'=>1, 'ngay_tao'=>$ngay_tao), array('khoa'=>'smtp'));
			if($result){
				$_SESSION['msgsmtp'] = 'Cập nhật SMTP thành công';
				
			} else {
				$_SESSION['msgsmtp'] = 'Cập nhật SMTP thất bại';
				
			}
		} 
	}
}

$loadsmtp = $db->read('config',array('gia_tri'), array('khoa'=>'smtp'));

// viewArr($loadsmtp);
if(isset($loadsmtp) && $loadsmtp)
	foreach ($loadsmtp as $item)
		$smtp = json_decode($item->gia_tri,512);	

?>



<div class="text-center">		
	<?php 
		if(isset($_SESSION['msgsmtp'])){
			echo '<p style="color: blue"><i>'. $_SESSION['msgsmtp'] .'</i></p>';
			unset($_SESSION['msgsmtp']);
		}
	?>
</div>
<div class="tabbable">
	<div class="col-md-8 col-md-offset-2 table-responsive">
		<form action="" method="post">			
			<table class="table">	
				<br>
				<tr><label for="">Mail from</label></tr>
				<tr><input type="email" name="mail_from" style="width: 100%" value="<?= $smtp['mail_from'] ?>"></tr>
				<tr><p style="color: red"><?= $mail_fromErr ?></p></tr>
				<br>
				<tr><label for="">From name</label></tr>
				<tr><input type="text" name="from_name" style="width: 100%" value="<?= $smtp['from_name'] ?>"></tr>
				<tr><p style="color: red"><?= $from_nameErr ?></p></tr>
				<br>
				<tr><label for="">SMTP Authority</label></tr>
				<tr><input type="text" name="smtp_auth" style="width: 100%" value="<?= $smtp['smtp_auth'] ?>"></tr>
				<tr><p style="color: red"><?= $smtp_authErr ?></p></tr>
				<br>
				<tr><label for="">SMTP Host</label></tr>
				<tr><input type="text" name="smtp_host" style="width: 100%" value="<?= $smtp['smtp_host'] ?>"></tr>
				<tr><p style="color: red"><?= $smtp_hostErr ?></p></tr>
				<br>
				<tr><label for="">SMTP User</label></tr>
				<tr><input type="email" name="smtp_user" style="width: 100%" value="<?= $smtp['smtp_user'] ?>"></tr>
				<tr><p style="color: red"><?= $smtp_userErr ?></p></tr>
				<br>
				<tr><label for="">SMTP Password</label></tr>
				<tr><input type="password" name="smtp_pass" style="width: 100%" value="<?= $smtp['smtp_pass'] ?>"></tr>
				<tr><p style="color: red"><?= $smtp_passErr ?></p></tr>
				<br>
				<tr><label for="">SMTP Secure</label></tr>
				<tr>
					<select name="smtp_secure" style="width: 100%; height: 2.0em">
						<option> --- </option>
						<?php 
						$secure = ['SSL', 'TLS'];
                        foreach ($secure as $item){
                            $selectVar = $smtp['smtp_secure'] == $item ? 'selected' : '';
                            echo '<option '.$selectVar.' value="'. $item .'">'.   $item .'</option>'; 
	                        }
						?>
						<!-- <option value="SSL">SSL</option>
						<option value="TLS">TLS</option> -->						
					</select>
				</tr>
				<tr><p style="color: red"><?= $smtp_secureErr ?></p></tr>
				<br>				
				<tr><label for="">SMTP Port</label></tr>
				<tr>
					<select name="smtp_port" style="width: 100%; height: 2.0em">
						<option> --- </option>
						<?php 
						$port = ['465', '587'];
                        foreach ($port as $item){
                            $selectVar = $smtp['smtp_port'] == $item ? 'selected' : '';
                            echo '<option '.$selectVar.' value="'. $item .'">'.   $item .'</option>'; 
	                        }
						?>
						<!-- <option value="465">465</option>
						<option value="587">587</option> -->						
					</select>
				</tr>
				<tr><p style="color: red"><?= $smtp_portErr ?></p></tr>
				
			</table>
			<button type="submit" class="btn btn-success pull-right" name="btn_smtp" value="1">Submit</button>
			<a type="button" class="btn btn-default btn_cancel" href="#">Cancel</a>
		</form>
	</div>
</div>