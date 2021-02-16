<?php
include '../Admin_config/connection.php';
include '../Admin_controllers/deals.php';

if (isset($_POST['submit'])) 
{
	$sel = $_POST['deals_sel'];

	if (count($sel) == 8) 
	{
		$res = INSERT_DEALS($sel);
	}
	else
	{
		echo '<script type="text/javascript">alert("Please select 8 items");';
		echo 'window.location.href = "../views/deals.php?limit_error";';
		echo '</script>';
	}
}

?>