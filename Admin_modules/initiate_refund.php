<?php
include '../Admin_controllers/booking.php';
session_start();


if(isset($_POST['initiate_refund'])){

    $amt = $_POST['amount'];
	$qty = $_POST['quantity'];
    $prod_id = $_POST['prod_id'];
    $order_id = $_POST['order_id'];
    $prod_name = $_POST['prod_name'];
   
    $initiate_refund = INITIATE_REFUND($amt,$qty,$prod_id,$order_id,$prod_name);
}