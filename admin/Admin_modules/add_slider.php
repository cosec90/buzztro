<?php 
include '../Admin_config/connection.php';
include '../Admin_controllers/slider.php';

if (isset($_POST['set_slider'])) 
{
	$name = $_POST['sl_num'];
	$files = $_FILES['sl_img'];

	$fileName = $_FILES['sl_img']['name'];
	$fileType = $_FILES['sl_img']['type'];
	$fileTmpName = $_FILES['sl_img']['tmp_name'];
	$fileError = $_FILES['sl_img']['error'];
	$fileSize = $_FILES['sl_img']['size'];

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
				$fileDestination = "../images/website_config/slider_items/".$newImgName;
				move_uploaded_file($fileTmpName, $fileDestination);
				
				$result = SLIDER_ADD($name,$newImgName);
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

?>