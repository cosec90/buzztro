<?php
include '../Admin_controllers/booking.php';
session_start();


if(isset($_POST['submit'])){

    $prod_id = $_POST['id'];
    $name = $_SESSION['user_name'];
    $user_id = $_SESSION['user_id'];
    $mobile = $_SESSION['user_mob'];
    $mail = $_SESSION['user_mail'];

    $add_watch_list = INSERT_WATCH_LIST($prod_id,$user_id,$name,$mobile,$mail);
}