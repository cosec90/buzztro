	<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col-md-5 col-lg-5 col-sm-12 col-12">
					
						<div class="newsletter_title_container">
							<div class="newsletter_icon"><img src="images/paper-plane.png" alt=""></div>
							<div class="newsletter_title">Sign up for Newsletter</div>

						</div>
				</div>

						<div class="col-md-7 col-lg-7 col-sm-12 col-12">
							<div class="newsletter_content clearfix">
							<form action="./Admin_modules/subscribe_newsletter.php" class="newsletter_form" method="post">
								<input type="email" class="newsletter_input" name="newsletter_mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required="required" placeholder="Enter your email address">
								<button type="submit" name="newsletter_button" class="newsletter_button">Subscribe</button>
							</form>
						</div>
						</div>
			</div>
		</div>
	</div>

<!-- Footer -->

	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<div class="logo_container text-center">
						<div class="logo"><a href="index.php"><img src="images/Buzztro Logo PNG (Transparent).png" style="width: 80%;"></a></div>
					</div>
				</div>
				<div class="col-lg-8"></div>
				<div class="clearfix"></div>

				<div class="col-lg-6 footer_col">
					<div class="footer_column footer_contact">
						<div class="col-lg-6">
							<div>
								<div class="footer_title">Got Question? Call Us</div>
								<div class="footer_phone">+91 70218 52578</div>
								<div class="footer_phone">+91 98206 70734</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="footer_contact_text">
								<p>EC-69,B-002, Mangal Villa</p>
								<p>Evershine city Vasai (East), 401208</p>
								<p>Mumbai MH, India</p>
							</div>
						</div>
						
						<div class="footer_social">
							<ul>
								<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="#"><i class="fab fa-twitter"></i></a></li>
								<li><a href="#"><i class="fab fa-google"></i></a></li>	
							</ul>
						</div>
						
					</div>
				</div>

				<div class="col-lg-4">
					<div style="display: flex; flex-direction: row; align-items: center; justify-content: space-between;">
						<div class="footer_column">
							<div class="footer_title">Find it Fast</div>
							<ul class="footer_list" type="none">
								<?php
								foreach ($firsthalf as $key => $value) 
								{ ?>

									<li><a href="category_page.php?cat=<?php echo $value['cat_name'];?>"><?php echo $value['cat_name'];?></a></li>
								<?php
								}
								?>
							</ul>
						</div>
						<div class="footer_column">
							<ul class="footer_list footer_list_2" type="none">
								<?php
								foreach ($secondhalf as $key => $value) 
								{ ?>
									<li><a href="category_page.php?cat=<?php echo $value['cat_name'];?>"><?php echo $value['cat_name'];?></a></li>
								<?php
								}
								?>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-lg-2">
					<div class="footer_column">
						<div class="footer_title">Legals</div>
						<ul class="footer_list" type="none">
							<li><a href="privacy.php">Privacy Policy</a></li>
							<li><a href="terms.php">Terms & Conditions</a></li>
							<li><a href="refunds.php">Cancellations & Refunds</a></li>
							<li><a href="faqs.php">FAQs</a></li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</footer>

	<!-- Copyright -->

	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col">
					
					<div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
						<div class="copyright_content" style="color: #000000;"> 
						Copyright &copy;<?php echo date('Y');?> All rights reserved  || Developed with <i class="fa fa-heart" aria-hidden="true" style="color: red;"></i> by <a href="http://www.pranaydas.in" target="_blank" style="color: #000000;">Pranay Das</a> & <a href="http://www.instagram.com/shahid.mansuri.99" target="_blank" style="color: #000000;">Shahid Mansuri</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a href="#" class="gotoTop" id="toTop"><i class="fas fa-sort-up"></i></a>
