<?php 

error_reporting(0);

function USER_VALIDATE($adm,$oldpass){
 	include '../Admin_config/connection.php';

  	$sql= "SELECT `adm_password` FROM `buzztro_admin` WHERE `adm_username` = '$adm' && `adm_password` = '$oldpass'";

  	$check = mysqli_query($conn, $sql);
  	$row = mysqli_fetch_assoc($check);
  	$db_pass = $row['adm_password'];

  	return($db_pass);
 
 }

  function USER_CHANGE_PASS($adm,$newpass){
 	include '../Admin_config/connection.php';

  	$sql= "UPDATE `buzztro_admin` SET `adm_password`='$newpass' WHERE `adm_username` = '$adm'";

	if (mysqli_query($conn, $sql)) {
		session_destroy();
		echo '<script type="text/javascript">alert("Password Changed Successfully");';
		echo 'window.location.href = "../views/login.php?password_changed";';
		echo '</script>';
	} else {
		echo '<script type="text/javascript">alert("Error Updating Password");';
		echo 'window.location.href = "../views/changepass.php?error";';
		echo '</script>';
	}
 }

 function FETCH_USERS()
{
	include '../Admin_config/connection.php';

	$sql= "SELECT * FROM `user_info`";
	$result=mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$user_data[] = $row;
		}
	}
	return($user_data);
}

function BLOCK_USER($id, $reason)
{
	include '../Admin_config/connection.php';

	$result=mysqli_query($conn,"UPDATE `user_info` SET `user_status`='Blocked',`block_reason`='$reason' WHERE `user_id` = '$id'");

	if ($result)
	{
		$log_sql = "INSERT INTO `buzztro_error_log`(`component`, `description`, `date_time`) VALUES ('User','User Blocked','$date_time')";
		$log_result=mysqli_query($conn,$log_sql);

		echo '<script type="text/javascript">alert ("User Blocked.");';
		echo 'window.location.href = "../views/manage_users.php?user_blocked";';
		echo '</script>';
	}
}

function UNBLOCK_USER($id)
{
	include '../Admin_config/connection.php';

	$result=mysqli_query($conn,"UPDATE `user_info` SET `user_status`='Active',`block_reason`='' WHERE `user_id` = '$id'");

	if ($result) 
	{
		$log_sql = "INSERT INTO `buzztro_error_log`(`component`, `description`, `date_time`) VALUES ('User','User Unblocked','$date_time')";
		$log_result=mysqli_query($conn,$log_sql);

		echo '<script type="text/javascript">alert ("User Unblocked.");';
		echo 'window.location.href = "../views/manage_users.php?user_unblocked";';
		echo '</script>';
	}
}

 ?>