<?php 
error_reporting(0);

function SLIDER_ADD($name,$img)
{
	include '../Admin_config/connection.php';

	$sql= "UPDATE `slider_items` SET `sl_img`='$img' WHERE `sl_id`='$name'";
	$result=mysqli_query($conn,$sql);

	$log_sql = "INSERT INTO `buzztro_error_log`(`component`, `description`, `date_time`) VALUES ('Slider Item','Slider Image Changed','$datetime')";
	$log_result=mysqli_query($conn,$log_sql);

	if ($result) 
	{
		echo '<script type="text/javascript">alert ("Slider Item Changed Successfully.");';
		echo 'window.location.href = "../views/slider_items.php?slider_added";';
		echo '</script>';
	}
}

function FETCH_SLIDER()
{
	include '../Admin_config/connection.php';

	$sql= "SELECT * FROM `slider_items` ORDER BY `sl_id` ASC";
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

function DELETE_SLIDER($sl_id)
{
	include '../Admin_config/connection.php';

	$sql= "UPDATE `slider_items` SET `sl_img`='' WHERE `sl_id`='$sl_id'";
	$result=mysqli_query($conn,$sql);

	if ($result) 
	{
		$log_sql = "INSERT INTO `buzztro_error_log`(`component`, `description`, `date_time`) VALUES ('Slider Item','Slider Image Deleted','$datetime')";
		$log_result=mysqli_query($conn,$log_sql);

		echo '<script type="text/javascript">alert ("Slider Item Deleted Successfully.");';
		echo 'window.location.href = "../views/slider_items.php?slider_deleted";';
		echo '</script>';
	}
}
?>