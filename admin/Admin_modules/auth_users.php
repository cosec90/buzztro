<?php
include '../Admin_config/connection.php';
include '../Admin_controllers/user.php';

$user_id = $_GET['id'];
$user_name = $_GET['name'];
$user_mail = $_GET['mail'];

if(isset($_POST['block']))
{
	$mail_reason = $_POST['reason'];
	$reason = "User blocked because ".$_POST['reason'];
	$block_result = BLOCK_USER($user_id, $reason);

	$subject = 'Buzztro User Blocked';
	$body = 'Hello '.$user_name.',<br><br>We are sorry to inform you that your Buzztro account has been blocked due to the following reason.<br><b>'.$mail_reason.'</b>.<br>If you think that was a mistake from our side please reply to this mail as soon as possible.';

	send_mail($user_mail, $user_name, $subject, $body);
}
else if(isset($_POST['unblock']))
{
	$unblock_result = UNBLOCK_USER($user_id);

	$subject = 'Buzztro User Unblocked';
	$body = 'Hello '.$user_name.',<br><br>We are pleased to inform you that your Buzztro account has been unblocked and re-activated again. You can now continue to access your account and resume shopping.';

	send_mail($user_mail, $user_name, $subject, $body);
}


function send_mail($user_mail, $user_name, $subject, $body)
{
	include '../views/credential.php';
	require '../views/phpmailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;

	$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = EMAIL;                 // SMTP username
	$mail->Password = PASS;                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to

	$mail->setFrom(EMAIL, 'Buzztro');
	$mail->addAddress($user_mail, $user_name);     // Add a recipient

	$mail->addReplyTo(EMAIL);

	// $mail->addCC('cc@example.com');
	// $mail->addBCC('bcc@example.com');
	// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = $subject;
	$mail->Body    = $body;

	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
	    echo 'Message has been sent';
	}
}

?>