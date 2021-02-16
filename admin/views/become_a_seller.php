<?php 

include 'header.php';
?>
<body class="bg-dark">

  <div class="container">
    <a href="../../reseller/views/login.php" style="text-decoration: none;"><button style="width: 50%;
    text-align: center;
    margin: 30px auto;" class="btn btn-primary btn-block" style="margin-bottom: 10px;">Already a seller</button></a>
   
    <div class="row">
       <div class="col-md-12">
         <div class="card mx-auto mt-5">
            <div class="card-header">Become A Seller</div>
            <div class="card-body">

              <form action="../Admin_modules/seller_registration.php" method="post" enctype="multipart/form-data">
                <p>(Fields marked <sup style="color: red;">*</sup> are mandatory)</p>
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="form-label-group"> 
                        <input type="text" id="name" name="name" class="form-control" pattern="[a-zA-Z\s]+" placeholder="Full Name" autofocus="autofocus" required>
                        <label for="name">Full Name<sup style="color: red;">*</sup></label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="form-label-group"> 
                        <input type="text" id="company" name="company" class="form-control" pattern="[a-zA-Z0-9\s]+" placeholder="Company Name" autofocus="autofocus" required>
                        <label for="company">Company Name<sup style="color: red;">*</sup></label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <div class="form-label-group"> 
                        <input type="text" id="mob" name="mob" class="form-control" pattern="[0-9]{10}" placeholder="Mobile Number" maxlength="10" autofocus="autofocus" required>
                        <label for="mob">Mobile Number<sup style="color: red;">*</sup></label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <div class="form-label-group"> 
                        <input type="text" id="alt_mob" name="alt_mob" class="form-control" pattern="[0-9]{10}" maxlength="10" placeholder="Alternate Mob. Number" autofocus="autofocus">
                        <label for="alt_mob">Alternate Mob. Number</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <div class="form-label-group"> 
                        <input type="email" id="mail" name="mail" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Email Address" autofocus="autofocus" autocomplete="off" required>
                        <label for="mail">Email Address<sup style="color: red;">*</sup></label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <textarea type="text" id="company_address" name="company_address" class="form-control" placeholder="Company Address *" autofocus="autofocus" rows="8" required></textarea>
                </div>

                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <select id="state" name="state" class="form-control" autofocus="autofocus" required>
                        <option value="" disabled hidden selected>Select State</option>
                        
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <select id="city" name="city" class="form-control" autofocus="autofocus" required>
                        <option value="" disabled hidden selected>Select City</option>
                        
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <div class="form-label-group"> 
                        <input type="text" id="landmark" name="landmark" class="form-control" pattern="[a-zA-Z\s]+" placeholder="Landmark" autofocus="autofocus" required>
                        <label for="landmark">Landmark<sup style="color: red;">*</sup></label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <div class="form-label-group"> 
                        <input type="text" id="pincode" name="pincode" class="form-control" maxlength="6" pattern="[0-9]{6}" placeholder="Pincode" autocomplete="new-password" autofocus="autofocus" required>
                        <label for="pincode">Pincode<sup style="color: red;">*</sup></label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-label-group"> 
                    <input type="text" id="gst_no" name="gst_no" class="form-control" pattern="[A-Z0-9]{15}" placeholder="GST Number" autofocus="autofocus" maxlength="15" required>
                    <label for="gst_no">GST Number<sup style="color: red;">*</sup></label>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="form-label-group">
                        <input type="password" id="pass" name="pass" class="form-control" placeholder="Password" pattern=".{8,}" autocomplete="new-password" required>
                        <label for="pass">Password<sup style="color: red;">*</sup></label>
                        
                        <i id="eye" class="fas fa-fw fa-eye-slash" onclick="toggle()" style="position: absolute; right: 10px; top: 18px; cursor: pointer;"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="form-label-group">
                        <input type="password" id="confirm_pass" name="confirm_pass" class="form-control" placeholder="Confirm Password" pattern=".{8,}" required>
                        <label for="confirm_pass">Confirm Password<sup style="color: red;">*</sup></label>
                      </div>
                    </div>
                  </div>
                </div>
                <br><br>
                <div class="form-group">
                  <p class="text-center">Please upload the required documents<br>(All Mandatory)<sup style="color: red;">*</sup></p>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <input type="file" id="aadhar" name="img_files[]" class="form-control" placeholder="Aadhar Card" accept="image/*" required>
                    <label for="aadhar">Aadhar Card<sup style="color: red;">*</sup></label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <input type="file" id="pan" name="img_files[]" class="form-control" placeholder="Pan Card Photo" accept="image/*" required>
                    <label for="pan">Pan Card Photo<sup style="color: red;">*</sup></label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <input type="file" id="gst" name="img_files[]" class="form-control" placeholder="GST Documents" accept="image/*" required>
                    <label for="gst">GST Documents<sup style="color: red;">*</sup></label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <input type="file" id="cheque" name="img_files[]" class="form-control" placeholder="Cancelled Cheque Photo" accept="image/*" required>
                    <label for="cheque">Cancelled Cheque Photo<sup style="color: red;">*</sup></label>
                  </div>
                </div>

                <button class="btn btn-primary btn-block" style="margin-bottom: 10px;" type="submit" name="submit">Register</button>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>

  <script>

    $(document).ready(function(){

      var state_array = [];

      $.ajax({
				url: "../Admin_modules/states.php",
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

					$('#state').append(stateHtml);
				}
			});

      $("#state").change(function() 
      {
        var state = $(this).val();
        var city_arr = [];
				var stateId = state_array.indexOf(state) + 1;
				if (state != '')

					$('#city').html("");

				$.ajax({
					url: "../Admin_modules/cities.php",
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
    
    
      
    function toggle()
    {
      var icon = document.getElementById('eye');
      var input = document.getElementById('pass');
      var attr = input.getAttribute('type');
      
      if (attr == "text")
      {
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
        input.setAttribute("type", "password");
      }
      else if(attr == "password")
      {
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
        input.setAttribute("type", "text");
      }
    }
    

  </script>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
