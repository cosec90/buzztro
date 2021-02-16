<?php
include '../Admin_config/connection.php';
include '../Admin_controllers/seller.php';

$seller_id = $_GET['id'];

$get_seller_details = FETCH_SELLER_BY_ID($seller_id);

$seller_name = $get_seller_details['seller_name'];
$seller_company = $get_seller_details['company_name'];
$seller_mail = $get_seller_details['mail_id'];
$seller_mob = $get_seller_details['mob_no'];
$seller_gst = $get_seller_details['gst_no'];
$seller_add = $get_seller_details['company_addr'];
$seller_state = $get_seller_details['state'];
$seller_city = $get_seller_details['city'];
$seller_landmark = $get_seller_details['landmark'];
$seller_pincode = $get_seller_details['pincode'];


$folder_name = $seller_company."_".$seller_gst;
$directory = dirname(__DIR__)."\images"."\\".$folder_name;

if (isset($_POST['approve'])) 
{

	$appr_result = APPROVE_SELLER($seller_id);

	$subject = 'Buzztro Seller Approved';
	$body = 'Hello '.$seller_company.',<br><br>We are pleased to inform you that your request for becoming a seller has been approved by us.<br>Please visit the following link to login to your panel. Use your email as "Username".<br>www.buzztro.com';

	send_mail($seller_mail, $seller_company, $subject, $body);
}
else if(isset($_POST['reject']))
{
	$reason = $_POST['reason'];
	$reject_result = REJECT_SELLER($seller_id);

	$subject = 'Buzztro Seller Rejected';
	$body = 'Hello '.$seller_company.',<br><br>We are sorry to inform you that your request for becoming a seller has been rejected because of the following reason.<br><b>'.$reason.'.</b><br>You can reapply for seller after resolving the above issues.';

	send_mail($seller_mail, $seller_company, $subject, $body);
	delTree($directory);
}
else if(isset($_POST['block']))
{
	$mail_reason = $_POST['reason'];
	$reason = "Seller blocked because ".$_POST['reason'];
	$block_result = BLOCK_SELLER($seller_id, $reason);

	$subject = 'Buzztro Seller Blocked';
	$body = 'Hello '.$seller_company.',<br><br>We are sorry to inform you that your seller account panel has been blocked due to the following reason.<br><b>'.$mail_reason.'</b>.<br>If you think that was a mistake from our side please reply to this mail as soon as possible.';

	send_mail($seller_mail, $seller_company, $subject, $body);
}
else if(isset($_POST['unblock']))
{
	$unblock_result = UNBLOCK_SELLER($seller_id);

	$subject = 'Buzztro Seller Unblocked';
	$body = 'Hello '.$seller_company.',<br><br>We are pleased to inform you that your seller account panel has been unblocked and re-activated again. You can now continue to access your seller account.';

	send_mail($seller_mail, $seller_company, $subject, $body);
}


function send_mail($seller_mail, $seller_company, $subject, $body)
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
	$mail->addAddress($seller_mail, $seller_company);     // Add a recipient

	$mail->addReplyTo(EMAIL);
	// $mail->addReplyTo('info@example.com', 'Information');
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

function delTree($dir)
{ 
	$files = array_diff(scandir($dir), array('.', '..')); 

	foreach ($files as $file) { 
	    (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
	}

	return rmdir($dir); 	
} 
?>