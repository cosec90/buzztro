<?php 
include '../Admin_config/connection.php';
include '../Admin_controllers/seller.php';

$fetch_sellers = FETCH_SELLERS();

$view_sellers = VIEW_SELLERS();

foreach ($view_sellers as $key => $value) 
{
	$user = $value['mail_id'];
    $res = LAST_LOGIN($user);
    array_push($view_sellers[$key], $res);
}



?>