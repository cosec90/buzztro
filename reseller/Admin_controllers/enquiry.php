<?php 
error_reporting(0);

function FETCH_SELLER_DETAILS($id)
{
	include '../Admin_config/connection.php';
	
	$sql= "SELECT `company_name` FROM `seller_registration` WHERE `seller_Id`='$id'";
	$result=mysqli_query($conn,$sql);
	$count=mysqli_num_rows($result);

	if ($count==1) {
		$seller_data=mysqli_fetch_assoc($result);
	    $res = $seller_data['company_name'];

	    return($res);
	} 
}

function ADD_ENQUIRY($id,$name,$msg)
{
	include '../Admin_config/connection.php';

	$uid = strtoupper("BUZZ_QUERY".uniqid());

	$sql = "INSERT INTO `seller_enquiry` (`query_no`, `seller_Id`, `seller_company`, `seller_msg`,`datetime`) VALUES ('$uid','$id','$name','$msg','$date_time')";
	$result=mysqli_query($conn,$sql);

	if ($result) 
	{
		$log_sql = "INSERT INTO `buzztro_error_log`(`component`, `description`, `date_time`) VALUES ('Enquiry','New Enquiry','$date_time')";
		$log_result=mysqli_query($conn,$log_sql);

		echo '<script type="text/javascript">alert ("Query Submitted. Admin will contact you within 24 hours");';
		echo 'window.location.href = "../views/contact.php?query_submitted";';
		echo '</script>';
	}
}


?>