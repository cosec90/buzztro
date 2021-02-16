<?php 
error_reporting(0);

function FETCH_PRODUCTS()
{
	include '../Admin_config/connection.php';

	$sql= "SELECT * FROM `product_info` WHERE `prod_status` = 'Not Approved'";
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

function FETCH_RATE($prod_id)
{
	include '../Admin_config/connection.php';

	$sql= "SELECT `prod_id`,`prod_stock`,`prod_rate`,`admin_rate` FROM `stock_rate_relation` WHERE `prod_id` = '$prod_id'";
	$result=mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$prod_rate[] = $row;
		}
	}
	return($prod_rate);
}

function GET_DETAILS($seller_company)
{
	include '../Admin_config/connection.php';

	$sql= "SELECT `mail_id`,`gst_no` FROM `seller_registration` WHERE `company_name` = '$seller_company'";
	$result=mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$company[] = $row;
		}
	}
	return($company);
}

function TAGS_LIST()
{
	include '../Admin_config/connection.php';

	$tag_sql = "SELECT `tag_name` FROM `tags_list`";
	$tag_result = mysqli_query($conn,$tag_sql);
	$count = mysqli_num_rows($tag_result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($tag_result))
		{
			$tags_res[] = $row['tag_name'];
		}
	}

	return $tags_res;
}

function APPROVE_PRODUCT($id,$name,$desc,$tags,$category,$rate,$timer,$booking_amt)
{
	include '../Admin_config/connection.php';

	$tags_final = explode(',',$tags);

	$tags_res = TAGS_LIST();
	
	foreach ($tags_final as $key => $value) 
	{
		if (!in_array($value, $tags_res))
		{
			$insert_result = mysqli_query($conn,"INSERT INTO `tags_list` (`tag_name`) VALUES ('$value') ON DUPLICATE KEY UPDATE `tag_count` = `tag_count` + 1");
		}
	}

	$adm_rate = explode(',', $rate);

	for ($i=0; $i <= count($adm_rate)-1; $i++) 
	{ 
		$relation_sql= "UPDATE `stock_rate_relation` SET `admin_rate`='$adm_rate[$i]' WHERE `prod_id`='$id' AND `prod_i`='$i'";
		$relation_result=mysqli_query($conn,$relation_sql);
	}

	if($relation_result)
	{
		$sql= "UPDATE `product_info` SET `prod_status` = 'Approved',`prod_name`='$name',`prod_desc`='$desc', `prod_timer`='$timer', `prod_category`='$category',`prod_tags`='$tags',`booking_amt`='$booking_amt' WHERE `prod_id` = '$id'";
		$result=mysqli_query($conn,$sql);
		
		if ($result) 
		{
			$log_sql = "INSERT INTO `buzztro_error_log`(`component`, `description`, `date_time`) VALUES ('Product','Product Approved','$date_time')";
			$log_result=mysqli_query($conn,$log_sql);

			echo '<script type="text/javascript">alert ("Product Approved.");';
			echo 'window.location.href = "../views/validate_products.php?product_approved";';
			echo '</script>';
		}
	}
}

function REJECT_PRODUCT($id)
{
	include '../Admin_config/connection.php';

	$sql= "DELETE FROM `product_info` WHERE `prod_id` = '$id'";
	$result=mysqli_query($conn,$sql);

	if ($result) 
	{
		$stock_sql= "DELETE FROM `product_stock` WHERE `prod_id` = '$id'";
		$stock_result=mysqli_query($conn,$stock_sql);

		if ($stock_result) 
		{
			$relation_sql= "DELETE FROM `stock_rate_relation` WHERE `prod_id` = '$id'";
			$relation_result=mysqli_query($conn,$relation_sql);

			if ($relation_result) 
			{
				$log_sql = "INSERT INTO `buzztro_error_log`(`component`, `description`, `date_time`) VALUES ('Product','Product Rejected','$datetime')";
				$log_result=mysqli_query($conn,$log_sql);

				echo '<script type="text/javascript">alert ("Product Rejected.");';
				echo 'window.location.href = "../views/validate_products.php?product_rejected";';
				echo '</script>';			
			}
		}
	}
}

function VIEW_PODUCTS()
{
	include '../Admin_config/connection.php';

	$sql= "SELECT * FROM `product_info` WHERE `prod_status` = 'Approved'";
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

function EDIT_RATE($id,$rates)
{
	include '../Admin_config/connection.php';

	$adm_rate = explode(',', $rates);
	
	for ($i=0; $i <= count($adm_rate)-1; $i++) 
	{ 
		$relation_sql= "UPDATE `stock_rate_relation` SET `admin_rate`='$adm_rate[$i]' WHERE `prod_id`='$id' AND `prod_i`='$i'";
		$relation_result=mysqli_query($conn,$relation_sql);

		if($i == count($adm_rate)-1)
		{
			echo '<script type="text/javascript">alert ("Pricing Updated.");';
			echo 'window.location.href = "../views/single_prod.php?id='.$id.'";';
			echo '</script>';
		}
	}
}

function FETCH_PRODUCTS_BY_ID($id)
{
	include '../Admin_config/connection.php';

	$sql= "SELECT * FROM `product_info` WHERE `prod_id` = '$id'";
	$result=mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$prod_data = $row;
		}
	}
	return($prod_data);
}

function UPDATE_PRODUCT($id,$name,$desc,$timer)
{
	include '../Admin_config/connection.php';

	$sql= "UPDATE `product_info` SET `prod_name`='$name',`prod_desc`='$desc', `prod_timer`='$timer' WHERE `prod_id` = '$id'";
	$result=mysqli_query($conn,$sql);
	
	if ($result) 
	{
		$log_sql = "INSERT INTO `buzztro_error_log`(`component`, `description`, `date_time`) VALUES ('Product','Product Updated','$date_time')";
		$log_result=mysqli_query($conn,$log_sql);

		echo '<script type="text/javascript">alert ("Product Updated.");';
		echo 'window.location.href = "../views/manage_products.php?product_updated";';
		echo '</script>';
	}
	
}

// function DISABLE_ENABLE($id);

?>