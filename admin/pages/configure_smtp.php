<?php 
require_once ('./class/Validation.php');
$validation = new Validation();

$mail_fromErr = $from_nameErr = $smtp_authErr = $smtp_hostErr = $smtp_userErr = $smtp_passErr = $smtp_secureErr = $smtp_portErr = NULL;
$mail_from = $from_name = $smtp_auth = $smtp_host = $smtp_user = $smtp_pass = $smtp_secure = $smtp_port = NULL;
$result = NULL;

if ($_SERVER["REQUEST_METHOD"] == "POST"){	
	if(isset($_POST['smtp_save']) && $_POST['smtp_save']) {				
		if(isset($_POST['mail_from']) && $_POST['mail_from']){
			$mail_from = $validation->test_input($_POST['mail_from']);			
		} else {
			$mail_fromErr = 'Không được trống';			
		}

		if(isset($_POST['from_name']) && $_POST['from_name']){
			$from_name = $validation->test_input($_POST['from_name']);
		} else {
			$from_nameErr = 'Không được trống';			
		}

		if(isset($_POST['smtp_auth']) && $_POST['smtp_auth']){
			$smtp_auth = $validation->test_input($_POST['smtp_auth']);
		} else {
			$smtp_authErr = 'Không được trống';
		}

		if(isset($_POST['smtp_host']) && $_POST['smtp_host']){
			$smtp_host = $validation->test_input($_POST['smtp_host']);
		} else {
			$smtp_hostErr = 'Không được trống';
		}

		if(isset($_POST['smtp_user']) && $_POST['smtp_user']){
			$smtp_user = $validation->test_input($_POST['smtp_user']);
		} else {
			$smtp_userErr = 'Không được trống';
		}

		if(isset($_POST['smtp_pass']) && $_POST['smtp_pass']){
			$smtp_pass = $validation->test_input($_POST['smtp_pass']);
		} else {
			$smtp_passErr = 'Không được trống';
		}
		
		if(isset($_POST['smtp_secure']) && $_POST['smtp_secure']){
			$smtp_secure = $validation->test_input($_POST['smtp_secure']);
		} else {
			$smtp_secureErr = 'Không được trống';
		}

		if(isset($_POST['smtp_port']) && $_POST['smtp_port']){
			$smtp_port = $validation->test_input($_POST['smtp_port']);			
		} else {
			$smtp_portErr = 'Không được trống';			
		}

		if(!($mail_fromErr||$from_nameErr||$smtp_authErr||$smtp_hostErr||$smtp_userErr||$smtp_passErr||$smtp_secureErr||$smtp_portErr)){
			$result = $configure->updateSMTPConfig(array($mail_from,$from_name,$smtp_auth,$smtp_host,$smtp_user,$smtp_pass,$smtp_secure,$smtp_port));
			if($result){
				$result = 'Cập nhật thông tin vào database thành công';
				echo '<script type="text/javascript">alert("'. $result .'")</script>';
			} else {
				$result = 'Cập nhật thông tin vào database thất bại';
				echo '<script type="text/javascript">alert("'. $result .'")</script>';
			}
		} 
	}
}

$smtp = $configure->getSMTPConfig();	
?>

