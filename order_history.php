<?php
session_start();
include 'header.php';
include 'Admin_config/connection.php';
include 'Admin_controllers/booking.php';
include 'Admin_controllers/order.php';

$userId = $_SESSION['user_id'];

$all_orders = FETCH_USER_ORDER($userId);
?>

<body>
	<?php include 'nav.php';?>
	<!-- booking page -->
	<div class="privacy">
		<div class="container">
			<!-- tittle heading -->
			<h3 class="tittle-w3l">Order History
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
								<th>Order Amount</th>
								<th> </th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($all_orders != null) {

								foreach ($all_orders as $value) { ?>
									<tr class="rem1">
										<td class="invert"><?php echo $value['prod_name']  ?></td>
										<td class="invert">
											<div class="quantity">
												<div class="quantity-select">

													<!-- <div class="entry value-minus" onclick="decrease_quantity()">&nbsp;</div> -->
													<div class="entry" id="prod_quan">
														<?php echo $value['order_quantity']  ?>
													</div>
												</div>
											</div>
										</td>

										<td class="invert"><?php echo $value['order_amt'];  ?></td>
										
									</tr>
							<?php
								}
							} else {
								echo "No orders to show";
							} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<script>
	</script>
	<!-- //booking page -->
	<?php include 'footer.php'; ?>