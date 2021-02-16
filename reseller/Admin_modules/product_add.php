<?php 
include '../Admin_config/connection.php';
include '../Admin_controllers/product.php';

if (isset($_POST['submit'])) 
{
	
	if (count($_FILES['prod_img']['name']) <= 5 && count($_FILES['prod_img']['name']) >= 1) 
	{

		$id = $_POST['id'];
		$prod_id = $_POST['prod_id'];
		$name = $_POST['prod_name'];
		$description = str_replace("'","\'",nl2br($_POST['prod_desc']));
		$files = $_FILES['prod_img'];
		$prod_stock = $_POST['prod_stock'];
		$prod_rate = $_POST['prod_rate'];

		$weight = $_POST['prod_weight'];
		$length = $_POST['prod_length'];
		$breadth = $_POST['prod_breadth'];
		$height = $_POST['prod_height'];
		$unit = $_POST['prod_unit'];

		$item_arr = $_POST['item_arr'];
		$rate_arr = $_POST['rate_arr'];

		$item_arr = explode(',', $item_arr);
		$rate_arr = explode(',', $rate_arr);

		$get_seller_details = FETCH_SELLER_DETAILS($id);

		if ($get_seller_details) 
		{
			$seller_dir = $get_seller_details['company_name']."_".$get_seller_details['gst_no'];

			$file_array = reArrayFiles($files);
			$filename = array();

			$tmpPath = "../../admin/images/".$seller_dir."/products/".$prod_id;
			$main_dir = '../../admin/images/all_products/'.$prod_id;

			mkdir($tmpPath, 0777, true);	
			mkdir($main_dir, 0777, true);	

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
							$allProdsDestination = $main_dir."/".$newImgName;

							
							if(move_uploaded_file($file_array[$i]['tmp_name'], $finalFileDestination))
							{
								copy($finalFileDestination, $allProdsDestination);
							}
							

							array_push($filename, $newImgName);
						}
						else
						{
							echo "Your File '<b>".$file_array[$i]['name']."</b>' exceeds the maximum size limit of 100 MB.";
						}
					}
				}
			}

			$result = PRODUCT_ADD($prod_id,$name,$description,$datetime,$filename[0],$filename[1],$filename[2],$filename[3],$filename[4],$prod_stock,$prod_rate,$get_seller_details['company_name'],$id,$item_arr,$rate_arr,$weight,$length,$breadth,$height,$unit);
	
		}
		else
		{
			echo '<script type="text/javascript">alert("Seller Not Found");';
			echo 'window.location.href = "../views/add_products.php?seller_error";';
			echo '</script>';
		}
	}
	else
	{
		echo '<script type="text/javascript">alert("You can only upload 5 images");';
		echo 'window.location.href = "../views/add_products.php?file_limit";';
		echo '</script>';
	}

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