<?php 
include 'Admin_config/connection.php';
include 'header.php';
include 'nav.php';
$all_prods = ALL_PRODS();

function ALL_PRODS()
{
	include './Admin_config/connection.php';

	$sql= "SELECT `product_info`.*, `product_stock`.`stock` 
		   FROM `product_info` 
		   LEFT JOIN `product_stock` 
		   ON `product_info`.`prod_id` =`product_stock`.`prod_id`
		   AND `product_info`.`prod_status` = 'Approved'";

	$result=mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$prods[] = $row;
		}
	}

	return($prods);
}

function FETCH_RATE_STOCK($id)
{
	include './Admin_config/connection.php';

	$sql= "SELECT * FROM `stock_rate_relation` WHERE `prod_id` = '$id'";
	$result=mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$prods[] = $row;
		}
	}

	return($prods);
}

function FETCH_ACTUAL_RATE($id,$stock)
{
	include './Admin_config/connection.php';

	$sql= "SELECT * FROM `stock_rate_relation` 
	WHERE `prod_id`='$id' 
	AND `prod_stock` <= '$stock' 
	ORDER BY `prod_stock` 
	DESC 
	LIMIT 1";
	$result=mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);

	if ($count > 0) {
		while($row = mysqli_fetch_assoc($result))
		{
			$prods = $row;
		}
	}

	return($prods);
}


function pre_r($array)
{
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}

?>

<div class="super_container">

 <!-- Jumbotron -->
	<section class="fd">
		<div class="container">
			
			<div class="row">
				<div class="col-md-12">
					<div class="deal-inner">
						
						<div class="lower">
							<div class="lower-slider" style="display: flex;">
								<div class="owl-carousel">
									<?php
									
									foreach ($all_prods as $key => $value) 
									{ 
									$fetch_rate_stock = FETCH_RATE_STOCK($value['prod_id']);
									?>
								
									<a href="product.php?id=<?php echo $value['prod_id'];?>">
										<div class="item">
											<div class="slider-item">
												<div class="slider-image">
													<img src="admin/images/all_products/<?php echo $value['prod_id'].'/'.$value['file1'];?>" style="width: 100%;">
												</div>
												
												<div class="slider-title">
													<?php echo $value['prod_name'];?>
												</div>

												<div class="slider-stock">
													<?php
													$act_stock = $value['prod_stock'] - $value['stock'];
													?>
													<progress value="<?php echo $act_stock;?>" max="<?php echo $value['prod_stock'];?>" class="stock_bar"></progress>
													<table border="1" class="stock_rate_tb">
														<!-- <tr>
															<?php
															foreach ($fetch_rate_stock as $key => $rate_value) 
															{ 
															//$fetch_rate = FETCH_RATE($rate_value['prod_id']);
															?>
																<th><?php echo $rate_value['prod_stock'];?></th>
															<?php
															}
															?>
														</tr> -->
														<tr>
															<?php
															foreach ($fetch_rate_stock as $key => $rate_value) 
															{ 
															//$fetch_rate = FETCH_RATE($rate_value['prod_id']);
															?>
																<td><?php echo '&#8377;'.$rate_value['admin_rate'];?></td>
															<?php
															}
															?>
														</tr>
													</table>
												</div>
												<br>
												<div class="prod_money">
													<?php
													$adm_rate_fetch = FETCH_ACTUAL_RATE($value['prod_id'],$act_stock);
													
													?>
													Current Rate: <?php echo '&#8377;'.$adm_rate_fetch['admin_rate'];?>
												</div>	
											</div>
										</div>
									</a>

									<?php
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</section>
	<!--end jumbotron-->
	
	

			
		<!--end featured products-->

	<?php include 'footer.php';?>