<?php
include '../Admin_config/connection.php';
include '../Admin_controllers/user.php';
session_start();



if(isset($_POST['edit_user'])){

    $name = ucwords($_POST['name']);
    $mail = strtolower($_POST['usr_mail']);
	$add1 = $_POST['add1'];
	$add2 = $_POST['add2'];
	$landmark = ucwords($_POST['landmark']);
	$pincode = $_POST['pincode'];
	$state = $_POST['usr_state'];
    $city = $_POST['usr_city'];
    $user_id = $_SESSION['user_id'];
    $mobile = $_SESSION['user_mob'];
    
    include '../api/check_pincode.php';

    // echo $name;
    // echo "<br>";
    // echo $mail;
    // echo "<br>";
    // echo $add1;
    // echo "<br>";
    // echo $add2;
    // echo "<br>";
    // echo $landmark;
    // echo "<br>";
    // echo $pincode;
    // echo "<br>";
    // echo $state;
    // echo "<br>";
    // echo $city;
    // echo "<br>";
    // echo $user_id;
    // echo "<br>";
    // echo $mobile;
    
    if($message == 'true'){
        
        $update_user = UPDATE_USER($name,$mail,$mobile,$add1,$add2,$landmark,$pincode,$state,$city,$user_id);
        // echo "in if";       
	}
	else{
			echo '<script type="text/javascript">alert("Shipment is not deliverable in your area");';
			echo 'window.location.href = "../index.php";';
			echo '</script>';
	}

	
    



}


?>