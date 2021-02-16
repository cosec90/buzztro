<?php 
include '../Admin_config/connection.php';
include '../Admin_controllers/blogs.php';

if(isset($_POST['submit'])){

	$title = str_replace("&nbsp;", " ", str_replace("'","\'",nl2br($_POST['bl_title'])));
	$desc = str_replace("&nbsp;", " ", str_replace("'","\'",nl2br($_POST['bl_desc'])));
	$file = $_FILES['bl_img'];
	$url = $_POST['bl_url'];

	$fileName = $_FILES['bl_img']['name'];
	$fileType = $_FILES['bl_img']['type'];
	$fileTmpName = $_FILES['bl_img']['tmp_name'];
	$fileError = $_FILES['bl_img']['error'];
	$fileSize = $_FILES['bl_img']['size'];

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

	$allowed  = array("jpg", "jpeg", "png");

	if (in_array($fileActualExt, $allowed)) 
	{
		if ($fileError === 0) 
		{
			if ($fileSize < 1000000) 
			{

				$fileNewName = uniqid('', true).".".$fileActualExt;
				$tempName = explode('.', $fileNewName);
				$newImgName = $tempName[0].".".end($tempName);
				$fileDestination = "../images/blog_images/".$newImgName;
				move_uploaded_file($fileTmpName, $fileDestination);
				
				$result = BLOG_ADD($title,$desc,$url,$newImgName);

			}else{
				echo "Your File is too big";
			}
		}else{
			echo "There was an error uploading your file";
		}
	}else{
		echo "Invalid File Type";
	}
}

?>