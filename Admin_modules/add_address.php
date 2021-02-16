<?php 
include '../Admin_config/connection.php';
include '../Admin_controllers/user.php';
session_start();

if (isset($_POST['register_user'])) 
{
	
	$landmark = ucwords($_POST['landmark']);
	$pincode = $_POST['pincode'];
	$state = $_POST['usr_state'];
    $city = $_POST['usr_city'];
    $add1 = $_POST['add1'];
	$user_id = $_SESSION['iser_id'];
	$mail = $_SESSION['user_mail'];
	$name = $_SESSION['user_name'];
	$mobile = $_SESSION['user_mob'];


    
	include '../api/check_pincode.php';


	echo $message;
	if($message == 'true'){
		

		$res = ADD_USER_ADDRESS($user_id,$add1,$landmark,$pincode,$state,$city);
			
	}
	else{
			echo '<script type="text/javascript">alert("Shipment is not deliverable in your area");';
			echo 'window.location.href = "../edit_profile.php";';
			echo '</script>';
	}

	
}
