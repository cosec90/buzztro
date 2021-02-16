<?php 
error_reporting(0);

function FETCH_SELLER_ENQUIRY()
{
	include '../Admin_config/connection.php';

	$sql= "SELECT * FROM `seller_enquiry` WHERE `query_status` = 'Unsolved'";
	$result=mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$query_data[] = $row;
		}
	}
	return($query_data);
}

function FETCH_USER_ENQUIRY()
{
	include '../Admin_config/connection.php';

	$sql= "SELECT * FROM `user_enquiry` WHERE `query_status` = 'Unsolved'";
	$result=mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$query_data[] = $row;
		}
	}
	return($query_data);
}

function CLOSE_QUERY($code, $type)
{
	include '../Admin_config/connection.php';

	if ($type == "user") 
	{
		$result=mysqli_query($conn,"UPDATE `user_enquiry` SET `query_status` = 'Solved' WHERE `query_no`='$code'");

		if ($result) 
		{
			echo '<script type="text/javascript">alert ("Query Closed.");';
			echo 'window.location.href = "../views/user_enquiries.php?query_closed";';
			echo '</script>';
		}
	}
	elseif ($type == "seller") 
	{
		$result=mysqli_query($conn,"UPDATE `seller_enquiry` SET `query_status` = 'Solved' WHERE `query_no`='$code'");

		if ($result) 
		{
			echo '<script type="text/javascript">alert ("Query Closed.");';
			echo 'window.location.href = "../views/enquiries.php?query_closed";';
			echo '</script>';
		}
	}
}

?>