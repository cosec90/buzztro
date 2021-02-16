<?php 
include '../Admin_config/connection.php';
include '../Admin_controllers/bookings.php';


$id = $_GET['id'];
$amt = $_GET['amt'];
$user = $_GET['user'];

$confirm_ref = CONFIRM_REFUND($id, $amt, $user);

?>