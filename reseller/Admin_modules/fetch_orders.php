<?php 
include '../Admin_config/connection.php';
include '../Admin_controllers/orders.php';

$seller_id = $_SESSION['seller_Id'];

$fetch_orders = FETCH_ORDERS($seller_id);

?>