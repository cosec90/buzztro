<?php 

error_reporting(0);

function REGISTER_USER($name,$mail,$mobile,$add1,$add2,$landmark,$pincode,$newpass,$tnc,$stat,$cit)
{
	include '../Admin_config/connection.php';

	$concat_addr = $add1.",".$add2;
	$mob_check=mysqli_query($conn,"SELECT * FROM `user_info` WHERE `user_mob`='$mobile'");

	if (mysqli_num_rows($mob_check) == 0) 
	{
		$userid = strtoupper(substr(uniqid(),0,6));

		$main_sql= mysqli_query($conn,"INSERT INTO `user_info`(`user_id`, `user_name`, `user_mail`, `user_mob`, `add1`, `add2`,`state`,`city`, `landmark`, `pincode`, `tnc`, `usr_pass`, `registration_date`) VALUES ('$userid','$name','$mail','$mobile','$add1','$add2','$stat','$cit','$landmark','$pincode','$tnc','$newpass','$date_time')");

		$concat_addr = $add1.",".$add2;

		$add_res = mysqli_query($conn,"INSERT INTO `user_address`(`user_id`,`state`,`city`,`landmark`,`pincode`,`address`) VALUES ('$userid','$stat','$cit','$landmark','$pincode','$concat_addr')");

		if ($main_sql && $add_res)
		{
			echo '<script type="text/javascript">alert("Registration Successful");';
			echo 'window.location.href = "../index.php";';
			echo '</script>';
		} 	
		else
		{
			echo '<script type="text/javascript">alert("Something went wrong. Please try again");';
			echo 'window.location.href = "../index.php";';
			echo '</script>';
		}
	}
	else
	{
		echo '<script type="text/javascript">alert("Mobile Number already exists");';
		echo 'window.location.href = "../index.php";';
		echo '</script>';
	}
}

function VALIDATE($username,$password)
{
	include '../Admin_config/connection.php';

	$sql= "SELECT * FROM `user_info` WHERE `user_mob`='$username' AND `usr_pass`='$password' AND `user_status`='Active'";
	$result=mysqli_query($conn,$sql);
	$count=mysqli_num_rows($result);

	if ($count==1) {

		$last_login = mysqli_query($conn,"UPDATE `user_info` SET `last_login`='$date_time' WHERE `user_mob`='$username'");

		$user_data=mysqli_fetch_assoc($result);
	    $res = $user_data;
	} 

	return($res);
}

function UPDATE_USER($nam,$email,$mob,$ad1,$ad2,$land,$code,$stat,$cit,$id)
{
	include '../Admin_config/connection.php';

	$sql= "UPDATE `user_info` SET `user_name`='$nam', `user_mail`='$email', `user_mob`='$mob', `add1`='$ad1', `add2`='$ad2', `landmark`='$land', `pincode`='$code', `state`='$stat', `city`='$cit' WHERE `user_id`='$id' AND `user_status`='Active'";
	$result=mysqli_query($conn,$sql);

	if ($result) 
	{
		session_destroy();
		echo '<script type="text/javascript">alert ("Profile Updated. Please re-login to continue");';
		echo 'window.location.href = "../logout.php?logout";';
		echo '</script>';
	} 
}

function ADD_USER_ADDRESS($user_id,$add1,$landmark,$pincode,$state,$city){

	include '../Admin_config/connection.php';

	$add_res = mysqli_query($conn,"INSERT INTO `user_address`(`user_id`,`state`,`city`,`landmark`,`pincode`,`address`) VALUES ('$user_id','$state','$city','$landmark','$pincode','$add1')");
	if($add_res){
		echo '<script type="text/javascript">alert("Address Added Successfully");';
		echo 'window.location.href = "../index.php";';
		echo '</script>';
	}
	else{
		echo '<script type="text/javascript">alert("Something went wrong. Please try again");';
		echo 'window.location.href = "../edit_profile.php";';
		echo '</script>';
	}

}

function GET_ADDRESS($id){
	include './Admin_config/connection.php';

	$sql = "SELECT * FROM user_address WHERE user_id='$id'";
	$get_address = mysqli_query($conn,$sql);
	$count= mysqli_num_rows($get_address);

	if ($count > 0) {
        while($row = mysqli_fetch_assoc($get_address))
        {
            $address[] = $row;
        }
	}
	return($address);
}


?>