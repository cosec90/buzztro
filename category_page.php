<?php 
include 'header.php';
include 'nav.php';
include 'Admin_config/connection.php';

$cat_name = $_GET['cat'];
$get_products = FETCH_PRODS_BY_CAT($cat_name);

?>

<!-- top Products -->
	<div class="ads-grid">
		<div class="container">
			<div class="dls-heading">
				<h3><?php echo $cat_name;?></h3>
			</div>
			<!-- product right -->
			<div class="agileinfo-ads-display w3l-rightpro">
				<div class="wrapper">
					<?php

					foreach ($get_products as $key => $value)
					{ 

						if ($key%4==3) 
						{ ?>
							<div class="item">
								<div class="slider-item1">
									<div class="slider-upper1">
										<img src="admin/images/all_products/<?php echo $itm_value['prod_id'].'/'.$itm_value['file1'];?>" style="width: 100%;">
									</div>
									<div class="slider-lower1">
										<div class="slider-money1">
											<?php echo '&#8377;'.$itm_value['prod_rate'];?>
										</div>
										<div class="slider-title1">
											<?php echo $itm_value['prod_name'];?>
										</div>
										<div class="slider-stock1">
											<div class="custom_progress">
												<div class="main_bar" style="width: <?php echo $percent_prog; ?>%"></div>
											</div>
										</div>
									</div>	
								</div>
							</div>
									
							<div class="col-md-3 col-xs-6 product-men">
								<div class="men-pro-item simpleCart_shelfItem">
									<div class="men-thumb-item">
										<a href="single.php?id=<?php echo $value['prod_id'];?>"><img src="admin/images/all_products/<?php echo $value['prod_id'].'/'.$value['file1'];?>" style="width: 100%;"></a>
									</div>
									<div class="item-info-product ">
										<h4>
											<a href="single.php?id=<?php echo $value['prod_id'];?>"><?php echo $value['prod_name'];?></a>
										</h4>
										<div class="info-product-price">
											<span class="item_price"><?php echo '&#8377;'.$value['prod_rate'];?></span>
										</div>
										
										<a class="btn_class_custom" href="single.php?id=<?php echo $value['prod_id'];?>">View Product</a>

									</div>
								</div>
							</div>
							<div class="clearfix"></div>
						<?php
						}
						else
						{ ?>
							<div class="col-md-3 col-xs-6 product-men">
								<div class="men-pro-item simpleCart_shelfItem">
									<div class="men-thumb-item">
										<a href="single.php?id=<?php echo $value['prod_id'];?>"><img src="admin/images/all_products/<?php echo $value['prod_id'].'/'.$value['file1'];?>" style="width: 100%;"></a>
									</div>
									<div class="item-info-product ">
										<h4>
											<a href="single.php?id=<?php echo $value['prod_id'];?>"><?php echo $value['prod_name'];?></a>
										</h4>
										<div class="info-product-price">
											<span class="item_price"><?php echo '&#8377;'.$value['prod_rate'];?></span>
										</div>
										

									</div>
								</div>
							</div>
						<?php
						}
					}
					?>

				</div>
			</div>
			<!-- //product right -->
		</div>
	</div>
	<!-- //top products -->

<?php include 'footer.php'; ?>