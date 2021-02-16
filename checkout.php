<?php
include 'header.php';
include 'Admin_config/connection.php';
include 'Admin_controllers/products.php';
include 'Admin_controllers/user.php';
include 'Admin_controllers/wallet.php';
session_start();

$prod = $_GET['id'];

$prod_info = PRODUCT_PAGE_INFO($prod);
// print_r($prod_info);
$user_id = $_SESSION['user_id'];

$get_address = GET_ADDRESS($user_id);
// print_r($get_address);
$fetch_wallet = FETCH_WALLET($user_id);
// print_r($fetch_wallet);

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
											<form action="Admin_modules/pay_booking.php" method="post" class="creditly-card-form agileinfo_form">
												<div class="entry value-minus" onclick="decrease_quantity()" id="decrease_quan">&nbsp;</div>

												<input type="hidden" value="<?php echo $prod_info['seller_Id']; ?>" name="seller_id">
												<input type="hidden" value="<?php echo $prod_info['prod_name']; ?>" name="prod_name">
												<input type="hidden" id="initial_amount" value="<?php echo $prod_info['booking_amt'] ?>">
												<input type="text" class="entry value" value="1" id="prod_quan" name="quantity" readonly>
												<div class="entry value-plus active" onclick="increase_quantity()" id="increase_quan">&nbsp;</div>
										</div>
									</div>
								</td>

								<td class="invert"><input type="text" readonly class="text-center" id="bk_amount" style="width:70px; height:auto;border:none;" name="amt" value="<?php echo $prod_info['booking_amt'] ?>"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="checkout-left">
				<div class="address_form_agile">
					<!-- <form action="payment.html" method="post" class="creditly-card-form agileinfo_form"> -->


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
								<input type="hidden" value="<?php echo $fetch_wallet; ?>" id="og_wallet">
								<!-- <input type="checkbox" class="form-check-input" name="wallet_amt[]" onclick="add_wallet_amt(this)" id="wallet_amt" value="<?php echo $fetch_wallet; ?>">Add Wallet Balance (<?php echo $fetch_wallet; ?>) -->
								<input type="checkbox" class="form-check-input" name="wallet_amt[]" onclick="add_wallet_amt()" id="wallet_amt" value="<?php echo $fetch_wallet; ?>">Add Wallet Balance (<?php echo $fetch_wallet; ?>)
							</label>
						</div>
					<?php
					} ?>
					<!-- <input type="hidden" id="final_amt" name="final_amt">
						<input type="hidden" id="final_quantity" name="final_quantity"> -->

					<!-- <div class="checkout-right-basket">
						<a href="payment.php">Make a Payment
						</a>
					</div> -->
					<input type="hidden" value="<?php echo $_GET['id']; ?>" name="product_id" id="prod_id">
					<input type="hidden" value="<?php echo $prod_info['stock']; ?>" name="stock">

					<button class="btn btn-primary" type="submit" name="submit" id="btn_payment">Make a Payment</button>
					<button class="btn btn-primary" type="submit" name="wallet_payment" id="btn_wallet_payment" style="display:none">Make a Payment(Wallet)</button>
					</form>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<script>
		function increase_quantity() {
			var initial_amount = parseInt(document.getElementById("initial_amount").value);
			var quantity = 0;
			var new_amount = parseInt(document.getElementById("bk_amount").value);
			quantity = document.getElementById("prod_quan").value;
			quantity++;
			document.getElementById("prod_quan").value = quantity;
			// new_amount = quantity * initial_amount;
			new_amount = new_amount + initial_amount;
			var amount = document.getElementById("bk_amount");
			amount.value = new_amount;

		}

		function decrease_quantity() {
			var initial_amount = parseInt(document.getElementById("initial_amount").value);
			var quantity = document.getElementById("prod_quan").value;
			var quan = document.getElementById("prod_quan");
			var amount = document.getElementById("bk_amount");
			var new_amount = document.getElementById("bk_amount").value;
			var wallet_check = document.getElementById("wallet_amt");
			var new_quantity = 0;
			quantity--;
			new_quantity = quantity;
			if (new_quantity == 0) {
				quan.value = 1;

				amount.value = initial_amount;
				wallet_check.checked = false;
				alert("Quantity cannot be 0");
			} else {

				quan.value = new_quantity;
				new_amount = new_amount - initial_amount;
				if (new_amount <= 0) {
					amount.value = 0;
				} else {
					amount.value = new_amount;
				}


			}

		}
		var temp_wallet_amt;
		var temp_amount;

		// function add_wallet_amt(amt) {

		// 	var wallet_amt = parseInt(document.getElementById("wallet_amt").value);
		// 	var og_wallet_amt = parseInt(document.getElementById("og_wallet").value);
		// 	var amount = parseInt(document.getElementById("bk_amount").value);
		// 	var wallet_check = document.getElementById("wallet_amt");
		// 	var new_wallet_amt = document.getElementById("wallet_amt");
		// 	var new_amount = document.getElementById("bk_amount");

		// 	if (wallet_check.checked) {

		// 		$("#increase_quan").css("display","none");
		// 		$("#decrease_quan").css("display","none");

		// 		if (amount >= wallet_amt) {
		// 			temp_amount = amount - wallet_amt;
		// 			new_amount.value = amount - wallet_amt;
		// 			wallet_amt = 0;

					
		// 		} else {
					
		// 			temp_amount = amount - wallet_amt;
		// 			wallet_amt = wallet_amt - amount;
		// 			new_amount.value = 0;
					
					
		// 		}
				
		// 	} else {

		// 		$("#increase_quan").css("display","inline-block");
		// 		$("#decrease_quan").css("display","inline-block");

		// 		new_amount.value = temp_amount + og_wallet_amt;
		// 		wallet_amt = og_wallet_amt;

		// 		// comment this and next line
		// 		$("#btn_payment").css("display","block"); 
		// 		$("#btn_wallet_payment").css("display","none");


		// 	}


		// }

			function add_wallet_amt(){

				var amount =parseInt(document.getElementById("initial_amount").value);
				var quantity = document.getElementById("prod_quan");
				var wall_amt =  parseInt(document.getElementById("og_wallet").value);
				

				var bk_amount =parseInt(document.getElementById("bk_amount").value);
				var bk_amount_og =document.getElementById("bk_amount");
				var wallet_amt =  parseInt(document.getElementById("wallet_amt").value);
				var wallet_amt_og =  document.getElementById("wallet_amt");

				
				if( document.getElementById('wallet_amt').checked){

					
					$('#increase_quan').css("display","none");
					$('#decrease_quan').css("display","none");

					

					if(wallet_amt > bk_amount){

						bk_amount_og.value = 0;
						wallet_amt = wallet_amt - bk_amount ;
						wallet_amt_og.value = wallet_amt;
						
						
					}
					else if(wallet_amt === bk_amount){

						bk_amount_og.value = 0;
						// new code
						wallet_amt = wallet_amt - bk_amount ;
						wallet_amt_og.value = wallet_amt;
					}
					else{


						bk_amount_og.value =bk_amount - wallet_amt;
						

					}
				}
				else{

					bk_amount_og.value = amount;
					wallet_amt_og.value = wall_amt;
					quantity.value = 1;
					console.log(wall_amt);
					$("#increase_quan").css("display","inline-block");
					$("#decrease_quan").css("display","inline-block");
				}


			}



	</script>
	<!-- //checkout page -->
	<?php include 'footer.php'; ?>