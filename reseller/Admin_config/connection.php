<?php  
date_default_timezone_set("Asia/Kolkata");

$host ="localhost";
$user ="root";
$pass="";
$db ="buzztro_db";

// $host ="localhost";
// $user ="buzzt869_admin";
// $pass="Buzztroadmin";
// $db ="buzzt869_buzztro_db";

$conn = mysqli_connect($host,$user,$pass,$db);
mysqli_set_charset($conn,"utf8");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$date_time = date("Y-m-d H:i:s");
?>