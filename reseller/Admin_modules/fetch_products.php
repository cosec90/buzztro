<?php 
include '../Admin_config/connection.php';
include '../Admin_controllers/product.php';

session_start();

$id = $_SESSION['seller_Id'];

$get_details = FETCH_SELLER_DETAILS($id);

$name = $get_details['company_name'];

$fetch_products = FETCH_PRODUCTS($name);

?>