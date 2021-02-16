<?php 
error_reporting(0);

function FETCH_SELLER_DETAILS($id)
{
	include '../Admin_config/connection.php';
	
	$sql= "SELECT * FROM `seller_registration` WHERE `seller_Id`='$id'";
	$result=mysqli_query($conn,$sql);
	$count=mysqli_num_rows($result);

	if ($count==1) {
		$seller_data=mysqli_fetch_assoc($result);
	    $res = $seller_data;

	    return($res);
	} 
}

function FETCH_PRODUCT_DETAILS($id)
{
	include '../Admin_config/connection.php';
	
	$sql= "SELECT * FROM `product_info` WHERE `prod_id`='$id'";
	$result=mysqli_query($conn,$sql);
	$count=mysqli_num_rows($result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$prod_data = $row;
		}
	}

	return ($prod_data);
}

function PRODUCT_ADD($id,$name,$description,$datetime,$file1,$file2,$file3,$file4,$file5,$stock,$rate,$company,$sellerId,$item_arr,$rate_arr,$weight,$length,$breadth,$height,$unit)
{
	include '../Admin_config/connection.php';

	$stock_sql = "INSERT INTO `product_stock`(`prod_id`, `stock`, `last_updated`) VALUES ('$id','$stock','$date_time')";
	$stock_result=mysqli_query($conn,$stock_sql);

	$prod_sql= "INSERT INTO `product_info`(`prod_id`, `prod_name`, `prod_desc`, `file1`, `file2`, `file3`, `file4`, `file5`, `prod_stock`, `prod_rate`, `sold_by`, `seller_Id`, `weight`, `length`, `breadth`, `height`, `unit`, `creation_date`) VALUES ('$id','$name','$description','$file1','$file2','$file3','$file4','$file5', '$stock', '$rate','$company', '$sellerId', '$weight', '$length', '$breadth', '$height', '$unit', '$date_time')";
	$prod_result=mysqli_query($conn,$prod_sql);

	if ($stock_result && $prod_result) 
	{
		if (count($item_arr) == count($rate_arr))
		{
			for ($i=0; $i <= count($item_arr)-1; $i++) 
			{ 
				$relation_sql= "INSERT INTO `stock_rate_relation`(`prod_i`,`prod_id`, `prod_stock`, `prod_rate`) VALUES ('$i','$id','$item_arr[$i]','$rate_arr[$i]')";
				$relation_result=mysqli_query($conn,$relation_sql);
			}

			echo '<script type="text/javascript">alert ("Product Added. Please wait for Admin approval");';
			echo 'window.location.href = "../views/add_products.php?product_added";';
			echo '</script>';

			$log_sql = "INSERT INTO `buzztro_error_log`(`component`, `description`, `date_time`) VALUES ('Product','New Product Added','$date_time')";
			$log_result=mysqli_query($conn,$log_sql);
		}
	}
	else
	{
		echo '<script type="text/javascript">alert ("Product cannot be added. Server error. Please try again");';
		echo 'window.location.href = "../views/add_products.php?error";';
		echo '</script>';
	}

}

function FETCH_PRODUCTS($name)
{
	include '../Admin_config/connection.php';

	$sql= "SELECT t1.`prod_id`,t1.`prod_name`,t1.`prod_desc`,t1.`prod_stock`, t1.`sold_by`, t2.`stock`
			FROM `product_info` t1,`product_stock` t2
			WHERE t1.`prod_id` = t2.`prod_id` AND t1.`sold_by`='$name'";

	$result=mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$prod_data[] = $row;
		}
	}
	return($prod_data);
}

function EDIT_PRODUCT($id,$name,$desc)
{
	include '../Admin_config/connection.php';

	$sql= "UPDATE `product_info`SET `prod_name`='$name', `prod_desc`='$desc' WHERE `prod_id`='$id'";
	$result=mysqli_query($conn,$sql);

	if ($result) 
	{
		$log_sql = "INSERT INTO `buzztro_error_log`(`component`, `description`, `date_time`) VALUES ('Product','Product Updated','$date_time')";
		$log_result=mysqli_query($conn,$log_sql);

		echo '<script type="text/javascript">alert ("Product updated");';
		echo 'window.location.href = "../views/restock.php";';
		echo '</script>';
	}
}

?>