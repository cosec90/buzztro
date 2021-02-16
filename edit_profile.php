<?php
include 'Admin_config/connection.php';
include 'header.php';

include 'Admin_controllers/slider.php';
include 'Admin_controllers/products.php';
?>
<style type="text/css">
	.settings_row a {
		color: #000;
	}

	.settings_card {
		background: #e6e6e6;
		border: 0;
		width: 60%;
		color: #0f0f0f;
		border-radius: 8px;
		padding: 25px 35px;
		margin: 30px 0 50px;
		font-size: 18px;
	}
</style>

<body onload="showModal()">

	<?php include 'nav.php'; ?>

	<!-- Categorized cards -->
	<section>
		<div class="container">
			<div class="row settings_row text-center">
				<div class="col-md-6 col-sm-6 col-6">
					<a href="" data-toggle="modal" data-target="#editprof"><button class="settings_card"><i class="fas fa-edit"></i>&nbsp;&nbsp;Edit Profile</button></a>
				</div>
				<div class="col-md-6 col-sm-6 col-6">
					<a href="" data-toggle="modal" data-target="#add_addr"><button class="settings_card"><i class="fas fa-map"></i>&nbsp;&nbsp;Add address</button></a>
				</div>
			</div>
		</div>
	</section>
	<!--end Categorized cards-->



	<!-- Edit Profile -->
	<div class="modal fade" id="editprof" tabindex="-1" role="dialog">
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
						<h3 class="agileinfo_sign">Edit Profile</h3>
						<form action="Admin_modules/edit_profile_module.php" method="post">

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" placeholder="Name" name="name" pattern="[A-Za-z\s]+" class="form-control" value="<?php echo $_SESSION['user_name'] ?>" autocomplete="off" autofocus required="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="email" placeholder="E-mail" name="usr_mail" value="<?php echo $_SESSION['user_mail'] ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" autofocus autocomplete="off" required="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<select name="usr_state" id="usr_state" class="form-control">
											<option disabled hidden selected>Select State</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<select name="usr_city" class="form-control" id="city">
											<option disabled hidden selected>Select City</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<textarea placeholder="Address Line 1" name="add1" class="form-control" rows="5" autofocus required=""><?php echo $_SESSION['add1']; ?></textarea>
							</div>

							<div class="form-group">
								<textarea placeholder="Address Line 2" name="add2" class="form-control" autofocus rows="5"><?php echo $_SESSION['add2']; ?></textarea>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" placeholder="Landmark" value="<?php echo $_SESSION['landmark'] ?>" name="landmark" class="form-control" autofocus required="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" placeholder="Pincode" value="<?php echo $_SESSION['pincode'] ?>" name="pincode" pattern="[0-9]{6}" maxlength="6" class="form-control" autofocus required="">
									</div>
								</div>
							</div>
							<input type="submit" name="edit_user" value="Edit User">
						</form>

					</div>
				</div>
			</div>
			<!-- //Modal content-->
		</div>
	</div>
	<!-- //Edit Profile -->

	<!-- Add Address -->
	<div class="modal fade" id="add_addr" tabindex="-1" role="dialog">
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
						<h3 class="agileinfo_sign">Add Address</h3>
						<form action="Admin_modules/add_address.php" method="post">

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" placeholder="Name" readonly name="name" pattern="[A-Za-z\s]+" class="form-control" value="<?php echo $_SESSION['user_name'] ?>" autocomplete="off" autofocus required="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<select name="usr_state" id="usr_state" class="form-control">
											<option disabled hidden selected>Select State</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<select name="usr_city" class="form-control" id="city">
									<option disabled hidden selected>Select City</option>
								</select>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" placeholder="Landmark" name="landmark" class="form-control" autofocus required="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" placeholder="Pincode" name="pincode" pattern="[0-9]{6}" maxlength="6" class="form-control" autofocus required="">
									</div>
								</div>
							</div>
							<div class="form-group">
								<textarea placeholder="Address Line " name="add1" class="form-control" autofocus rows="5"></textarea>
							</div>
							<!-- <div class="form-group">
								<input type="checkbox" name="tnc" value="Agreed" required="">
								<label>Terms & Conditions</label>
							</div> -->

							<input type="submit" name="register_user" value="Add Address">
						</form>
						<!-- <p>
							<a href="terms.php">By clicking register, You agree to our Terms & Conditions</a>
						</p> -->
					</div>
				</div>
			</div>
			<!-- //Modal content-->
		</div>
	</div>
	<!-- //Add Address -->
	<script>
		$(document).ready(function() {

			var state_array = [];

			$.ajax({
				url: "./Admin_modules/states.php",
				dataType: "json",
				success: function(data) {
					for (var i = 0; i < data.length; i++) {
						state_array.push(data[i]);
					}
					var stateHtml = '';
					state_array = state_array.sort();

					$.each(state_array, function(intValue, currentElement) {
						stateHtml +=
							'<option value="' + currentElement + '">' + currentElement + '</option>'
					});

					$('#usr_state').append(stateHtml);
				}
			});

			$("#usr_state").change(function() {
				var state = $(this).val();
				var city_arr = [];
				var stateId = state_array.indexOf(state) + 1;
				if (state != '')

					$('#city').html("");

				$.ajax({
					url: "./Admin_modules/cities.php",
					method: "POST",
					dataType: "json",
					data: {
						state_id: stateId
					},
					success: function(data) {

						for (var i = 0; i < data.length; i++) {
							city_arr.push(data[i]);
						}
						var cityHtml = '';

						$.each(city_arr, function(intValue, currentElement) {
							cityHtml +=
								'<option value="' + currentElement + '">' + currentElement + '</option>'
						});

						$('#city').append(cityHtml);
					}
				});
			});

		});
	</script>

	<?php include 'footer.php'; ?>