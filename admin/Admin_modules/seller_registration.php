<?php 
include '../Admin_config/connection.php';
include '../Admin_controllers/seller.php';

if (isset($_POST['submit'])) 
{
	$name = ucwords($_POST['name']);
	$company = $_POST['company'];
	$company_address = $_POST['company_address'];
	$gst_no = strtoupper($_POST['gst_no']);
	$mob = $_POST['mob'];
	$alt_mob = $_POST['alt_mob'];
	$mail = $_POST['mail'];
	$state = $_POST['state'];
	$city = $_POST['city'];
	$landmark = $_POST['landmark'];
	$pincode = $_POST['pincode'];
	$pass = $_POST['pass'];
	$confirm_pass = $_POST['confirm_pass'];
	$files = $_FILES['img_files'];

	$check_pin = CHECK_PINCODE($pincode);

	if ($check_pin == "Y") 
	{
		if ($pass == $confirm_pass) 
		{

			$verify_seller = VERIFY_SELLER($mail,$mob,$gst_no);

			if ($verify_seller = "Verified") 
			{

				$file_array = reArrayFiles($files);
				$filename = array();
				//pre_r($file_array);

				$tmpPath = "../images/".$company."_".$gst_no."/documents";
				mkdir($tmpPath, 0777, true);

				for ($i=0; $i < count($file_array); $i++) 
				{ 
					if ($file_array[$i]['error']) 
					{
						echo $file_array[$i]['name']." - There was an error uploading your file";
					}
					else
					{
						$extensions = array("jpg", "jpeg", "png");
						$file_ext = explode('.', $file_array[$i]['name']);
						$file_ext = strtolower(end($file_ext));

						if (!in_array($file_ext, $extensions)) 
						{
							echo $file_array[$i]['name']." - Invalid File Extension";
						}
						else
						{
							$fileSize = $file_array[$i]['size'];
							if ($fileSize < 100000000) 
							{
								$fileNewName = uniqid('', true).".".$file_ext;
								$tempName = explode('.', $fileNewName);
								$newImgName = $tempName[0].".".end($tempName);
								
								$finalFileDestination = $tmpPath."/".$newImgName;
								move_uploaded_file($file_array[$i]['tmp_name'], $finalFileDestination);
								
								array_push($filename, $newImgName);
							}
							else
							{
								echo "Your File '<b>".$file_array[$i]['name']."</b>' exceeds the maximum size limit of 100 MB.";
							}
						}
					}
				}

				callDb($name,$company,$company_address,$gst_no,$mob,$alt_mob,$mail,$pass,$filename,$state,$city,$landmark,$pincode);
			}
			else
			{
				echo '<script type="text/javascript">alert("Something went wrong");';
				echo 'window.location.href = "../views/become_a_seller.php?error";';
				echo '</script>';
			}
		}
		else
		{
			echo '<script type="text/javascript">alert("Password did not match");';
			echo 'window.location.href = "../views/become_a_seller.php?password_error";';
			echo '</script>';
		}
	}
	elseif ($check_pin == "N") 
	{
		echo '<script type="text/javascript">alert("Pickup service not available in your location. Contact Admin");';
		echo 'window.location.href = "../views/become_a_seller.php?pickup_not_available";';
		echo '</script>';
	}
}

function callDb($name,$company,$company_address,$gst_no,$mob,$alt_mob,$mail,$pass,$filename,$state,$city,$landmark,$pincode)
{
	$datetime = date("Y-m-d H:i:s");
	$pass = md5($pass);
	
	$result = SELLER_ADD($name,$company,$company_address,$gst_no,$mob,$alt_mob,$mail,$pass,$datetime,$filename[0],$filename[1],$filename[2],$filename[3],$state,$city,$landmark,$pincode);
}

function reArrayFiles($file_post){
	
	$file_ary = array();
	$file_count = count($file_post['name']);
	$file_keys = array_keys($file_post);

	for ($i=0; $i < $file_count; $i++) 
	{ 
		foreach ($file_keys as $key) 
		{
			$file_ary[$i][$key] = $file_post[$key][$i];
		}
	}

	return $file_ary;
}

function pre_r($array){
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}
?>