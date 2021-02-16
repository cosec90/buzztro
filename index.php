<?php 
include 'Admin_config/connection.php';
include 'header.php';

include 'Admin_controllers/slider.php';
include 'Admin_controllers/products.php';

if(!isset($_COOKIE["modalShow"])) 
{ 
	setcookie("modalShow", "yes", time() + (86400 * 5), "/");
	?>

    <script>
		$(document).ready(function() {
			$('#newsletterModal').modal('show');
		});
	</script>
<?php
}
?>

<body onload="showModal()">
	
	<?php include 'nav.php';
	?>
	<!-- banner -->
	
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators-->
		<ol class="carousel-indicators">
			<?php
			include 'Admin_modules/fetch_slider.php';
			
			foreach ($fetch_slider as $key => $value) 
			{ 
				if ($key == 0) 
				{ ?>
					<li data-target="#myCarousel" data-slide-to="<?php echo $key;?>" class="active"></li>
				<?php
				}
				else
				{
				?>
					<li data-target="#myCarousel" data-slide-to="<?php echo $key;?>" class=""></li>
				<?php
				}
			}
			?>
		</ol>

		<div class="carousel-inner" role="listbox">
			<?php
			$i = 0;

			foreach ($fetch_slider as $key => $value) 
			{ 
				$i++;

				if ($i == 1) 
				{ ?>
					<div class="item active">
						<img src="admin/images/website_config/slider_items/<?php echo $value['sl_img'];?>">
					</div>
				<?php
				}
				else
				{
				?>
					<div class="item item<?php echo $i;?>">
						<img src="admin/images/website_config/slider_items/<?php echo $value['sl_img'];?>">
					</div>
				<?php
				}
			}
			?>
		</div>

		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	<!-- //banner 

		Deals of the week-->
	
<!--deals of the week -->
<section style="padding: 40px 0;">
	<div class="dls">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-12 text-left">
					<div class="dls-heading">
						<h3>Deals of the day</h3>
					</div>
					
					<div class="corl">
						<div class="owl-carousel owl-carousel_one owl-theme owl-responsive">
							<a href="single.php">
								<div class="item">
									<div class="slider-item">
										<div class="slider-upper">
											<div class="slider-image">
												<img src="images/cart-in.jpg">
											</div>	
										</div>
										<div class="slider-lower">
											
										
										<div class="slider-money">
											Rs<span>40,000</span>
										</div>
										<div class="slider-title">
											Korea long sofa fabric in black color
										</div>
										<div class="slider-sold">
											Sold by: <span>Ibiza</span>
										</div>
										<div class="slider-stock">
											<progress value="22" max="100"></progress>
											</div>
										</div>	
									</div>
								</div>
							</a>
							<a href="single.php">
								<div class="item">
									<div class="slider-item">
										<div class="slider-upper">
											<img src="images/cart-in.jpg">
										</div>
										<div class="slider-lower">
											
										
										<div class="slider-money">
											Rs<span>40,000</span>
										</div>
										<div class="slider-title">
											Korea long sofa fabric in black color
										</div>
										<div class="slider-sold">
											Sold by: <span>Ibiza</span>
										</div>
										<div class="slider-stock">
											<progress value="22" max="100"></progress>
											</div>
										</div>	
									</div>
								</div>
							</a>
							<a href="single.php">
								<div class="item">
									<div class="slider-item">
										<div class="slider-upper">
											<div class="slider-image">
												<img src="images/cart-in.jpg">
											</div>	
										</div>
										<div class="slider-lower">
											
										
										<div class="slider-money">
											Rs<span>40,000</span>
										</div>
										<div class="slider-title">
											Korea long sofa fabric in black color
										</div>
										<div class="slider-sold">
											Sold by: <span>Ibiza</span>
										</div>
										<div class="slider-stock">
											<progress value="22" max="100"></progress>
											</div>
										</div>	
									</div>
								</div>
							</a>
							<a href="single.php">
								<div class="item">
									<div class="slider-item">
										<div class="slider-upper">
											<div class="slider-image">
												<img src="images/cart-in.jpg">
											</div>	
										</div>
										<div class="slider-lower">
											
										
										<div class="slider-money">
											Rs<span>40,000</span>
										</div>
										<div class="slider-title">
											Korea long sofa fabric in black color
										</div>
										<div class="slider-sold">
											Sold by: <span>Ibiza</span>
										</div>
										<div class="slider-stock">
											<progress value="22" max="100"></progress>
											</div>
										</div>	
									</div>
								</div>
							</a>
							<a href="single.php">
								<div class="item">
									<div class="slider-item">
										<div class="slider-upper">
											<div class="slider-image">
												<img src="images/cart-in.jpg">
											</div>	
										</div>
										<div class="slider-lower">
											
										
										<div class="slider-money">
											Rs<span>40,000</span>
										</div>
										<div class="slider-title">
											Korea long sofa fabric in black color
										</div>
										<div class="slider-sold">
											Sold by: <span>Ibiza</span>
										</div>
										<div class="slider-stock">
											<progress value="22" max="100"></progress>
											</div>
										</div>	
									</div>
								</div>
							</a>
							<a href="single.php">
								<div class="item">
									<div class="slider-item">
										<div class="slider-upper">
											<div class="slider-image">
												<img src="images/cart-in.jpg">
											</div>	
										</div>
										<div class="slider-lower">
											
										
										<div class="slider-money">
											Rs<span>40,000</span>
										</div>
										<div class="slider-title">
											Korea long sofa fabric in black color
										</div>
										<div class="slider-sold">
											Sold by: <span>Ibiza</span>
										</div>
										<div class="slider-stock">
											<progress value="22" max="100"></progress>
											</div>
										</div>	
									</div>
								</div>
							</a>
							<a href="single.php">
								<div class="item">
									<div class="slider-item">
										<div class="slider-upper">
											<div class="slider-image">
												<img src="images/banner1.jpg">
											</div>	
										</div>
										<div class="slider-lower">
											
										
										<div class="slider-money">
											Rs<span>40,000</span>
										</div>
										<div class="slider-title">
											Korea long sofa fabric in black color
										</div>
										<div class="slider-sold">
											Sold by: <span>Ibiza</span>
										</div>
										<div class="slider-stock">
											<progress value="22" max="100"></progress>
											</div>
										</div>	
									</div>
								</div>
							</a>
							<a href="single.php">
								<div class="item">
									<div class="slider-item">
										<div class="slider-upper">
											<div class="slider-image">
												<img src="images/cart-in.jpg">
											</div>	
										</div>
										<div class="slider-lower">
											
										
										<div class="slider-money">
											Rs<span>40,000</span>
										</div>
										<div class="slider-title">
											Korea long sofa fabric in black color
										</div>
										<div class="slider-sold">
											Sold by: <span>Ibiza</span>
										</div>
										<div class="slider-stock">
											<progress value="22" max="100"></progress>
											</div>
										</div>	
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--end deals of the week -->

