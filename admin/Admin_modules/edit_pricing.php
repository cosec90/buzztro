<?php 
include '../Admin_config/connection.php';
include '../Admin_controllers/products.php';

if (isset($_POST['conf_price'])) 
{
	$id = $_POST['prod_id'];
	$rates = $_POST['new_ad_rates'];

	$edit_rate = EDIT_RATE($id,$rates);
}

?>