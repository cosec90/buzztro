<?php
error_reporting(0);

function ADD_NEWSLETTER($email)
{
	include '../Admin_config/connection.php';

	$sql= "INSERT INTO `buzztro_newsletter`(`mail`) VALUES ('$email')";
	$result=mysqli_query($conn,$sql);

	if ($result) 
	{
		echo '<script type="text/javascript">alert ("Subscribed for Newsletter");';
		echo 'window.location.href = "../index.php?subscribed";';
		echo '</script>';
	}
}

?>