<?php 
include '../Admin_config/connection.php';
include '../Admin_controllers/user.php';

if (isset($_POST['register_user'])) 
{
	$name = ucwords($_POST['name']);
	$mail = strtolower($_POST['usr_mail']);
	$mobile = $_POST['mob'];
	$add1 = $_POST['add1'];
	$add2 = $_POST['add2'];
	$landmark = ucwords($_POST['landmark']);
	$pincode = $_POST['pincode'];
	$state = $_POST['usr_state'];
	$city = $_POST['usr_city'];
	$pass = $_POST['usr_pass'];
	$cnf_password = $_POST['cnf_password'];
	$tnc = $_POST['tnc'];

	include '../api/check_pincode.php';

	if($message == 'true'){
		if ($tnc == "Agreed") 
		{
			if ($pass == $cnf_password) 
			{
				$newpass = md5($pass);

				$res = REGISTER_USER($name,$mail,$mobile,$add1,$add2,$landmark,$pincode,$newpass,$tnc,$state,$city);
			}
			else
			{
				echo '<script type="text/javascript">alert("Passwords did not match");';
				echo 'window.location.href = "../index.php";';
				echo '</script>';
			}
		}
		else
		{
			echo '<script type="text/javascript">alert("Please agree to the terms & conditions");';
			echo 'window.location.href = "../index.php";';
			echo '</script>';
		}
	}
	else{
			echo '<script type="text/javascript">alert("Shipment is not deliverable in your area");';
			echo 'window.location.href = "../index.php";';
			echo '</script>';
	}

	
}
