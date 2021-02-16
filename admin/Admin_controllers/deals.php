<?php 
error_reporting(0);

function INSERT_DEALS($sel)
{
	include '../Admin_config/connection.php';

	$sql= "INSERT INTO `deals_items`(`sr_Id`, `deals1`, `deals2`, `deals3`, `deals4`, `deals5`, `deals6`, `deals7`, `deals8`) VALUES ('$sel[0]','$sel[1]','$sel[2]','$sel[3]','$sel[4]','$sel[5]','$sel[6]','$sel[7]')";
	$result=mysqli_query($conn,$sql);

	if ($result) 
	{
		echo '<script type="text/javascript">alert("Deals of the day items added");';
		echo 'window.location.href = "../views/deals.php";';
		echo '</script>';
	}
}

?>