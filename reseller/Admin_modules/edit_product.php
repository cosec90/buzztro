<?php 
include '../Admin_config/connection.php';
include '../Admin_controllers/product.php';

session_start();

if(isset($_POST['submit'])){

$id = $_POST['prod_id'];
$name = $_POST['prod_name'];
$desc = str_replace("'","\'",nl2br($_POST['prod_desc']));

$res = EDIT_PRODUCT($id,$name,$desc);

}

?>