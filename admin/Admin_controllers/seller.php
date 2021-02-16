<?php 
error_reporting(0);

function VERIFY_SELLER($mail,$mob,$gst_no)
{
	include '../Admin_config/connection.php';

	$mail_sql= "SELECT `mail_id` FROM `seller_registration` WHERE `mail_id` = '$mail'";
	$mail_result=mysqli_query($conn,$mail_sql);
	$mail_count = mysqli_num_rows($mail_result);

	if ($mail_count == 0) 
	{
		$mob_sql= "SELECT `mob_no`, `alt_mob` FROM `seller_registration` WHERE `mob_no` = '$mob' OR `alt_mob` = '$mob'";
		$mob_result=mysqli_query($conn,$mob_sql);
		$mob_count = mysqli_num_rows($mob_result);

		if ($mob_count == 0) 
		{
			$gst_sql= "SELECT `gst_no` FROM `seller_registration` WHERE `gst_no` = '$gst_no'";
			$gst_result=mysqli_query($conn,$gst_sql);
			$gst_count = mysqli_num_rows($gst_result);

			if ($gst_count == 0) 
			{
				return ("Verified");
			}
			else
			{
				echo '<script type="text/javascript">alert ("GST number already exists");';
				echo 'window.location.href = "../views/become_a_seller.php?gst_exists";';
				echo '</script>';
			}
		}
		else
		{
			echo '<script type="text/javascript">alert ("Mobile number already exists");';
			echo 'window.location.href = "../views/become_a_seller.php?mobile_exists";';
			echo '</script>';
		}
	}
	else
	{
		echo '<script type="text/javascript">alert ("Email ID already exists");';
		echo 'window.location.href = "../views/become_a_seller.php?email_exists";';
		echo '</script>';
	}
}

function SELLER_ADD($name,$company,$company_address,$gst_no,$mob,$alt_mob,$mail,$pwd,$datetime,$file1,$file2,$file3,$file4,$state,$city,$landmark,$pincode)
{
	include '../Admin_config/connection.php';

	$newId = "seller_".strtoupper(substr(uniqid(),0,10));
	
	$sql= "INSERT INTO `seller_registration`(`seller_Id`, `seller_name`, `company_name`, `company_addr`, `state`, `city`, `landmark`, `pincode`, `gst_no`, `mob_no`, `alt_mob`, `mail_id`, `pass`, `timestamp`, `file1`, `file2`, `file3`, `file4`) VALUES ('$newId','$name','$company','$company_address','$state','$city','$landmark','$pincode', '$gst_no','$mob','$alt_mob','$mail','$pwd','$datetime','$file1','$file2','$file3','$file4')";
	$result=mysqli_query($conn,$sql);

	if ($result) 
	{
		echo '<script type="text/javascript">alert ("Registration Successful. Please wait for Admin approval");';
		echo 'window.location.href = "../../reseller/views/login.php?registration_successful";';
		echo '</script>';

		$log_sql = "INSERT INTO `buzztro_error_log`(`component`, `description`, `date_time`) VALUES ('Seller','New Registration','$datetime')";
		$log_result=mysqli_query($conn,$log_sql);
	}
}

function FETCH_SELLERS()
{
	include '../Admin_config/connection.php';

	$sql= "SELECT * FROM `seller_registration` WHERE `seller_status` = 'Not Approved'";
	$result=mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$seller_data[] = $row;
		}
	}
	return($seller_data);
}

function FETCH_SELLER_BY_ID($seller_id)
{
	include '../Admin_config/connection.php';

	$sql= "SELECT * FROM `seller_registration` WHERE `seller_id` = '$seller_id'";
	$result=mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$seller_data = $row;
		}
	}
	return($seller_data);
}

function APPROVE_SELLER($id)
{
	include '../Admin_config/connection.php';
	$datetime = date("Y-m-d H:i:s");

	$sql= "UPDATE `seller_registration` SET `seller_status` = 'Approved' WHERE `seller_Id` = '$id'";
	$result=mysqli_query($conn,$sql);

	//Fetch Columns
	if ($result) 
	{
		$fetch_sql= "SELECT * FROM `seller_registration` WHERE `seller_Id` = '$id'";
		$fetch_result=mysqli_query($conn,$fetch_sql);
		
		$count = mysqli_num_rows($fetch_result);

		if ($count > 0) {
			while($row = mysqli_fetch_assoc($fetch_result))
			{
				$seller_data = $row;
			}
		}

		$login_sql= "INSERT INTO `seller_login`(`seller_Id`, `seller_name`, `seller_username`, `seller_password`, `seller_status`) VALUES ('$id','".$seller_data['seller_name']."','".$seller_data['mail_id']."','".$seller_data['pass']."','Active')";
		$login_result=mysqli_query($conn,$login_sql);
	}
	
	
	if ($login_result) 
	{
		$log_sql = "INSERT INTO `buzztro_error_log`(`component`, `description`, `date_time`) VALUES ('Seller','Seller Approved','$datetime')";
		$log_result=mysqli_query($conn,$log_sql);

		echo '<script type="text/javascript">alert ("Seller Approved.");';
		echo 'window.location.href = "../views/validate_sellers.php?seller_approved";';
		echo '</script>';
	}
}

