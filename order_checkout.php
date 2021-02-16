<?php
include 'header.php';
include 'Admin_config/connection.php';
include 'Admin_controllers/products.php';
include 'Admin_controllers/user.php';
include 'Admin_controllers/wallet.php';
session_start();

$prod = $_GET['id'];

$prod_info = PRODUCT_PAGE_INFO($prod);
$user_id = $_SESSION['user_id'];
$get_address = GET_ADDRESS($user_id);
$fetch_wallet = FETCH_WALLET($user_id);
// print_r($prod_info);
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
								<th>Price</th>
							</tr>
						</thead>
						<tbody>
							<tr class="rem1">
								<td class="invert"><?php echo $prod_info['prod_name']  ?></td>
								<td class="invert">
									<div class="quantity">
										<div class="quantity-select">
											<form action="Admin_modules/pay_order.php" method="post" class="creditly-card-form agileinfo_form">
												<div class="entry value-minus" onclick="decrease_quantity()" id="decrease_quan">&nbsp;</div>
												<!-- <div class="entry value" id="prod_quan">
												
											</div> -->
												<input type="hidden" value="<?php echo $prod_info['prod_name']; ?>" name="prod_name">
												<input type="hidden" value="<?php echo $prod_info['seller_Id']; ?>" name="seller_id">
												<input type="hidden" id="initial_amount" value="<?php echo $prod_info['booking_amt'] ?>">
												<input type="text" class="entry value" value="1" id="prod_quan" name="quantity" id="quantity" readonly>
												<div class="entry value-plus active" onclick="increase_quantity()" id="increase_quan">&nbsp;</div>
										</div>
									</div>
								</td>

								<td class="invert"><input type="text" readonly class="text-center" id="bk_amount" style="width:70px; height:auto;border:none;" name="amt" value="0"></td>
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
									<input type="radio" class="form-check-input" name="delivery_add" required value="<?php echo $value['address'];  ?>"><?php echo $value['address']; ?>
								</label>
							</div>
					<?php
						}
					} ?>
					<?php if ($fetch_wallet == 0) {


					?>
						<div class="form-check">
							<label class="form-check-label">
								<input type="hidden" value="<?php echo $fetch_wallet; ?>" id="og_wallet">
								<input type="hidden" class="form-check-input" name="wallet_amt[]" onclick="add_wallet_amt()" id="wallet_amt" value="<?php echo $fetch_wallet; ?>">
								Not enough wallet balance
							</label>
						</div>
					<?php
					} else {
					?>
						<div class="form-check">
							<label class="form-check-label">
								<input type="hidden" value="<?php echo $fetch_wallet; ?>" id="og_wallet">
								<input type="checkbox" class="form-check-input" name="wallet_amt[]" onclick="add_wallet_amt()" id="wallet_amt" value="<?php echo $fetch_wallet; ?>">Add Wallet Balance (<?php echo $fetch_wallet; ?>)
							</label>
						</div>
					<?php
					} ?>

					<input type="hidden" value="<?php echo $prod_info['seller_Id']; ?>" name="seller_id">

					<input type="hidden" value="<?php echo $_GET['id']; ?>" name="product_id">

					<input type="hidden" value="<?php echo $prod_info['stock']; ?>" name="stock">

					<input type="hidden" value="<?php echo $_GET['id']; ?>" name="product_id" id="prod_id">
					<input type="hidden" value="<?php echo $prod_info['sold']; ?>" name="stocks_sold">
					<a href="" data-toggle="modal" data-target="#form_modal"><button class="btn btn-primary" onclick='make_a_payment()'>Make a Payment</button></a>

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
												
														<input type="radio" class="form-check-input" id="online-radio" name="payment_mode" required value="card">Online
													

												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<div >
														<input type="radio" class="form-check-input" id="cash-radio" name="payment_mode" required value="cash">COD
													</div>

												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="alert alert-danger" role="alert" id="payment-alert" style="display:none">
													Only online payment allowed for orders of &#8377 5000 and above
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
		// function to calculate initial amount
		function calc_initial_amount() {

			var quan = document.getElementById("prod_quan");
			var amount = document.getElementById("bk_amount");
			var prod_id = document.getElementById("prod_id").value;

			$.ajax({
				url: "./Admin_modules/calculate_order_checkout.php",
				method: "POST",

				data: {
					quan: quan.value,
					id: prod_id
				},
				success: function(data) {

					amount.value = data;
				}
			});

		}
		//call to initialise
		calc_initial_amount();


		// var some = document.getElementById("bk_amount").value;
		function increase_quantity() {


			var initial_amount = document.getElementById("initial_amount").value;
			var quantity = 0;
			var new_amount = 0;
			quantity = document.getElementById("prod_quan").value;
			quantity++;
			var prod_id = document.getElementById("prod_id").value;



			document.getElementById("prod_quan").value = quantity;
			new_amount = quantity * initial_amount;
			var amount = document.getElementById("bk_amount");
			var amount_change = document.getElementById("bk_amount").value;
			var wallet_check = document.getElementById("wallet_amt");
			var wallet_amt = document.getElementById("wallet_amt").value;



			$.ajax({
				url: "./Admin_modules/calculate_order_checkout.php",
				method: "POST",

				data: {
					quan: quantity,
					id: prod_id
				},
				success: function(data) {

					if (data == 'excceed') {
						alert("Stock limit reached");
						amount.value = 0;
						document.getElementById("prod_quan").value = 0;
					} else {
						amount.value = data;

					}
					console.log(data);

				}
			});
		}

		function decrease_quantity() {
			var initial_amount = document.getElementById("initial_amount").value;
			var quantity = document.getElementById("prod_quan").value;
			var quan = document.getElementById("prod_quan");
			var amount = document.getElementById("bk_amount");
			var prod_id = document.getElementById("prod_id").value;
			var wallet_check = document.getElementById("wallet_amt");
			var wallet_amt = document.getElementById("wallet_amt").value;
			var new_amount = 0;
			var new_quantity = 0;
			quantity--;
			new_quantity = quantity;
			if (new_quantity == 0) {
				quan.value = 1;

				// amount.value = initial_amount;
				// amount.value = 0;
				wallet_check.checked = false;

				alert("Quantity cannot be 0");

				//ajax call to set initial amount if quantity becomes 0


				$.ajax({
					url: "./Admin_modules/calculate_order_checkout.php",
					method: "POST",

					data: {
						quan: quan.value,
						id: prod_id
					},
					success: function(data) {

						amount.value = data;
					}
				});


			} else {

				quan.value = new_quantity;
				// new_amount = new_amount - initial_amount;
				// amount.value = new_amount;

				$.ajax({
					url: "./Admin_modules/calculate_order_checkout.php",
					method: "POST",

					data: {
						quan: quantity,
						id: prod_id
					},
					success: function(data) {

						amount.value = data;

					}
				});

			}


		}
		var temp_amount;
		var temp_wallet_amt;

		function add_wallet_amt() {

			var amount = parseInt(document.getElementById("initial_amount").value);
			var quantity = document.getElementById("prod_quan");
			var wall_amt = parseInt(document.getElementById("og_wallet").value);


			var bk_amount = parseInt(document.getElementById("bk_amount").value);
			var bk_amount_og = document.getElementById("bk_amount");
			var wallet_amt = parseInt(document.getElementById("wallet_amt").value);
			var wallet_amt_og = document.getElementById("wallet_amt");


			if (document.getElementById('wallet_amt').checked) {


				$('#increase_quan').css("display", "none");
				$('#decrease_quan').css("display", "none");



				if (wallet_amt > bk_amount) {

					bk_amount_og.value = 0;
					wallet_amt = wallet_amt - bk_amount;
					wallet_amt_og.value = wallet_amt;
					console.log("inside if");

				} else if (wallet_amt === bk_amount) {

					bk_amount_og.value = 0;
					//new code
					wallet_amt = wallet_amt - bk_amount;
					wallet_amt_og.value = wallet_amt;

				} else {


					bk_amount_og.value = bk_amount - wallet_amt;


				}
			} else {

				bk_amount_og.value = 0;
				wallet_amt_og.value = wall_amt;
				quantity.value = 0;
				console.log(wall_amt);
				$("#increase_quan").css("display", "inline-block");
				$("#decrease_quan").css("display", "inline-block");
			}


		}

		function make_a_payment() {


			var final_amount = document.getElementById('bk_amount').value;


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