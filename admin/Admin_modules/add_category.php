<?php 
include '../Admin_config/connection.php';
include '../Admin_controllers/category.php';

if (isset($_POST['submit'])) 
{
	$id = $_POST['cat_id'];
	$name = $_POST['cat_name'];
	$file = $_FILES['cat_img'];

	$fileName = $_FILES['cat_img']['name'];
	$fileType = $_FILES['cat_img']['type'];
	$fileTmpName = $_FILES['cat_img']['tmp_name'];
	$fileError = $_FILES['cat_img']['error'];
	$fileSize = $_FILES['cat_img']['size'];

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

	$allowed  = array("jpg", "jpeg", "png");


	if (in_array($fileActualExt, $allowed)) 
	{
		if ($fileError === 0) 
		{
			if ($fileSize < 100000000) 
			{
				$fileNewName = uniqid('', true).".".$fileActualExt;
				$tempName = explode('.', $fileNewName);
				$newImgName = $tempName[0].".".end($tempName);
				$fileDestination = "../images/website_config/categorized_cards/".$newImgName;
				move_uploaded_file($fileTmpName, $fileDestination);
				
				$add_cat = ADD_CATEGORY($id,$name,$newImgName);
			}
			else
			{
				echo "Your File is too big";
			}
		}
		else
		{
			echo "There was an error uploading your file";
		}
	}
	else
	{
		echo "Invalid File Type";
	}
}

if (isset($_POST['delete'])) 
{
	$id = $_GET['id'];

	$del_cat = DEL_CATEGORY($id);
}

?>