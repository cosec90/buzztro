<?php
include 'header.php';
include 'Admin_config/connection.php';
include 'Admin_controllers/products.php';

$prod = $_GET['id'];

$prod_info = PRODUCT_PAGE_INFO($prod);
//print_r($prod_info);
?>

<body>
	<?php include 'nav.php'; ?>

	<!-- Single Page -->
	<div class="banner-bootom-w3-agileits">
		<div class="container">

			<div class="col-md-5 single-right-left ">
				<div class="grid images_3_of_2">
					<div class="flexslider">
						<ul class="slides">

							<?php
							$img_arr = array();

							for ($i = 1; $i <= 5; $i++) {
								if ($prod_info['file' . $i] != "") {
									array_push($img_arr, $prod_info['file' . $i]);
								}
							}

							foreach ($img_arr as $key => $value) { ?>
								<li data-thumb="admin/images/all_products/<?php echo $prod_info['prod_id'] ?>/<?php echo $value ?>">
									<div class="thumb-image">
										<img src="admin/images/all_products/<?php echo $prod_info['prod_id'] ?>/<?php echo $value ?>" data-imagezoom="true" class="img-responsive" alt="">
									</div>
								</li>
							<?php
							}
							?>
						</ul>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="col-md-7 single-right-left simpleCart_shelfItem">
				<?php
				$today = new DateTime(date('Y-m-d'));

				$prod_time = new DateTime($prod_info['prod_timer']);

				$diff = $today->diff($prod_time)->format("%r%a");
				?>
				<p style="margin-bottom: 25px;
					width: 65%;
				    padding: 10px 15px;
				    color: #fff;
				    background: #272727;
				    border-radius: 5px;
				    font-size: 14px;">
					<i class="fas fa-calendar-alt"></i>&nbsp;&nbsp;
					<?php
					if ($diff > 0) {
						echo $diff . " Days Left";
					} elseif ($diff == 0) {
						echo "Offer Ends Today";
					} else {
						echo "Product Not Available";
					}
					?>
				</p>

				<h3><?php echo $prod_info['prod_name'] ?></h3>

				<p>
					<span class="item_price"><?php echo '&#8377; ' . number_format($prod_info['admin_rate']); ?></span>
				</p>

				<?php
				$sold = $prod_info['sold'];
				$remain = $prod_info['stock'];
				$total = $prod_info['total_stock'];

				$percent_prog = floor(($sold * 100) / $total);

				$main_even_arr = array();

				for ($i = 1; $i <= count($prod_info['stock_div']) - 1; $i++) {

					$arr_val = (($prod_info['stock_div'][$i] - $prod_info['stock_div'][$i - 1]) * 100) / $total;


					array_push($main_even_arr, $arr_val);
				}
				?>

				<div class="custom_progress">
					<div class="main_bar" style="width: <?php echo $percent_prog; ?>%"></div>

					<div class="price_row_dots" style="grid-template-columns: <?php foreach ($main_even_arr as $key => $value) {
																					echo $value . "% ";
																				}
																				echo "auto"; ?>">

						<?php

						foreach ($prod_info['price'] as $key => $value) { ?>
							<div class="single">
								<div class="dot">

								</div>
								<div class="dot_price">
									<span>&#8377; <?php echo number_format($value); ?></span>
								</div>
							</div>
						<?php
						}
						?>
					</div>
				</div>

				<div class="product-single-w3l">
					<p>
						<label>Booking Amount:
							<?php
							echo '&#8377; ' . number_format($prod_info['booking_amt']);
							?>
						</label>
					</p>
				</div>

				<?php
				if ($diff > 0 || $diff == 0) {
					if (isset($_SESSION['user_id'])) {
						if ($prod_info['stock'] != 0) { ?>
							<div class="occasion-cart">
								<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out book_buy">
									<form action="#" method="post">
										<fieldset>
											<input type="hidden" name="cmd" value="_cart" />
											<input type="hidden" name="item_name" value="<?php echo $prod_info['prod_name'] ?>" />
											<input type="hidden" name="amount" value="<?php echo $prod_info['booking_amt']; ?>" />
											<input type="hidden" name="id" value="<?php echo $prod; ?>" />
											<input type="hidden" name="currency_code" value="INR" />
											<a href="checkout.php?id=<?php echo $prod_info['prod_id'] ?>"><input type="button" name="submit" value="Book Now" class="button" /></a>
										</fieldset>
									</form>
								</div>

								<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out book_buy" style="display: flex; align-items: center;">
									<a href="order_checkout.php?id=<?php echo $prod; ?>" class="book_buy">Buy Now</a>
								</div>
							</div>
						<?php
						} else { ?>
							<div class="alert alert-warning" role="alert" style="font-size: 16px;">
								Product Out of Stock
							</div>
						<?php
						}
					} else { ?>
						<div class="alert alert-danger" role="alert" style="font-size: 16px;">
							Login to buy product
						</div>
					<?php
					}
				} else {
					if (isset($_SESSION['user_id'])) { ?>

						<div class="occasion-cart">
							<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out book_buy">
								<form action="Admin_modules/add_watch_list.php" method="post">
									<fieldset>
										
										<input type="hidden" name="id" value="<?php echo $prod_info['prod_id']; ?>" />
										
										<input type="submit" name="submit" value="Add to Watch List" class="button" /> 
									</fieldset>
								</form>
							</div>

							
						</div>

				<?php
					} else {
					}
				}
				?>

				<div class="product-single-w3l">
					<p>
						<label>Category: <?php echo $prod_info['prod_category']; ?></label>
					</p>
					<p>
						<?php echo $prod_info['prod_desc']; ?>
					</p>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!-- //Single Page -->

	<!-- footer -->
	<?php include 'footer.php'; ?>