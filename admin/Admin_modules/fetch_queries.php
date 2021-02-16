<?php 
include '../Admin_config/connection.php';
include '../Admin_controllers/enquiries.php';

session_start();

$fetch_seller_enquiries = FETCH_SELLER_ENQUIRY();

$fetch_user_enquiries = FETCH_USER_ENQUIRY();

if (isset($_POST['close_query'])) 
{
	$code = $_GET['code'];
	$type = $_GET['type'];

	$res = CLOSE_QUERY($code, $type);
}

?>