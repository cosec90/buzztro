<?php
include 'header.php';
include 'Admin_config/connection.php';
include 'Admin_controllers/products.php';
include 'Admin_controllers/user.php';
include 'Admin_controllers/wallet.php';
include 'Admin_controllers/booking.php';
session_start();

$order = $_GET['id'];
$booking_info = FETCH_BOOKING_USING_ORDER($order);
$user_id = $_SESSION['user_id'];
$get_address = GET_ADDRESS($user_id);
$fetch_wallet = FETCH_WALLET($user_id);


$prod = $_GET['prod_id'];

$prod_info = PRODUCT_PAGE_INFO($prod);

?>

<body>
	<?php include 'nav.php';
	// print_r($prod_info);


	?>
	<!-- checkout page -->
	<div class="privacy">
		<div class="container">
			<!-- tittle heading -->
			<h3 class="tittle-w3l">Checkout
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
								<th>Booking Price</th>
								<th>Final Amount</th>
							</tr>
						</thead>
						<tbody>
							<tr class="rem1">
								<td class="invert"><?php echo $booking_info['prod_name']  ?></td>
								<td class="invert">
									<div class="quantity">
										<div class="quantity-select">
											<form action="Admin_modules/confirm_booking.php" method="post" class="creditly-card-form agileinfo_form" id="booking_checkout_form">
												<!-- <div class="entry value-minus" onclick="decrease_quantity()">&nbsp;</div> -->
												<!-- <div class="entry value" id="prod_quan">
												
                                            </div> -->
												<input type="hidden" value="<?php echo $prod_info['seller_Id']; ?>" name="seller_id">
												<input type="hidden" value="<?php echo $order; ?>" name="order_id">
												<input type="hidden" value="<?php echo $booking_info['prod_name']; ?>" name="prod_name">
												<input type="hidden" id="initial_amount" value="<?php echo $booking_info['bk_amt']; ?>">
												<input type="text" readonly class="entry value" value="<?php echo $booking_info['bk_quantity']; ?>" id="prod_quan" name="quantity">
												<!-- <div class="entry value-plus active" onclick="increase_quantity()">&nbsp;</div> -->
										</div>
									</div>
								</td>

								<td class="invert"><input type="text" readonly class="text-center" id="bk_amt" style="width:70px; height:auto;border:none;" value="<?php echo $booking_info['bk_amt']; ?>"></td>

								<td class="invert"><input type="text" readonly class="text-center" id="final_amount" name="amount" style="width:70px; height:auto;border:none;"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="checkout-left">
				<div class="address_form_agile">
					<h4>Select Address</h4>
					<!-- <form action="payment.html" method="post" class="creditly-card-form agileinfo_form"> -->
					<?php if ($get_address != null) {
						foreach ($get_address as $value) {
					?>
							<div class="form-check">
								<label class="form-check-label">
									<input type="radio" class="form-check-input" name="add1" required value="<?php echo $value['address'];  ?>"><?php echo $value['address']; ?>
								</label>
							</div>
					<?php
						}
					} ?>
					<?php if ($fetch_wallet == 0) {


					?>
						<div class="form-check">
							<label class="form-check-label">
								Not enough wallet balance
							</label>
						</div>
					<?php
					} else {
					?>
						<div class="form-check">
							<label class="form-check-label">

								<input type="checkbox" class="form-check-input" name="wallet_amt[]" onclick="add_wallet_amt()" id="wallet_amt" value="<?php echo $fetch_wallet; ?>">Add Wallet Balance (<?php echo $fetch_wallet; ?>)
							</label>
						</div>
					<?php
					} ?>


					<input type="hidden" value="<?php echo $_GET['prod_id']; ?>" name="product_id" id="prod_id">
					<input type="hidden" value="<?php echo $prod_info['sold']; ?>" name="stocks_sold">

					<input type="hidden" value="<?php echo $fetch_wallet; ?>" id="og_wallet">
					<input type="hidden" id="og_final_price">
					<a href="" data-toggle="modal" data-target="#form_modal"><button class="btn btn-primary" id="paymentBtn" onclick="make_a_payment()">Make a Payment</button></a>
					
					<!--modal -->

					<div class="modal fade" id="form_modal" tabindex="-1" role="dialog">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div class="modal-body modal-body-sub_agile">
									<div class="main-mailposi">
										<span class="fa fa-envelope-o" aria-hidden="true"></span>
									</div>
									<div class="modal_body_left modal_body_left1">
										<h3 class="agileinfo_sign">Payment Mode</h3>


										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
												
														<input type="radio" class="form-check-input" name="payment" id="online-radio" required value="card">Online
													

												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													
														<input type="radio" class="form-check-input" id="cash-radio" name="payment" required value="cash">COD
													

												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="alert alert-danger" role="alert" id="payment-alert" style="display:none">
														Only online payment allowed for orders of &#8377 5000 and above
													</div>
												</div>
											</div>
										</div>

										<input type="submit" name="submit" value="Make Payment">


									</div>
								</div>
							</div>
							<!-- //Modal content-->
						</div>
					</div>

					<!--modal end-->
					</form>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<script>
		// var some = document.getElementById("bk_amount").value;
		function calc_amount() {

			var quantity = $("#prod_quan").val();
			var prod_id = $("#prod_id").val();
			var bk_amt = $("#bk_amt").val();
			var final_amt = document.getElementById("final_amount");
			var og_final_amt = document.getElementById("og_final_price");
			$.ajax({
				url: "./Admin_modules/calculate_booking_checkout.php",
				method: "POST",

				data: {
					quan: quantity,
					id: prod_id,
					amt: bk_amt
				},
				success: function(data) {

					final_amt.value = data;
					og_final_amt.value = data;
					console.log(data);

				}
			})


		}
		var temp_amount;

		calc_amount(); //important

		//new function to calc with wallet

		function add_wallet_amt() {

			//Original price not changed
			var initial_wallet = parseInt(document.getElementById("og_wallet").value);
			var initial_amount = parseInt(document.getElementById("og_final_price").value)

			var amount = parseInt(document.getElementById('final_amount').value);
			var wallet_amt = parseInt(document.getElementById('wallet_amt').value);

			var amount_final = document.getElementById('final_amount');
			var wallet_final = document.getElementById('wallet_amt');



			console.log(initial_wallet);
			console.log(initial_amount);

			if (document.getElementById('wallet_amt').checked) {

				if (wallet_amt > amount) {

					amount_final.value = 0;
					wallet_amt = wallet_amt - amount;
					wallet_final.value = wallet_amt;


				} else if (wallet_amt === amount) {

					amount_final.value = 0;
					// new code
					wallet_amt = wallet_amt - amount;
					wallet_final.value = wallet_amt;

				} else {


					amount_final.value = amount - wallet_amt;


				}



			} else {

				amount_final.value = initial_amount;
				wallet_final.value = initial_wallet;

			}

			// if(wallet_amt > amount_final){

			// 	amount_final.value = 0;
			// 	wallet_final.value = wallet_amt - amount;				


			// }else if(wallet_amt == amount){

			// 	amount_final.value = 0;

			// }
			// else{

			// }



		}

		function make_a_payment() {


			var final_amount = document.getElementById('final_amount').value;


			if (final_amount >= 5000) {
				$('#payment-alert').css("display", "block");
				$('#cash-radio').attr("disabled", true);
				$('#online-radio').attr("disabled", false);
				$('#online-radio').attr("checked", true);
			} 
			else if(final_amount == 0){
				$('#payment-alert').css("display", "none");
				$('#cash-radio').attr("disabled", false);
				$('#cash-radio').attr("checked", true);
				$('#online-radio').attr("disabled", true);
			}
			else {

				$('#payment-alert').css("display", "none");
				$('#cash-radio').attr("disabled", false);
				$('#online-radio').attr("disabled", false);

				$('#online-radio').attr("checked", false);
				$('#cash-radio').attr("checked", false);
			}


		}
	</script>
	<!-- //checkout page -->
	<?php include 'footer.php'; ?>