<?php
include '../Admin_config/connection.php';
include '../Admin_controllers/featured.php';

if (isset($_POST['submit'])) 
{
	$sel = $_POST['feature_sel'];

	if (count($sel) == 4) 
	{
		$res = INSERT_FEATURED($sel);
	}
	else
	{
		echo '<script type="text/javascript">alert("Please select 4 items");';
		echo 'window.location.href = "../views/featured.php?limit_error";';
		echo '</script>';
	}
}

?>