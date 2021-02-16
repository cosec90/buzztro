<?php 
include '../Admin_config/connection.php';
include '../Admin_controllers/products.php';

session_start();

$fetch_products = FETCH_PRODUCTS();

$view_products = VIEW_PODUCTS();

$id = $_SESSION['products'];

$fetch_rate = array();

foreach ($id as $key => $value) 
{
	array_push($fetch_rate,FETCH_RATE($value));
}

?>