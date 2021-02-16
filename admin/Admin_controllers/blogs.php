<?php 

error_reporting(0);

function BLOG_ADD($title,$desc,$url,$newImgName)
{
	include '../Admin_config/connection.php';

	$descrow="SELECT (MAX(sr_Id)) AS `last_id` FROM `buzztro_blogs`";
	$desc_res=mysqli_query($conn,$descrow);
	$row = mysqli_fetch_assoc($desc_res);
	$incId = $row['last_id'] + 1;
	$newId = "str_".$incId;
	
	$url_check=mysqli_query($conn,"SELECT * FROM `buzztro_blogs` WHERE `str_url`='$url'");
	$count_url = mysqli_num_rows($url_check);
	
	if($count_url == 0)
	{
    	$sql= "INSERT INTO `buzztro_blogs`(`blog_id`, `blog_title`, `blog_img`, `blog_url`, `blog_desc`, `datetime`) VALUES ('$newId', '$title', '$newImgName','$url','$desc', '$date_time')";
    
    	$result=mysqli_query($conn,$sql);
    
    	if ($result) 
    	{
    		echo '<script type="text/javascript">alert ("Blog added Successfully");';
    		echo 'window.location.href = "../views/add_blogs.php?blog_added";';
    		echo '</script>';
    	}
	}
	else
	{
	    echo '<script type="text/javascript">alert ("URL Already Exists");';
		echo 'window.location.href = "../views/add_blogs.php?url_exists";';
		echo '</script>';
	}
}

function BLOG_FETCH_ALL(){
	include '../Admin_config/connection.php';

	$sql= "SELECT * FROM `buzztro_blogs` ORDER BY `sr_Id` DESC";

	$result=mysqli_query($conn,$sql);
	$count=mysqli_num_rows($result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$blogs[] = $row;
		}
	}
	return($blogs);
}

function BLOG_FETCH($id){
	include '../Admin_config/connection.php';
	$sql= "SELECT * FROM `buzztro_blogs` WHERE `blog_id`='$id'";

	$result=mysqli_query($conn,$sql);
	$count=mysqli_num_rows($result);

	if ($count == 1) {
		while($row = mysqli_fetch_assoc($result))
		{
			$blog_data = $row;
		}
	}
	return($blog_data);
}

function BLOG_UPDATE($title,$desc,$url,$newImgName,$id){
	include '../Admin_config/connection.php';
	$sql= "UPDATE `buzztro_blogs` SET `blog_title` = '$title', `blog_img`='$newImgName', `blog_url`='$url', `blog_desc`='$desc' WHERE `blog_id`='$id'";

	$result=mysqli_query($conn,$sql);
	

	if ($result) 
	{
		echo '<script type="text/javascript">alert ("Blog Updated");';
		echo 'window.location.href = "../views/manage_blogs.php";';
		echo '</script>';
	}
}

?>