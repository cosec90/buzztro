<?php
include '../Admin_config/connection.php';
include '../Admin_controllers/products.php';

$prod_id = $_GET['id'];
$prod_name = $_GET['name'];
$seller_company = $_GET['company'];
$details = GET_DETAILS($seller_company);

$seller_mail = $details[0]['mail_id'];
$seller_gst = $details[0]['gst_no'];

$dir = '../images/'.$seller_company.'_'.$seller_gst.'/products/'.$prod_id;
$main_dir = '../images/all_products/'.$prod_id;

if (isset($_POST['approve']))
{
	$new_prod_name = str_replace("'","\'",nl2br($_POST['prod_new_name_modal']));;
	$prod_desc = str_replace("'","\'",nl2br($_POST['prod_new_desc_modal']));
	$prod_tags = $_POST['inp_tags_modal'];
	$prod_category = $_POST['prod_cat_modal'];
	$rate = $_POST['rate_arr'];
	$timer = $_POST['timer'];
	$booking_amt = $_POST['book_amt'];

	
	$appr_result = APPROVE_PRODUCT($prod_id,$new_prod_name,$prod_desc,$prod_tags,$prod_category,$rate,$timer,$booking_amt);

	$subject = 'Buzztro Product Approved';
	$body = 'Hello '.$seller_company.',<br><br>We are pleased to inform you that your product <b>'.$prod_name.'</b> has been approved by us and is been displayed to the users to purchase.<br>Please visit the following link to login to your panel. Use your email as "Username".<br>www.buzztro.com';

		//send_mail($seller_mail, $seller_company, $subject, $body);
	
}
else if(isset($_POST['reject']))
{
	$reason = $_POST['reason'];
	$reject_result = REJECT_PRODUCT($prod_id);

	rrmdir($dir);
	rrmdir($main_dir);

	$subject = 'Buzztro Product Rejected';
	$body = 'Hello '.$seller_company.',<br><br>We are sorry to inform you that your product <b>'.$prod_name.'</b> has been rejected due to the following reason.<br><b>'.$reason.'.</b><br>You can re-register the product after resolving the above issues.';

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

function rrmdir($dir) { 
   if (is_dir($dir)) { 
     $objects = scandir($dir); 
     foreach ($objects as $object) { 
       if ($object != "." && $object != "..") { 
         if (is_dir($dir."/".$object))
           rrmdir($dir."/".$object);
         else
           unlink($dir."/".$object); 
       } 
     }
     rmdir($dir); 
   } 
 }
?>