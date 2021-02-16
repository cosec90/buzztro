<?php
include 'header.php';
include 'Admin_config/connection.php';
?>

<body>
	<?php include 'nav.php';
	?>
	<div class="modal-body modal-body-sub_agile" style="padding: 50px;">
		<div class="main-mailposi">
			<span class="fa fa-envelope-o" aria-hidden="true"></span>
		</div>
		<div class="modal_body_left modal_body_left1">
			<h3 class="agileinfo_sign">Sign Up</h3>
			<p>
				Come join Buzztro. Let's set up your Account.
			</p>
			<form action="Admin_modules/user_register.php" method="post">
				<div class="form-group">
					<input type="text" placeholder="Name" name="name" pattern="[A-Za-z\s]+" class="form-control" autocomplete="off" autofocus required="">
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="email" placeholder="E-mail" name="usr_mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" autofocus autocomplete="off" required="">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" placeholder="Mobile No" pattern="{10}" maxlength="10" name="mob" class="form-control" autofocus required="">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<textarea placeholder="Address Line 1" name="add1" class="form-control" rows="5" autofocus required=""></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<textarea placeholder="Address Line 2" name="add2" class="form-control" autofocus rows="5"></textarea>
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
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="password" id="pass" placeholder="Password" name="usr_pass" autofocus autocomplete="new-password" class="form-control" id="password1" required="">
							<i id="eye" class="fas fa-fw fa-eye-slash" onclick="toggle()" style="position: absolute; right: 30px; top: 10px; cursor: pointer;"></i>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="password" placeholder="Confirm Password" name="cnf_password" autofocus class="form-control" id="password2" required="">
							
						</div>
					</div>
				</div>

				<div class="form-group">
					<input type="checkbox" name="tnc" value="Agreed" required="">
					<label><a href="terms.php" target="_blank">Terms & Conditions</a></label>
				</div>

				<input type="submit" name="register_user" value="Sign Up">
			</form>
			<p>
				<a href="terms.php">By clicking register, You agree to our Terms & Conditions</a>
			</p>
		</div>
	</div>
	<script>
		$(document).ready(function() {

			var state_array = [];

			$.ajax({
				url: "./Admin_modules/states.php",
				dataType:"json",
				success: function(data) {
					for(var i=0; i<data.length; i++){
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
					data:{state_id: stateId},
					success: function(data) {
						
						for(var i=0; i<data.length; i++){
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



		function toggle() {
			var icon = document.getElementById('eye');
			var input = document.getElementById('pass');
			var attr = input.getAttribute('type');

			if (attr == "text") {
				icon.classList.remove('fa-eye');
				icon.classList.add('fa-eye-slash');
				input.setAttribute("type", "password");
			} else if (attr == "password") {
				icon.classList.remove('fa-eye-slash');
				icon.classList.add('fa-eye');
				input.setAttribute("type", "text");
			}
		}
	</script>

	<?php include 'footer.php'; ?>