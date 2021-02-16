<?php
include '../Admin_config/connection.php';
include '../Admin_controllers/slider.php';

if (isset($_POST['rem_slider'])) 
{
	$sl_id = $_POST['sl_num'];
	$res = DELETE_SLIDER($sl_id);
}

?>