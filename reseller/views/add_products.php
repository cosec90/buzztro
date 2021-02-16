<?php

date_default_timezone_set("Asia/Kolkata");
error_reporting(0);
session_start();

if (!isset($_SESSION['seller_Id'])) {
	header('Location: login.php');
}
include 'header.php';
?>

<body id="page-top">

	<?php include 'navbar.php'; ?>

	<div id="wrapper">

		<?php include 'sidebar.php'; ?>

		<div id="content-wrapper">

			<div class="container-fluid">

				<!-- Breadcrumbs-->
				<div class="breadcrumb_custom">
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<p>Current User: <b><?php echo ($_SESSION['seller_name']) ?></b></p>
						</div>
						<div class="col-lg-6 col-md-6">
							<p id="datetime" style="text-align: right;">
								<?php echo date("l") . ", " . date("d/m/Y"); ?>
							</p>
						</div>
					</div>
				</div>

				<div class="card mb-3">
					<div class="card-header">
						<i class="fas fa-box-open"></i>&nbsp;&nbsp;
						Add Product</div>
					<div class="card-body">
						<u>
							<h5>Product Details</h5>
						</u><br>
						<?php
						include '../Admin_controllers/product.php';

						$curr_prod_id = $_GET['id'];

						$curr_product = FETCH_PRODUCT_DETAILS($curr_prod_id);
						?>

						<form action="../Admin_modules/product_add.php" method="post" enctype="multipart/form-data">
							<p>(Fields marked <sup style="color: red;">*</sup> are mandatory)</p>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<div class="form-label-group">
											<input type="text" id="prod_id" name="prod_id" class="form-control" placeholder="Product ID" autofocus="autofocus" readonly value="<?php echo 'BUZZ' . date('s') . date('i') . date('Y') . date('H') . date('m') . date('d'); ?>">
											<label for="prod_id">Product ID</label>
										</div>
									</div>
									<div class="form-group">
										<div class="form-label-group">
											<textarea type="text" id="prod_desc" name="prod_desc" class="form-control" rows="5" placeholder="Product Description" autofocus="autofocus" required><?php echo strip_tags($curr_product['prod_desc']); ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<div class="form-label-group">
											<input type="text" id="prod_stock" name="prod_stock" onkeyup="default_row_stock()" onblur="random_function()" class="form-control" placeholder="Total Stock" autofocus="autofocus" required>
											<label for="prod_stock">Total Stock</label>
											<div class="alert alert-danger" id="alert-stock">
												Cannot divide stock in 4 equal parts
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<div class="form-label-group">
											<input type="text" id="prod_name" name="prod_name" class="form-control" placeholder="Product Name" autofocus="autofocus" required value="<?php echo $curr_product['prod_name']; ?>">
											<label for="prod_name">Product Name<sup style="color: red;">*</sup></label>
										</div>
									</div>
									<div class="form-group">
										<div class="form-label-group">
											<input type="file" id="prod_img" name="prod_img[]" class="form-control" placeholder="Product Image" accept="image/*" required multiple>

											<label for="prod_img">Product Image (Please select all images at once)<sup style="color: red;">*</sup> (Max: 5)</label>
										</div>
									</div>
									<div class="form-group">
										<div class="form-label-group">
											<input type="text" id="prod_rate" name="prod_rate" onkeyup="default_row_rate()" onblur="random_function()" class="form-control" placeholder="Rate per Item" autofocus="autofocus" required>
											<label for="prod_rate">Rate per Item</label>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-3">
									<div class="form-group">
										<div class="form-label-group">
											<input type="text" id="prod_weight" name="prod_weight" class="form-control" placeholder="Product Weight (in gms)" autofocus="autofocus"  required>
											<label for="prod_weight">Product Weight (in gms)<sup style="color: red;">*</sup></label>
										</div>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="form-group">
										<div class="form-label-group">
											<input type="text" id="prod_length" name="prod_length" class="form-control" placeholder="Product Length" autofocus="autofocus" onkeypress='validateNum(event)'  required>
											<label for="prod_length">Product Length<sup style="color: red;">*</sup></label>
										</div>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="form-group">
										<div class="form-label-group">
											<input type="text" id="prod_breadth" name="prod_breadth" class="form-control" placeholder="Product Breadth" autofocus="autofocus" onkeypress='validateNum(event)'  required>
											<label for="prod_breadth">Product Breadth<sup style="color: red;">*</sup></label>
										</div>
									</div>
								</div>	
								<div class="col-lg-2">
									<div class="form-group">
										<div class="form-label-group">
											<input type="text" id="prod_height" name="prod_height" class="form-control" placeholder="Product Height" autofocus="autofocus" onkeypress='validateNum(event)'  required>
											<label for="prod_height">Product Height<sup style="color: red;">*</sup></label>
										</div>
									</div>
								</div>
								<div class="col-lg-3">
									<div class="form-group">
										<select id="prod_unit" name="prod_unit" class="form-control" required>
											<option selected hidden disabled>Select Product Unit</option>
											<option value="in">inch</option>
											<option value="cm">cm</option>
										</select>
									</div>
								</div>
							</div>

							<script>
							function validateNum(evt) {
							  var theEvent = evt || window.event;
							  var key = theEvent.keyCode || theEvent.which;
							  key = String.fromCharCode( key );
							  var regex = /[0-9]|\./;
							  if( !regex.test(key) ) {
							    theEvent.returnValue = false;
							    if(theEvent.preventDefault) theEvent.preventDefault();
							  }
							}
							    
							</script>
							<div class="row">
								<div class="col-lg-2"></div>
								<div class="col-lg-8 text-center">
									<table border="1" class="table table-hover">
										<thead>
											<th>Items Sold</th>
											<th>Price per Item (in Rs)</th>
											<!-- <th style="padding: 0;">
									<div class="btn_approve" onclick="addrow();" style="display: -webkit-inline-box; margin: 10px 0; cursor: pointer;"><i class="fa fa-plus"></i>&nbsp;&nbsp;<p style="margin-bottom: 0;">Add Row</p></div>
								</th> -->
										</thead>
										<tbody>
											<tr>
												<td>
													<input type="text" id="first_remain" name="item_remain" class="form-control" autofocus="autofocus" readonly value="0" style="width: 60%; text-align: center; margin: auto;" required>
												</td>
												<td>
													<input type="text" id="def_rate" readonly name="item_rate" class="form-control" autofocus="autofocus" style="width: 60%; text-align: center; margin: auto;" placeholder="Rate per Item" required>
												</td>
											</tr>

											<?php

											for ($i = 1; $i <= 3; $i++) { ?>

												<tr id="row<?php echo $i; ?>">
													<td>
														<input type="text" id="item_remain" onblur="validate_row<?php echo $i; ?>()" name="item_remain" class="form-control" placeholder="Items Sold" autofocus="autofocus" style="width: 60%; text-align: center; margin: auto;" readonly required>
													</td>
													<td>
														<input type="text" id="item_rate" onblur="validate_row<?php echo $i; ?>()" name="item_rate" class="form-control" placeholder="Rate per Item" autofocus="autofocus" style="width: 60%; text-align: center; margin: auto;" required>
													</td>
												</tr>

											<?php

											}

											?>

											<tr id="before_zero">
												<td>
													<input type="text" id="def_remain" name="item_remain" class="form-control" autofocus="autofocus" readonly style="width: 60%; text-align: center; margin: auto;">
												</td>
												<td>
													<input type="text" id="item_rate" name="item_rate" class="form-control" placeholder="Rate per Item" autofocus="autofocus" style="width: 60%; text-align: center; margin: auto;">
												</td>
											</tr>

										</tbody>
									</table>
								</div>
								<div class="col-lg-2"></div>
							</div>

							<script>
								var i = 2;

								function addrow() {
									i++;

									if (i >= 5) {
										alert('Limit Reached');
										$('.btn_approve').hide();
									} else {
										$('tr:last').before('<tr id="row' + i + '"><td><input type="text" id="item_remain" onblur="validate_row' + i + '()" name="item_remain" class="form-control" placeholder="Item Remaining" autofocus="autofocus" required style="width: 60%; text-align: center; margin: auto;"></td><td><input type="text" id="item_rate" onblur="validate_row' + i + '()" name="item_rate" class="form-control" placeholder="Rate per Item" autofocus="autofocus" required style="width: 60%; text-align: center; margin: auto;"></td><td style="padding: 0;"><div class="btn_reject" onclick="deleterow(this);" style="display: -webkit-inline-box; margin: 10px 0; cursor: pointer;"><i class="fa fa-minus"></i>&nbsp;&nbsp;<p style="margin-bottom: 0;">Delete Row</p></div></td></tr>');
									}
								}

								function deleterow(that) {
									that.closest("tr").remove();
									i--;
								}

								function default_row_stock() {
									var stock = $('#prod_stock').val();
									var min_stock = 20;


									if (stock.match(/^\d+$/)) {
										$('#def_remain').val(stock - 1);
										
									} else {
										alert("Please enter numeric value");
										$('#prod_stock').val("");
									}

								}
								//random_func
								function random_function() {
									var stock = "";
									stock = $('#prod_stock').val();
									var min_stock = 20;

									if (stock % 4 != 0) {
										$('#alert-stock').css("display", "block");
										$('#validate_btn').css('display', 'none');
										if (stock < min_stock) {
											alert("Minimum stock requirement is 20");
											$('#validate_btn').css('display', 'none');
										}

									} else {
										
										if (stock >= min_stock) {

											add_items_sold(stock);
											$('#validate_btn').css('display', 'block');
											$('#alert-stock').css("display", "none");
										}	
										
									}


								}

								function add_items_sold(stock_val) {


									var length_items = $("input[name*='item_remain']").length;

									var val = stock_val;

									var divisible = stock_val / 4;
									var temp_val = 0;

									for (var i = 1; i < length_items; i++) {

										temp_val = temp_val + divisible;
										var single_value = $("input[name*='item_remain']").get(i);
										single_value.value = temp_val;

										if (i == length_items - 1) {
											single_value.value = temp_val - 1;
										}


									}
									//------------------------------------------ //



								}

								function default_row_rate() {
									var rate = $('#prod_rate').val();

									if (rate.match(/^\d+$/)) {
										$('#def_rate').val(rate);
									} else {
										alert("Please enter numeric value");
										$('#prod_rate').val("");
									}

								}

								function validate_row1() {
									var stock = $('#first_remain').val();
									var input_stock = $('#row1 #item_remain').val();

									var price = $('#def_rate');
									var input_price = $('#row1 #item_rate');

									if (stock != "") {
										if (parseInt(input_stock) <= parseInt(stock)) {
											alert("Stock cannot be less than the previous");
											$('#row1 #item_remain').val("");
											$('#row1 #item_remain').focus();
										}
									} else {
										alert("Please enter total stock first");
										$('#row1 #item_remain').val("");
										$('#row1 #item_remain').focus();
									}

									checkRate(price, input_price);

								}

								function validate_row2() {
									var stock = $('#row1 #item_remain').val();
									var input_stock = $('#row2 #item_remain').val();

									var price = $('#row1 #item_rate');
									var input_price = $('#row2 #item_rate');

									if (stock != "") {
										if (parseInt(input_stock) <= parseInt(stock)) {
											alert("Stock cannot be less than the previous");
											$('#row2 #item_remain').val("");
											$('#row2 #item_remain').focus();
										}
									} else {
										alert("Please enter total stock first");
										$('#row2 #item_remain').val("");
										$('#row2 #item_remain').focus();
									}

									checkRate(price, input_price);

								}

								function validate_row3() {
									var stock = $('#row2 #item_remain').val();
									var input_stock = $('#row3 #item_remain').val();

									var price = $('#row2 #item_rate');
									var input_price = $('#row3 #item_rate');

									if (stock != "") {
										if (parseInt(input_stock) <= parseInt(stock)) {
											alert("Stock cannot be less than the previous");
											$('#row3 #item_remain').val("");
											$('#row3 #item_remain').focus();
										}
									} else {
										alert("Please enter total stock first");
										$('#row3 #item_remain').val("");
										$('#row3 #item_remain').focus();
									}

									checkRate(price, input_price);

								}

								function validate_row4() {
									var stock = $('#row3 #item_remain').val();
									var input_stock = $('#row4 #item_remain').val();

									var price = $('#row3 #item_rate');
									var input_price = $('#row4 #item_rate');

									if (stock != "") {
										if (parseInt(input_stock) <= parseInt(stock)) {
											alert("Stock cannot be less than the previous");
											$('#row4 #item_remain').val("");
											$('#row4 #item_remain').focus();
										}
									} else {
										alert("Please enter total stock first");
										$('#row4 #item_remain').val("");
										$('#row4 #item_remain').focus();
									}

									checkRate(price, input_price);

								}

								function validate_row5() {
									var stock = $('#row4 #item_remain').val();
									var input_stock = $('#row5 #item_remain').val();

									var price = $('#row4 #item_rate');
									var input_price = $('#row5 #item_rate');

									if (stock != "") {
										if (parseInt(input_stock) <= parseInt(stock)) {
											alert("Stock cannot be less than the previous");
											$('#row5 #item_remain').val("");
											$('#row5 #item_remain').focus();
										}
									} else {
										alert("Please enter total stock first");
										$('#row5 #item_remain').val("");
										$('#row5 #item_remain').focus();
									}

									checkRate(price, input_price);

								}

								function validate_row6() {
									var stock = $('#row5 #item_remain').val();
									var input_stock = $('#row6 #item_remain').val();

									var price = $('#row5 #item_rate');
									var input_price = $('#row6 #item_rate');

									if (stock != "") {
										if (parseInt(input_stock) <= parseInt(stock)) {
											alert("Stock cannot be less than the previous");
											$('#row6 #item_remain').val("");
											$('#row6 #item_remain').focus();
										}
									} else {
										alert("Please enter total stock first");
										$('#row6 #item_remain').val("");
										$('#row6 #item_remain').focus();
									}

									checkRate(price, input_price);

								}

								function checkRate(price, input_price) {
									if (price != "") {
										if (parseInt(input_price.val()) >= parseInt(price.val())) {
											alert("Value exceeds total price");
											input_price.val("");
											input_price.focus();
										}
									} else {
										alert("Please enter total price first");
										input_price.val("");
										input_price.focus();
									}
								}
							</script>


							<div class="row text-center">
								<div class="col-lg-12">
									<button class="btn_custom" id="confirm_btn" style="margin-bottom: 10px; display: none;" type="submit" name="submit">Add Products</button>
								</div>
							</div>

							<input type="hidden" name="id" value="<?php echo $_SESSION['seller_Id']; ?>" required>
							<input type="hidden" name="item_arr" id="item_arr" required>
							<input type="hidden" name="rate_arr" id="rate_arr" required>
						</form>

						<div class="col-lg-12 text-center">
							<button class="btn_custom" id="validate_btn" type="button" style="margin:1% auto" onclick="validate_price()">Validate Pricing</button>
						</div>

						<script>
							function validate_price() {
								var item = [];
								var rate = [];
								var item_prev = 0;
								var rate_prev = 0;

								var success_one = true;
								var success_two = true;

								var row_count = $('input[name="item_remain"]').length;

								$('input[name="item_remain"]').each(function(i, elem) {
									if ($(elem).val() != "") {
										item.push($(elem).val());
									} else {
										alert("Fields cannot be empty");
										success_one = false;
									}

								});


								$('input[name="item_rate"]').each(function(i, elem) {
									if ($(elem).val() != "") {
										rate.push($(elem).val());
									} else {
										alert("Fields cannot be empty");
										success_two = false;
									}
								});

								if (item.length == row_count && rate.length == row_count) {
									success_one = true;
									success_two = true;
								}

								if (success_one && success_two) {
									$("#validate_btn").hide();
									$("#confirm_btn").show();
								}

								item.join(',');
								rate.join(',');

								$("#item_arr").val(item);
								$("#rate_arr").val(rate);

							}
						</script>

					</div>
				</div>

			</div>
			<!-- /.container-fluid -->

			<!-- Sticky Footer -->
			<footer class="sticky-footer">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>Copyright © Buzztro <?php echo date(Y); ?></span>
					</div>
				</div>
			</footer>

		</div>
		<!-- /.content-wrapper -->

	</div>
	<!-- /#wrapper -->

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<?php include 'scripts.php'; ?>

</body>

</html>