<?php
error_reporting(0);

function FETCH_WALLET($userid)
{
	include './Admin_config/connection.php';
	
	$fetch_wallet = mysqli_query($conn,"SELECT `wallet_balance` FROM `user_info` WHERE `user_id`='$userid'");
	$wallet_bal=mysqli_fetch_assoc($fetch_wallet);
	
    $res = $wallet_bal['wallet_balance'];
	
	return($res);
}

function FETCH_USER_WALLET($userid)
{
	include '../Admin_config/connection.php';
	
	$fetch_wallet = mysqli_query($conn,"SELECT `wallet_balance` FROM `user_info` WHERE `user_id`='$userid'");
	$wallet_bal=mysqli_fetch_assoc($fetch_wallet);
	
    $res = $wallet_bal['wallet_balance'];
	
	return($res);
}

function UPDATE_WALLET($orderId,$amt,$userId)
{
	include '../Admin_config/connection.php';

	$sql = "INSERT INTO `wallet_transactions`(`order_id`, `user_id`, `wallet_amt`, `date_time`) VALUES ('$orderId','$userId','$amt','$date_time')";
	$result = mysqli_query($conn, $sql);

	if ($result) 
	{
		$update_wallet = mysqli_query($conn, "UPDATE `user_info` SET `wallet_balance`='$amt' WHERE `user_id`='$userId'");

		if ($update_wallet)
		{
			header("Location: ../wallet.php?success");
		}
		else
		{
			header("Location: ../wallet.php?failed");
		}
	}
	
}

function UPDATE_WALLET_PAYMENT($orderId,$amt,$userId){

	include '../Admin_config/connection.php';

	$update_wallet = mysqli_query($conn, "UPDATE `user_info` SET `wallet_balance`='$amt' WHERE `user_id`='$userId'");

	return true;
	
}

function ADD_WALLET_TRANSACTION($orderId,$amt,$userId){

	include '../Admin_config/connection.php';

	
	$sql = "INSERT INTO `wallet_transactions`(`order_id`, `user_id`, `wallet_amt`, `date_time`) VALUES ('$orderId','$userId','$amt','$date_time')";
	$result = mysqli_query($conn, $sql);


}


?>