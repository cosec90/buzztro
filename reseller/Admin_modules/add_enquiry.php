<?php 
include '../Admin_config/connection.php';
include '../Admin_controllers/enquiry.php';

session_start();

if(isset($_POST['submit'])){

$id = $_SESSION['seller_Id'];
$name = FETCH_SELLER_DETAILS($id);
$msg = str_replace("'","\'",nl2br($_POST['enquiry']));

$res = ADD_ENQUIRY($id,$name,$msg);

}

?>