function REJECT_SELLER($id)
{
	include '../Admin_config/connection.php';
	$datetime = date("Y-m-d H:i:s");

	$sql= "DELETE FROM `seller_registration` WHERE `seller_Id` = '$id'";
	$result=mysqli_query($conn,$sql);

	if ($result) 
	{
		$log_sql = "INSERT INTO `buzztro_error_log`(`component`, `description`, `date_time`) VALUES ('Seller','Seller Rejected','$datetime')";
		$log_result=mysqli_query($conn,$log_sql);

		echo '<script type="text/javascript">alert ("Seller Rejected.");';
		echo 'window.location.href = "../views/validate_sellers.php?seller_rejected";';
		echo '</script>';
	}
}

function VIEW_SELLERS()
{
	include '../Admin_config/connection.php';

	$sql= "SELECT * FROM `seller_registration`";
	$result=mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$seller_data[] = $row;
		}
	}
	return($seller_data);
}

function BLOCK_SELLER($id, $reason)
{
	include '../Admin_config/connection.php';
	$datetime = date("Y-m-d H:i:s");

	$sql= "UPDATE `seller_login` SET `seller_status` = '$reason' WHERE `seller_Id` = '$id'";
	$result=mysqli_query($conn,$sql);

	$blksql= "UPDATE `seller_registration` SET `seller_status` = 'Blocked', `reject_reason` = '$reason' WHERE `seller_Id` = '$id'";
	$blkresult=mysqli_query($conn,$blksql);

	if ($blkresult) 
	{
		$log_sql = "INSERT INTO `buzztro_error_log`(`component`, `description`, `date_time`) VALUES ('Seller','Seller Blocked','$datetime')";
		$log_result=mysqli_query($conn,$log_sql);

		echo '<script type="text/javascript">alert ("Seller Blocked.");';
		echo 'window.location.href = "../views/manage_sellers.php?seller_blocked";';
		echo '</script>';
	}
}

function UNBLOCK_SELLER($id)
{
	include '../Admin_config/connection.php';
	$datetime = date("Y-m-d H:i:s");

	$sql= "UPDATE `seller_login` SET `seller_status` = 'Active' WHERE `seller_Id` = '$id'";
	$result=mysqli_query($conn,$sql);

	$unblksql= "UPDATE `seller_registration` SET `seller_status` = 'Approved', `reject_reason` = '' WHERE `seller_Id` = '$id'";
	$unblkresult=mysqli_query($conn,$unblksql);

	if ($unblkresult) 
	{
		$log_sql = "INSERT INTO `buzztro_error_log`(`component`, `description`, `date_time`) VALUES ('Seller','Seller Unblocked','$datetime')";
		$log_result=mysqli_query($conn,$log_sql);

		echo '<script type="text/javascript">alert ("Seller Unblocked.");';
		echo 'window.location.href = "../views/manage_sellers.php?seller_unblocked";';
		echo '</script>';
	}
}

function LAST_LOGIN($username)
{
	include '../Admin_config/connection.php';

	$sql= "SELECT `last_login` FROM `seller_login` WHERE `seller_username`='$username'";
	$result=mysqli_query($conn,$sql);

	$row = mysqli_fetch_assoc($result);

	return($row);
}

function CHECK_PINCODE($pincode)
{
	include '../Admin_config/connection.php';

	$sql= "SELECT * FROM `pincode` WHERE `pincode` = '$pincode'";
	$result=mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($result);
	return $pincode_data = $row['pick_up'];
}

function FETCH_PINCODE(){

	include '../Admin_config/connection.php';
	$sql= "SELECT * FROM `pincode`";
	$result=mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);
	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$seller_data[] = $row;
		}
	}
	
	return($seller_data);

}
?>