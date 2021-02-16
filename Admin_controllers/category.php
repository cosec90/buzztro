<?php
error_reporting(0);

function CATEGORY_FETCH()
{
	include './Admin_config/connection.php';

	$sql= "SELECT * FROM `categories_list`";
	$result=mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$fetched[] = $row;
		}
	}

	return($fetched);
}


function FETCH_PRODS_BY_CAT($cat_name)
{
	include './Admin_config/connection.php';

	$sql= "SELECT * FROM `product_info` WHERE `prod_category`='$cat_name' AND `prod_status`='Approved'";
	$result=mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$fetched[] = $row;
		}
	}

	return($fetched);
}
?>