<form class="well form-horizontal" method="post" enctype="multipart/form-data">
	<fieldset class="creation-border">
		<legend class="creation-border">
			<div class="pull-left">SMTP Setting </div>
			<div class="pull-right"><input type="button" class="btn btn-info" id="smtp_edit" name="smtp_edit" value="Edit"></div>		
		</legend>        

	    <div class="form-group">
	        <label class="col-md-2 control-label">Mail From</label>
	        <div class="col-md-8">
	           <input id="mail_from" name="mail_from" class="form-control smtp" type="text" required value="<?= $smtp->mail_from ?>">
	        </div>
	        <div class="col-md-2 error">
	            <p><?= $mail_fromErr ?></p>
	        </div>
	    </div>

	    <div class="form-group">
	        <label class="col-md-2 control-label">From Name</label>
	        <div class="col-md-8">
	           <input id="from_name" name="from_name" class="form-control smtp" type="text" required value="<?= $smtp->from_name ?>">
	        </div>
	        <div class="col-md-2 error">
	            <p><?= $from_nameErr ?></p>
	        </div>
	    </div>
	    <div class="form-group">
	        <label class="col-md-2 control-label">SMTP Authority</label>
	        <div class="col-md-8">
	           <input id="smtp_auth" name="smtp_auth" class="form-control smtp" type="text" required value="<?= $smtp->smtp_auth ?>">
	        </div>
	        <div class="col-md-2 error">
	            <p><?= $smtp_authErr ?></p>
	        </div>
	    </div>

	    <div class="form-group">
	        <label class="col-md-2 control-label">SMTP Host</label>
	        <div class="col-md-8">
	           <input id="smtp_host" name="smtp_host" class="form-control smtp" type="text" required value="<?= $smtp->smtp_host ?>">
	        </div>
	        <div class="col-md-2 error">
	            <p><?= $smtp_hostErr ?></p>
	        </div>
	    </div>

	    <div class="form-group">
	        <label class="col-md-2 control-label">SMTP User</label>
	        <div class="col-md-8">
	           <input id="smtp_user" name="smtp_user" class="form-control smtp" type="text" required value="<?= $smtp->smtp_user ?>">
	        </div>
	        <div class="col-md-2 error">
	            <p><?= $smtp_userErr ?></p>
	        </div>
	    </div>
		
	    <div class="form-group">
	        <label class="col-md-2 control-label">SMTP Password</label>
	        <div class="col-md-8">
	           <input id="smtp_pass" name="smtp_pass" class="form-control smtp" type="password" required value="<?= $smtp->smtp_pass ?>">
	        </div>
	        <div class="col-md-2 error">
	            <p><?= $smtp_passErr ?></p>
	        </div>
	    </div>

	    <div class="form-group">
	        <label class="col-md-2 control-label">SMTP Secure</label>
	        <div class="col-md-8">
	           <input id="smtp_secure" name="smtp_secure" class="form-control smtp" type="text" required value="<?= $smtp->smtp_secure ?>">
	        </div>
	        <div class="col-md-2 error">
	            <p><?= $smtp_secureErr ?></p>
	        </div>
	    </div>

	    <div class="form-group">
	        <label class="col-md-2 control-label">SMTP Port</label>
	        <div class="col-md-8">
	           <input id="smtp_port" name="smtp_port" class="form-control smtp" type="text" required value="<?= $smtp->smtp_port ?>">
	        </div>
	        <div class="col-md-2 error">
	            <p><?= $smtp_portErr ?></p>
	        </div>
	    </div>
         <!-- inputGroupContainer -->
		<div class="form-group" >
			<div class="col-md-8 col-md-offset-2">
				<div class="pull-right" style="text-align: right;">
					<button type="submit" class="btn btn-success" name="smtp_save" id="smtp_save" value="true">Save</button>
					<button type="button" class="btn btn-default" name="smtp_cancel" id="smtp_cancel" onclick="#">Cancel</button>
				</div>
			</div>		
		</div>						
	</fieldset>
</form>

<script>
	$(document).ready(function(){
		$('.smtp').attr('readonly', 'readonly');		
		$("#smtp_save").hide();
		$("#smtp_cancel").hide();

		$("#smtp_edit").click(function(){			
			$('.smtp').removeAttr('readonly');			
			$("#smtp_save").show();
			$("#smtp_cancel").show();
			$("#smtp_edit").hide();
		});

		$("#smtp_cancel").click(function(){			
			$('.smtp').attr('readonly', 'readonly');
			$("#smtp_save").hide();			
			$("#smtp_cancel").hide();
			$("#smtp_edit").show();
		});
	});
</script>