<!-- Categorized cards -->
<section class="fd">
	<div class="container">

		<?php 
		include 'Admin_modules/fetch_featured.php';

		foreach ($categorized_cards as $key => $cat_value) 
		{
		?>
		<div class="row">
			<div class="col-md-12">
				<div class="deal-inner">
					<div class="upper">
						<div class="img-overlay zoom">
							<h3 class="overlay-title"><?php echo $cat_value['cat_name'];?></h3>
						</div>
						<img src="admin/images/website_config/categorized_cards/<?php echo $cat_value['cat_img'];?>">		
					</div>
					<?php
					$cat = $cat_value['cat_name'];
					$fetch_items = FETCH_ITEMS($cat);
					//print_r($fetch_items);
					if (!empty($fetch_items)) 
					{ ?>

						<div class="lower">
							<div class="lower-slider">
								<div class="owl-carousel owl-carousel_two owl-theme">
									<?php
									foreach ($fetch_items as $key => $itm_value) 
									{ 
										//print_r($itm_value);

									$sold = $itm_value['sold'];
									$remain = $itm_value['stock'];
									$total = $itm_value['total_stock'];

									$percent_prog = floor(($sold * 100) / $total);?>

									<a href="single.php?id=<?php echo $itm_value['prod_id'];?>">
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
									</a>
									<?php
									}
									?>
								</div>
							</div>
						</div>

					<?php
					}
					?>
				</div>
			</div>
		</div>
		<?php
		}
		?>
	</div>
</section>
<!--end Categorized cards-->

<!-- Featured Products -->
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="ftr-heading">
					<h3>Featured Products</h3>	 
				</div>
			</div>
		</div>
		<div class="row">

		<?php 
			

			foreach ($featured_products as $key => $value) 
			{ ?>

				<div class="col-md-3 col-xs-6">
					<div class="ftr-card">
						<a href="single.php?id=<?php echo $value['prod_id'];?>"><img src="admin/images/all_products/<?php echo $value['prod_id'].'/'.$value['file1'];?>"></a>
					</div>
				</div>		

			<?php 
			}
		?>

		</div>
	</div>
</section>



<!-- <div class="modal" id="newsletterModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body modal-body-sub_agile">
				<div class="main-mailposi">
					<span class="fa fa-envelope-o" aria-hidden="true"></span>
				</div>
				<div class="modal_body_left modal_body_left1">
					<h3 class="agileinfo_sign">Subscribe to our Newsletter </h3>
					<p>
						Subscribe to our Newsletter to get information and updates on latest products<br>
						<form action="./Admin_modules/subscribe_newsletter.php" method="post">
							<div class="form-group">
								<input type="email" placeholder="E-mail" name="newsletter_mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" autofocus autocomplete="off" required="">
							</div>

							<input type="submit" name="newsletter_button" value="Subscribe">
						</form>
					</p>
					
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div> -->


<!-- Featured products end -->

<?php include 'footer.php'; ?>