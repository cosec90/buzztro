<?php 
error_reporting(0);

function INSERT_FEATURED($sel)
{
	include '../Admin_config/connection.php';

	$sql= "INSERT INTO `featured_items`(`feature1`, `feature2`, `feature3`, `feature4`) VALUES ('$sel[0]','$sel[1]','$sel[2]','$sel[3]')";
	$result=mysqli_query($conn,$sql);

	if ($result) 
	{
		echo '<script type="text/javascript">alert("Featured items added");';
		echo 'window.location.href = "../views/featured.php";';
		echo '</script>';
	}
}

?>