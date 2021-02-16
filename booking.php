<?php
session_start();
include 'header.php';
include 'Admin_config/connection.php';
include 'Admin_controllers/booking.php';
include 'Admin_controllers/products.php';

$userId = $_SESSION['user_id'];

$all_bookings = FETCH_USER_BOOKING_TRANSACTIONS($userId);
// print_r($all_bookings);
?>

<body>
	<?php include 'nav.php'; ?>
	<!-- booking page -->
	<div class="privacy">
		<div class="container">
			<!-- tittle heading -->
			<h3 class="tittle-w3l">Bookings
				<span class="heading-style">
					<i></i>
					<i></i>
					<i></i>
				</span>
			</h3>
			<!-- //tittle heading -->
			<div class="checkout-right">

				<div class="table-responsive">
					<table class="timetable_sub">
						<thead>
							<tr>
								<th>Product Name</th>
								<th>Quantity</th>
								<th>Booking Amount</th>
								<th> </th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($all_bookings != null) {

								foreach ($all_bookings as $value) { ?>
									<tr class="rem1">
										<td class="invert"><?php echo $value['prod_name']  ?></td>
										<td class="invert">
											<div class="quantity">
												<div class="quantity-select">

													<!-- <div class="entry value-minus" onclick="decrease_quantity()">&nbsp;</div> -->
													<div class="entry" id="prod_quan">
														<?php echo $value['bk_quantity']  ?>
													</div>
												</div>
											</div>
										</td>

										<td class="invert"><input type="text" class="text-center" id="bk_amount" style="width:50%; height:auto;border:none;" name="amt" value="<?php echo $value['bk_amt'] ?>"></td>
										<td>
											<!--make payment or initialize refund-->
											<?php

											$prod_id = $value['prod_id'];
											$prod_info = PRODUCT_PAGE_INFO($prod_id);

											$today = new DateTime(date('Y-m-d'));

											$prod_time = new DateTime($prod_info['prod_timer']);

											$diff = $today->diff($prod_time)->format("%r%a");

											?>
											<?php

											if ($diff > 0) {

											?>
													<!-- <input type="submit" name="submit" value="Make Payment" class="button btn" style="background-color: #222222; color:#ffffff" /> -->
												
												<a href="booking_checkout.php?id=<?php echo $value['order_id'] ;?>&prod_id=<?php echo $value['prod_id'] ?>"><input name="submit" value="Make Payment" class="button btn" style="background-color: #222222; color:#ffffff" /></a>
											<?php
											} else {
											?>
												<form action="./Admin_modules/initiate_refund.php" method="POST">
													<input type="hidden" name="amount" value="<?php echo $value['bk_amt'] ?>">
													<input type="hidden" name="quantity" value="<?php echo $value['bk_quantity'] ?>">
													<input type="hidden" name="prod_id" value="<?php echo $value['prod_id'] ?>" id="prod_id">
													<input type="hidden" name="order_id" value="<?php echo $value['order_id']; ?>">
													<input type="hidden" name="prod_name" value="<?php echo $prod_info['prod_name'] ?>">
													<input type="submit" name="initiate_refund" value="Initiate Refund" class="button btn" style="background-color: #222222; color:#ffffff" />
												</form>
											<?php
											}
											?>

										</td>
									</tr>
							<?php
								}
							} else {
								echo "No bookings to show";
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function(){
			
		});

	</script>
	<!-- //booking page -->
	<?php include 'footer.php'; ?>