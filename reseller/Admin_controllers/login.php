<?php 

error_reporting(0);

function VALIDATE($username,$password){
	include '../Admin_config/connection.php';
	$sql= "SELECT * FROM `seller_login` WHERE `seller_username`='$username' AND `seller_password`='$password' AND `seller_status`='Active'";
	$result=mysqli_query($conn,$sql);
	$count=mysqli_num_rows($result);

	if ($count==1) {

		$last_login= "UPDATE `seller_login` SET `last_login`='$date_time' WHERE `seller_username`='$username'";
		$last_res=mysqli_query($conn,$last_login);

		$seller_data=mysqli_fetch_assoc($result);
	    $res = $seller_data;

	    return($res);
	} 
	else
	{
		$reg_sql= "SELECT * FROM `seller_registration` WHERE `mail_id`='$username' AND `pass`='$password' AND `seller_status` = 'Not Approved'";
		$reg_result=mysqli_query($conn,$reg_sql);
		$row_count=mysqli_num_rows($reg_result);
		
		if ($row_count==1) 
		{
			echo '<script type="text/javascript">alert("Seller not Approved. Please contact Admin");';
			echo 'window.location.href = "../views/login.php?not_approved";';
			echo '</script>';
		} 
		else
		{
			$block_sql= "SELECT * FROM `seller_registration` WHERE `mail_id`='$username' AND `pass`='$password' AND `seller_status` = 'Blocked'";
			$block_result=mysqli_query($conn,$block_sql);
			$block_count=mysqli_num_rows($block_result);
			
			if ($block_count==1) 
			{
				$block_data=mysqli_fetch_assoc($block_result);

				$blk = $block_data['reject_reason'];

				echo '<script type="text/javascript">alert("Seller blocked.\nReason : '.$blk.'");';
				echo 'window.location.href = "../views/login.php?blocked";';
				echo '</script>';
			} 
			else 
			{
				echo '<script type="text/javascript">alert ("Seller does not exist or rejected");';
				echo 'window.location.href = "../views/login.php?wrong_credentials";';
				echo '</script>';
			}
		}
	}
}

function CHECK_USER($username){
	include '../Admin_config/connection.php';
	
	$sql= "SELECT `seller_username` FROM `seller_login` WHERE `seller_username`='$username' AND `seller_status`='Active'";
	$result=mysqli_query($conn,$sql);
	$count=mysqli_num_rows($result);

	if ($count==1) {
		$admin_data=mysqli_fetch_assoc($result);
	    $res = $admin_data;
	} 

	return($res);
}

function FORGET_PASS($admin,$newpass){
 	include '../Admin_config/connection.php';

 	$change_sql= "UPDATE `seller_registration` SET `pass`='$newpass' WHERE `mail_id`='$admin'";
	$change_result=mysqli_query($conn,$change_sql);

  	$sql= "UPDATE `seller_login` SET `seller_password`='$newpass' WHERE `seller_username` = '$admin'";
  	$result=mysqli_query($conn,$sql);

	if ($result){
		echo '<script type="text/javascript">alert("Password Changed Successfully");';
		echo 'window.location.href = "../views/login.php?password_changed";';
		echo '</script>';
	}else{
		echo '<script type="text/javascript">alert("Error Updating Password");';
		echo 'window.location.href = "../views/resetpassword.php?error";';
		echo '</script>';
	}
 }

 ?>