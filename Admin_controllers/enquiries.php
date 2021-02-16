<?php 
error_reporting(0);

function ADD_ENQUIRY($id,$name,$subject,$email,$msg)
{
	include '../Admin_config/connection.php';

	$uid = strtoupper("BUZZ_QUERY".uniqid());

	$sql = "INSERT INTO `user_enquiry` (`query_no`, `user_Id`, `user_name`, `user_subject`, `user_email`, `user_msg`, `datetime`) VALUES ('$uid','$id','$name', '$subject', '$email', '$msg','$date_time')";
	$result=mysqli_query($conn,$sql);

	if ($result) 
	{
		$log_sql = "INSERT INTO `buzztro_error_log`(`component`, `description`, `date_time`) VALUES ('Enquiry','New User Enquiry','$date_time')";
		$log_result=mysqli_query($conn,$log_sql);

		echo '<script type="text/javascript">alert ("Query Submitted. Admin will contact you within 24 hours");';
		echo 'window.location.href = "../contact.php?query_submitted";';
		echo '</script>';
	}
}

function ADD_ABOUT_ENQUIRY($comp_name,$mob_num,$email)
{
	include '../Admin_config/connection.php';

	$sql = "INSERT INTO `about_seller_inquiry` (`seller_company`, `seller_mob`, `seller_mail`, `datetime`) VALUES ('$comp_name', '$mob_num', '$email','$date_time')";
	$result=mysqli_query($conn,$sql);

	if ($result) 
	{
		echo '<script type="text/javascript">alert ("Query Submitted. Admin will contact you within 24 hours");';
		echo 'window.location.href = "../about.php?query_submitted";';
		echo '</script>';
	}
}

?>