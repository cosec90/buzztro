<?php 

error_reporting(0);

function RANDOM_ARTICLES($conn,$id)
{
	$sql= "SELECT * FROM `buzztro_blogs` WHERE NOT `blog_id`='$id'";

	$result=mysqli_query($conn,$sql);
	$count=mysqli_num_rows($result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$story_data[] = $row;
		}
	}

	shuffle($story_data);
	$random_pick = array_slice($story_data,0,3);
	shuffle($random_pick);

	return($random_pick);
}

function ALL_BLOGS($conn)
{
	$sql= "SELECT * FROM `buzztro_blogs` ORDER BY `sr_Id` DESC";

	$result=mysqli_query($conn,$sql);
	$count=mysqli_num_rows($result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$story_data[] = $row;
		}
	}

	return($story_data);
}

function BLOG_FETCH($conn,$id){

	$sql= "SELECT * FROM `buzztro_blogs` WHERE `blog_id`='$id'";

	$result=mysqli_query($conn,$sql);
	$count=mysqli_num_rows($result);

	if ($count == 1) {
		while($row = mysqli_fetch_assoc($result))
		{
			$story_data = $row;
		}
	}
	return($story_data);
}


?>