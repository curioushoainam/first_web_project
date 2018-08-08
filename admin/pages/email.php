<?php 
require_once ('./class/mailer.php');
require_once ('./class/Configure.php');

$databaseFuncs = new DatabaseFuncs();
$validation = new Validation();
$configure = new Configure();

$config = $configure->getSMTPConfig();
// viewArr($config);
// exit();

$email=$subject=$content='';
$emailErr=$subjectErr=$contentErr='';
$feedback='';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['send_email']) && $_POST['send_email']) {  

        if(isset($_POST['email']) && $_POST['email']){
            $email = $validation->test_input($_POST['email']);            
            if(!($validation->isEmail($email)))
                $emailErr = '* Email không hợp lệ';
        } else {
            $emailErr = '* Có lỗi xảy ra';
        }
        
        if(isset($_POST['subject']) && $_POST['subject']){
            $subject = $validation->test_input($_POST['subject']);
        } else {
            $subjectlErr = '* Có lỗi xảy ra';
        }
       
        if(isset($_POST['content']) && $_POST['content']){
            $content = $_POST['content'];
        } else {
            $contentErr = '* Có lỗi xảy ra';
        }
        
        if(!($emailErr||$subjectErr||$contentErr)){            
            $result = sendMail($configure->getSMTPConfig(), $email, $subject, $content,1);
            if($result){                
                $email=$subject=$content='';
                $feedback = '<h5 style="color:blue"><i>Gửi mail thành công</i></h5>';
            } else                
                $feedback = '<h5 style="color:red"><i>Gửi mail thất bại</i></h5>';            
        }
    }
}

?>

<div class="email" style="">
    <div class="text-center"><?= $feedback ?></div>
	<form class="well form-horizontal" method="post">
        <fieldset class="creation-border">
            <legend class="creation-border">
                <div class="pull-left"><span><a href="?view=inbox">Inbox</a></span> || Gửi email </div>                
            </legend>            
			<div class="form-group">
                <label class="col-md-2 control-label">To</label>
                <div class="col-md-8">
                   <input id="email" name="email" class="form-control lock" type="email" required value="<?= $email ?>">
                </div>
                <div class="col-md-2 error">
                    <p><?= $emailErr ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Subject</label>
                <div class="col-md-8">
                   <input id="subject" name="subject" class="form-control lock" type="text" required value="<?= $subject ?>">
                </div>
                <div class="col-md-2 error">
                    <p><?= $subjectErr ?></p>
                </div>
            </div>            

            <div class="form-group">
                <label class="col-md-2 control-label">Chi tiết</label>
                <div class="col-md-8">                  
                   <?php
                    echo ckeditor("content", $content, array('15em','100%'));
                    ?>
                </div>
                <div class="col-md-2 error">
                    <p><?= $contentErr ?></p>
                </div>
            </div>            

            <!-- =============================================== -->
            <div class="form-group" >
                <div class="col-md-8 col-md-offset-2">
                    <div class="pull-right" style="text-align: right;">
                        <button type="submit" class="btn btn-success" name="send_email" id="send_email" value="true">Send</button>
                        <a type="button" class="btn btn-default" href="?view=inbox" >Cancel</a>
                    </div>
                </div>      
            </div>                      
        </fieldset>
    </form>
</div>