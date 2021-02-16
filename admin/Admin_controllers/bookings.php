<?php 

error_reporting(0);

function FETCH_BOOKINGS()
{
	include '../Admin_config/connection.php';

	$sql= "SELECT `bookings`.*, `user_info`.`user_name`, `user_info`.`user_mail`, `user_info`.`user_mob` FROM `bookings` LEFT JOIN `user_info` ON `bookings`.`user_id` = `user_info`.`user_id`";
	$result=mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$bookings[] = $row;
		}
	}
	return($bookings);
}


function CONFIRM_REFUND($order_id, $amt, $userId){

    include '../Admin_config/connection.php';

    $sql = "UPDATE `user_info` SET `wallet_balance` = `wallet_balance` + '$amt' WHERE `user_id`='$userId'";
    $result = mysqli_query($conn,$sql);

    if($result){

    	$booking_update = mysqli_query($conn,"DELETE FROM `bookings` WHERE `order_id`='$order_id'");

    	if ($booking_update)
    	{
    		echo '<script type="text/javascript">alert ("Refund added");';
        	echo 'window.location.href = "../views/manage_bookings.php";';
        	echo '</script>';
    	}
    }

}

?>