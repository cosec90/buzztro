<?php

include '../Admin_config/connection.php';

$id = $_POST['state_id'];

$sql ="SELECT * FROM cities WHERE state_id = '$id' ";
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);
while ($count > 0) {
    $row = mysqli_fetch_assoc($result);
    $data[] = $row['name'];
    $count--;
}
$encode_data = json_encode($data);
echo $encode_data;
// print_r($data);



?>