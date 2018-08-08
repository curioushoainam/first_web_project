<?php
error_reporting(0);
function sendMail($smtp_config, $nguoi_nhan,$tieu_de,$noi_dung, $bat_html=0)
{
	include 'class.phpmailer.php';
	include 'class.smtp.php';	
	$mailcfg['mailfrom'] = $smtp_config->mail_from;
	$mailcfg['fromname'] = $smtp_config->from_name;
	$mailcfg['smtpauth'] = $smtp_config->smtp_auth;
	$mailcfg['smtphost'] = $smtp_config->smtp_host;
	$mailcfg['smtpuser'] = $smtp_config->smtp_user;
	$mailcfg['smtppass'] = $smtp_config->smtp_pass;
	$mailcfg['smtpsecure'] = $smtp_config->smtp_secure;
	$mailcfg['smtpport'] =  $smtp_config->smtp_port;
	
	// $mailcfg['mailfrom'] = 'curiousnamhoaitruong@gmail.com';
	// $mailcfg['fromname'] = 'Hỗ trợ website xyz.com';
	// $mailcfg['smtpauth'] = 1;
	// $mailcfg['smtphost'] = 'smtp.gmail.com';
	// $mailcfg['smtpuser'] = 'curiousnamhoaitruong@gmail.com'; //ten dang nhap gmail (server mail ben thu 3)
	// $mailcfg['smtppass'] = 'afthbmkrfeclpmcn'; //mat khau dang nhap email
	// $mailcfg['smtpsecure'] = 'ssl';//:'tls';
	// $mailcfg['smtpport'] =  465;//587

	$mail = new PHPMailer();
	$mail->IsSMTP(); // set mailer to use SMTP
	
	$mail->Host = $mailcfg['smtphost']; // specify main and backup server
	$mail->Port = $mailcfg['smtpport']; // set the port to use
	$mail->SMTPAuth = $mailcfg['smtpauth']==0?false:true; // turn on SMTP authentication
	$mail->SMTPSecure = $mailcfg['smtpsecure'];
	$mail->Username = $mailcfg['smtpuser']; // your SMTP username or your gmail username
	$mail->Password = $mailcfg['smtppass']; // your SMTP password or your gmail password
	$from =  "".$mailcfg['mailfrom'].""; // Reply to this email
	$to   =  $nguoi_nhan; // Recipients email ID
	$name =  $nguoi_nhan; // Recipient's name
	$mail->From = $from;
	$mail->FromName = $mailcfg['fromname']; // Name to indicate where the email came from when the recepient received
	$mail->AddAddress($to,$name);
	$mail->AddReplyTo($from,"Administrator");
	$mail->WordWrap = 50; // set word wrap
	$mail->IsHTML($bat_html); // send as HTML
	$mail->CharSet= "utf-8";
	$mail->Subject = $tieu_de;
	$mail->Body = $noi_dung; //HTML Body
	$mail->AltBody = "Mail được gửi từ abc.com"; //Text Body
	//$email->SMTPDebug = true;
	//$mail->SMTPDebug = 2;
	//echo '<pre>',print_r($mail),'</pre>';exit;
	return $mail->Send();
}
?>