<?php 

error_reporting(0);

function FETCH_ORDERS()
{
	include '../Admin_config/connection.php';

	$sql= "SELECT `orders`.*, `user_info`.`user_name`, `user_info`.`user_mail`, `user_info`.`user_mob` FROM `orders` LEFT JOIN `user_info` ON `orders`.`user_id` = `user_info`.`user_id`";
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


function FETCH_ORDERS_DETAILS($order_id)
{
	include '../Admin_config/connection.php';

	$sql= "SELECT `orders`.*, `user_info`.`user_name`, `user_info`.`user_mail`, `user_info`.`user_mob`, `user_info`.`state`, `user_info`.`city`, `user_info`.`pincode`, `user_info`.`landmark`, `seller_registration`.`seller_name`, `seller_registration`.`company_name`, `seller_registration`.`company_addr`, `seller_registration`.`state` AS `seller_state`, `seller_registration`.`city` AS `seller_city`, `seller_registration`.`landmark` AS `seller_landmark`, `seller_registration`.`pincode` AS `seller_pincode`, `seller_registration`.`mob_no`, `seller_registration`.`mail_id`, `product_info`.`weight`, `product_info`.`length`, `product_info`.`breadth`, `product_info`.`height`, `product_info`.`unit` FROM `orders` LEFT JOIN `user_info` ON `orders`.`user_id` = `user_info`.`user_id` LEFT JOIN `seller_registration`
		ON `orders`.`seller_Id` = `seller_registration`.`seller_Id` LEFT JOIN `product_info` ON `product_info`.`prod_id` = `orders`.`prod_id` WHERE `order_id` = '$order_id'";


	$result=mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$order = $row;
		}
	}
	return($order);
}


function UPDATE_ORDER($order_id, $refId)
{
	include '../Admin_config/connection.php';

	$result=mysqli_query($conn,"UPDATE `orders` SET `ref_id`='$refId' WHERE `order_id` = '$order_id'");

	if ($result) 
	{
		echo '<script type="text/javascript">alert("Reference ID Generated");';
		echo 'window.location.href = "../views/manage_orders.php?reference_id_generated";';
		echo '</script>';
	}
}


function UPLOAD_DOCS($order_id, $invoice, $label, $manifest)
{
	include '../Admin_config/connection.php';

	$result=mysqli_query($conn,"UPDATE `orders` SET `shipment_label`='$label',`manifest`='$manifest', `invoice`='$invoice', `status`='Generated' WHERE `order_id` = '$order_id'");

	if ($result) 
	{
		echo '<script type="text/javascript">alert("Documents Generated");';
		echo 'window.location.href = "../views/manage_orders.php?docs_generated";';
		echo '</script>';
	}
}

?>