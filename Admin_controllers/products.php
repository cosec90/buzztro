<?php
error_reporting(0);

function FEATURED_PRODUCTS()
{
	include './Admin_config/connection.php';

	$fetch_feature_arr=mysqli_query($conn,"SELECT `feature1`,`feature2`,`feature3`,`feature4` FROM `featured_items` ORDER BY `sr_Id` DESC");
	$fetch_arr = mysqli_fetch_assoc($fetch_feature_arr);

	$featured_prod = array();

	foreach ($fetch_arr as $key => $value) 
	{
		$sql= "SELECT * FROM `product_info` WHERE `prod_status` = 'Approved' AND `prod_id` = '$value'";
		$result=mysqli_query($conn,$sql);
		$row = mysqli_fetch_assoc($result);

		$featured_prod[] = $row;
	}

	shuffle($featured_prod);

	return($featured_prod);
}

function PRODUCT_PAGE_INFO($id)
{
	include './Admin_config/connection.php';

	$sql= "SELECT `product_info`.`prod_id`, `product_info`.`seller_Id`, `product_info`.`prod_name`,`product_info`.`prod_desc`, `product_info`.`prod_stock` AS `total_stock`, `product_info`.`prod_timer`, `product_info`.`file1`,`product_info`.`file2`, `product_info`.`file3`, `product_info`.`file4`, `product_info`.`file5`, `product_info`.`booking_amt`, `product_info`.`prod_category`,`product_info`.`prod_tags`, `product_stock`.`stock` AS `stock`, `product_stock`.`sold` AS `sold`,`stock_rate_relation`.`admin_rate` FROM `product_info` LEFT JOIN `product_stock` ON `product_info`.`prod_id`=`product_stock`.`prod_id` LEFT JOIN `stock_rate_relation` ON `product_info`.`prod_id` = `stock_rate_relation`.`prod_id` WHERE `product_info`.`prod_status` = 'Approved' AND `product_info`.`prod_id`='$id' AND `stock_rate_relation`.`prod_stock` <=  `product_stock`.`sold` ORDER BY `stock_rate_relation`.`admin_rate` ASC LIMIT 1";


	$result=mysqli_query($conn,$sql);

	$stock_rate_res = mysqli_query($conn,"SELECT `admin_rate`,`prod_stock` FROM `stock_rate_relation` WHERE `prod_id` = '$id'");

	if ($result) 
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$featured_prod = $row;
		}

		while ($stock_row = mysqli_fetch_assoc($stock_rate_res)) 
		{
			$featured_prod['price'][] = $stock_row['admin_rate'];
			$featured_prod['stock_div'][] = $stock_row['prod_stock'];
		}
	}

	return($featured_prod);
}

function FETCH_CARDS()
{
	include './Admin_config/connection.php';

	$sql= "SELECT `cat_name`,`cat_img` FROM `categories_list`";
	$result=mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);


	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$cards[] = $row;
		}
	}

	shuffle($cards);
	$random_pick = array_slice($cards,0,4);
	shuffle($random_pick);

	return($random_pick);
}

function FETCH_ITEMS($category)
{
	include './Admin_config/connection.php';

	$curr_date = date('Y-m-d');

	// $sql= "SELECT `prod_id`, `prod_name`, `prod_desc`, `file1`, `prod_stock`, `prod_rate`, `prod_tags`, `sold_by` FROM `product_info` WHERE `prod_category` = '$category' AND `prod_status` = 'Approved' AND `prod_timer` >= '$curr_date'";

	$sql= "SELECT `product_info`.`prod_id`, `product_info`.`seller_Id`, `product_info`.`prod_name`,`product_info`.`prod_rate`,`product_info`.`prod_desc`, `product_info`.`prod_stock` AS `total_stock`, `product_info`.`prod_timer`, `product_info`.`sold_by`, `product_info`.`file1`,`product_info`.`file2`, `product_info`.`file3`, `product_info`.`file4`, `product_info`.`file5`, `product_info`.`booking_amt`, `product_info`.`prod_category`,`product_info`.`prod_tags`, `product_stock`.`stock` AS `stock`, `product_stock`.`sold` AS `sold`,`stock_rate_relation`.`admin_rate` FROM `product_info` LEFT JOIN `product_stock` ON `product_info`.`prod_id`=`product_stock`.`prod_id` LEFT JOIN `stock_rate_relation` ON `product_info`.`prod_id` = `stock_rate_relation`.`prod_id` WHERE `product_info`.`prod_status` = 'Approved' AND `product_info`.`prod_category`='$category' AND `product_info`.`prod_timer` >= '$curr_date' ORDER BY `stock_rate_relation`.`admin_rate` ASC LIMIT 1";

	$result=mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$fetched[] = $row;
		}
	}

	shuffle($fetched);
	return($fetched);
}

function SEARCH_PRODUCT($key)
{
	include './Admin_config/connection.php';

	$curr_date = date('Y-m-d');

	$sql= "SELECT `product_info`.`prod_id`, `product_info`.`seller_Id`, `product_info`.`prod_name`,`product_info`.`prod_rate`,`product_info`.`prod_desc`, `product_info`.`prod_stock` AS `total_stock`, `product_info`.`prod_timer`, `product_info`.`sold_by`, `product_info`.`file1`,`product_info`.`file2`, `product_info`.`file3`, `product_info`.`file4`, `product_info`.`file5`, `product_info`.`booking_amt`, `product_info`.`prod_category`,`product_info`.`prod_tags`, `product_stock`.`stock` AS `stock`, `product_stock`.`sold` AS `sold`,`stock_rate_relation`.`admin_rate` FROM `product_info` LEFT JOIN `product_stock` ON `product_info`.`prod_id`=`product_stock`.`prod_id` LEFT JOIN `stock_rate_relation` ON `product_info`.`prod_id` = `stock_rate_relation`.`prod_id` WHERE `product_info`.`prod_status` = 'Approved' AND `product_info`.`prod_name` LIKE '%$key%' AND `product_info`.`prod_timer` >= '$curr_date' ORDER BY `stock_rate_relation`.`admin_rate` ASC LIMIT 1";

	$result=mysqli_query($conn,$sql);

	$count = mysqli_num_rows($result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$fetched[] = $row;
		}
	}
	//print_r($fetched);
	return($fetched);
}
?>