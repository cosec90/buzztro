<?php
error_reporting(0);

function FETCH_LAST_CAT()
{
	include '../Admin_config/connection.php';

	$desc="SELECT (MAX(cat_id)) AS `last_id` FROM `categories_list`";
	$desc_res=mysqli_query($conn,$desc);
	$row = mysqli_fetch_assoc($desc_res);
	$temp = explode('_', $row['last_id']);
	$getId = end($temp);
	$incId = $getId + 1;
	$newId = "cat_".$incId;

	return ($newId);
}


function ADD_CATEGORY($id,$name,$file)
{
	include '../Admin_config/connection.php';
	$datetime = date("Y-m-d H:i:s");

	$sql= "INSERT INTO `categories_list`(`cat_id`, `cat_name`, `cat_img`) VALUES ('$id','$name','$file')";
	$result=mysqli_query($conn,$sql);

	$log_sql = "INSERT INTO `buzztro_error_log`(`component`, `description`, `date_time`) VALUES ('Category','New Category Added','$datetime')";
	$log_result=mysqli_query($conn,$log_sql);

	if ($result) 
	{
		echo '<script type="text/javascript">alert ("Category Added Successfully.");';
		echo 'window.location.href = "../views/category_add.php?category_added";';
		echo '</script>';
	}
}

function DEL_CATEGORY($id)
{
	include '../Admin_config/connection.php';
	$datetime = date("Y-m-d H:i:s");

	$sql= "DELETE FROM `categories_list` WHERE `cat_id`='$id'";
	$result=mysqli_query($conn,$sql);

	$log_sql = "INSERT INTO `buzztro_error_log`(`component`, `description`, `date_time`) VALUES ('Category','Category Deleted','$datetime')";
	$log_result=mysqli_query($conn,$log_sql);

	if ($result) 
	{
		echo '<script type="text/javascript">alert ("Category Deleted.");';
		echo 'window.location.href = "../views/category_add.php?category_deleted";';
		echo '</script>';
	}
}

function FETCH_ALL()
{
	include '../Admin_config/connection.php';

	$sql= "SELECT * FROM `categories_list`";
	$result=mysqli_query($conn,$sql);

	if ($result) 
	{
		$count = mysqli_num_rows($result);
		while($row = mysqli_fetch_assoc($result))
		{
			$category[] = $row;
		}
	}

	return ($category);
}

?>