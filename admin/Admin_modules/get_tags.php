<?php 
include '../Admin_config/connection.php';

if (isset($_POST["tag"])) 
{
	$output = '';
	
	$sql= "SELECT `tag_name` FROM `tags_list` WHERE `tag_name` LIKE '".$_POST['tag']."%'";
	$result=mysqli_query($conn,$sql);
	$output = '<ul class="list-unstyled" style="background: #ddd;">';
	if (mysqli_num_rows($result) > 0) 
	{
		while ($row = mysqli_fetch_array($result)) 
		{
			$output .= '<li class="fetched_item" style="padding: 8px; cursor: pointer;">'.$row["tag_name"].'</li>';
		}
	}
	$output .= '</ul>';
	echo $output;
}
?>