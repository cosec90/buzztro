<?php
error_reporting(0);

function FETCH_SLIDER()
{
	include './Admin_config/connection.php';

	$sql= "SELECT `sl_img` FROM `slider_items` WHERE `sl_img` IS NOT NULL AND TRIM(sl_img) <> ''";
	$result=mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$slider_data[] = $row;
		}
	}
	return($slider_data);
}
?>