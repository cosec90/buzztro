<?php 

error_reporting(0);

function FETCH_ORDERS($seller_id)
{
	include '../Admin_config/connection.php';

	$sql= "SELECT `orders`.*, `user_info`.`user_name`, `user_info`.`user_mail`, `user_info`.`user_mob` FROM `orders` LEFT JOIN `user_info` ON `orders`.`user_id` = `user_info`.`user_id` WHERE `orders`.`shipment_label` IS NOT NULL AND `orders`.`manifest` IS NOT NULL AND `orders`.`invoice` IS NOT NULL AND `orders`.`seller_Id` = '$seller_id'";
	$result=mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$orders[] = $row;
		}
	}
	return($orders);
}

?>