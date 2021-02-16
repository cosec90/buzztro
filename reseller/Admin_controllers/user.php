<?php 

error_reporting(0);

function USER_VALIDATE($adm,$oldpass){
 	include '../Admin_config/connection.php';

  	$sql= "SELECT `seller_password` FROM `seller_login` WHERE `seller_username` = '$adm' && `seller_password` = '$oldpass'";

  	$check = mysqli_query($conn, $sql);
  	$row = mysqli_fetch_assoc($check);
  	$db_pass = $row['seller_password'];

  	return($db_pass);
 
 }

  function USER_CHANGE_PASS($adm,$newpass){
 	include '../Admin_config/connection.php';

 	$change_sql= "UPDATE `seller_registration` SET `pass`='$newpass' WHERE `mail_id`='$adm'";
	$change_result=mysqli_query($conn,$change_sql);

  	$sql= "UPDATE `seller_login` SET `seller_password`='$newpass' WHERE `seller_username` = '$adm'";

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

 ?>