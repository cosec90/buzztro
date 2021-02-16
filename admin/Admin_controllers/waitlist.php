<?php
error_reporting(0);

function FETCH_WAITLIST()
{
	include '../Admin_config/connection.php';

	$result=mysqli_query($conn,"SELECT `watch_list`.*, `product_info`.`prod_name`, COUNT(`watch_list`.`prod_id`) AS `total` FROM `watch_list` LEFT JOIN `product_info` ON `watch_list`.`prod_id` = `product_info`.`prod_id` GROUP BY `watch_list`.`prod_id` DESC");

	$count = mysqli_num_rows($result);

	if ($count > 0) 
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$waitlist[] = $row;
		}
	}

	return ($waitlist);
}

function FETCH_ALL_WAITLIST($id)
{
	include '../Admin_config/connection.php';

	$result=mysqli_query($conn,"SELECT * FROM `watch_list` WHERE `prod_id` = '$id'");

	$count = mysqli_num_rows($result);

	if ($count > 0) 
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$waitlist[] = $row;
		}
	}

	return ($waitlist);
}

?>