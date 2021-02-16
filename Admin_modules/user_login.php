<?php 
include '../Admin_config/connection.php';
include '../Admin_controllers/user.php';

if (isset($_POST['sign_submit']))
{
	$mobile = $_POST['sign_mob'];
	$pass = md5($_POST['sign_pass']);

	$result = VALIDATE($mobile,$pass);

	//print_r($result);

	if(!empty($result))
	{
		session_start();
		$_SESSION=$result;
		header('Location: ../index.php');
	}else {
		echo '<script type="text/javascript">alert ("Invalid Credentials");';
		echo 'window.location.href = "../index.php?wrong_credentials";';
		echo '</script>';
	}
}

?>