</div>
	<!-- //copyright -->

	<!-- js-files -->
	<!-- jquery -->
	<script src="js/jquery-2.1.4.min.js"></script>
	<!-- //jquery -->

	<!-- popup modal (for signin & signup)-->
	<script src="js/jquery.magnific-popup.js"></script>
	<script>
		$(document).ready(function () {
			$('.popup-with-zoom-anim').magnificPopup({
				type: 'inline',
				fixedContentPos: false,
				fixedBgPos: true,
				overflowY: 'auto',
				closeBtnInside: true,
				preloader: false,
				midClick: true,
				removalDelay: 300,
				mainClass: 'my-mfp-zoom-in'
			});

		});
	</script>
	<!-- Large modal -->
	<!-- <script>
		$('#').modal('show');
	</script> -->
	<!-- //popup modal (for signin & signup)-->

	<!-- cart-js -->
	<script src="js/minicart.js"></script>
	<script>
		paypalm.minicartk.render(); //use only unique class names other than paypalm.minicartk.Also Replace same class name in css and minicart.min.js

		paypalm.minicartk.cart.on('checkout', function (evt) {
			var items = this.items(),
				len = items.length,
				total = 0,
				i;

			// Count the number of each item in the cart
			for (i = 0; i < len; i++) {
				total += items[i].get('quantity');
			}

			// if (total < 3) {
			// 	alert('The minimum order quantity is 3. Please add more to your shopping cart before checking out');
			// 	evt.preventDefault();
			// }
		});
	</script>
	<!-- //cart-js -->

	<!-- price range (top products) -->
	<script src="js/jquery-ui.js"></script>
	<script>
		//<![CDATA[ 
		$(window).load(function () {
			$("#slider-range").slider({
				range: true,
				min: 0,
				max: 9000,
				values: [50, 6000],
				slide: function (event, ui) {
					$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
				}
			});
			$("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));

		}); //]]>
	</script>
	<!-- //price range (top products) -->

	<!-- imagezoom -->
	<script src="js/imagezoom.js"></script>
	<!-- //imagezoom -->

	<!-- FlexSlider -->
	<script src="js/jquery.flexslider.js"></script>
	<script>
		// Can also be used with $(document).ready()
		$(window).load(function () {
			$('.flexslider').flexslider({
				animation: "slide",
				controlNav: "thumbnails"
			});
		});
	</script>
	<!-- //FlexSlider-->

	<!-- flexisel (for special offers) -->
	<script src="js/jquery.flexisel.js"></script>
	<script>
		$(window).load(function () {
			$("#flexiselDemo1").flexisel({
				animation: "slide",
    			animationLoop: true,
				visibleItems: 4,
				animationSpeed: 1000,
				autoPlay: true,
				autoPlaySpeed: 3000,
				pauseOnHover: true,
				mousewheel: true,
    			rtl: true
			});

		});
	</script>
	<!-- //flexisel (for special offers) -->

	<!-- password-script -->
	<script>
		window.onload = function () {
			document.getElementById("password1").onchange = validatePassword;
			document.getElementById("password2").onchange = validatePassword;
		}

		function validatePassword() {
			var pass2 = document.getElementById("password2").value;
			var pass1 = document.getElementById("password1").value;
			if (pass1 != pass2)
				document.getElementById("password2").setCustomValidity("Passwords Don't Match");
			else
				document.getElementById("password2").setCustomValidity('');
			//empty string means no validation error
		}
	</script>
	<!-- //password-script -->

	<!-- smoothscroll -->
	<script src="js/SmoothScroll.min.js"></script>
	<!-- //smoothscroll -->

	<!-- start-smooth-scrolling -->
	<script src="js/move-top.js"></script>
	<script src="js/easing.js"></script>
	<script>
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();

				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script>
	<!-- //end-smooth-scrolling -->

	<!-- smooth-scrolling-of-move-up -->
	<script>
		$(document).ready(function () {
			/*
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
			};
			*/
			$().UItoTop({
				easingType: 'easeOutQuart'
			});

		});
	</script>
	<!-- //smooth-scrolling-of-move-up -->

	<!-- for bootstrap working -->
	
	<script src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/flexSlider.js"></script>
	<script type="text/javascript" src="js/jquery.flexslider.js"></script>
	<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
	<script type="text/javascript" src="js/owl.carousel.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
	<script type="text/javascript" src="js/cookie.js"></script>
	<script src="https://kit.fontawesome.com/a165ea29e6.js" crossorigin="anonymous"></script>
	<!-- //for bootstrap working -->
	<!-- //js-files -->


</body>

</html>