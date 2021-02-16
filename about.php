<?php 
include 'Admin_config/connection.php';
include 'header.php';
?>
<body>
	<?php include 'nav.php';
	?>
	<!-- about page -->
	<!-- welcome -->
	<div class="welcome">
		<div class="container">
			<!-- tittle heading -->
			<h3 class="tittle-w3l">Welcome to Buzztro
				<span class="heading-style">
					<i></i>
					<i></i>
					<i></i>
				</span>
			</h3>
			<!-- //tittle heading -->
			<div class="w3l-welcome-info">
				<div class="col-sm-6 col-xs-6 welcome-grids">
					<div class="welcome-img">
						<img src="images/about.jpg" class="img-responsive zoom-img" alt="">
					</div>
				</div>
				<div class="col-sm-6 col-xs-6 welcome-grids">
					<div class="welcome-img">
						<img src="images/about2.jpg" class="img-responsive zoom-img" alt="">
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="w3l-welcome-text">
				<p>BUZZTRO is an Wholesale E-Commerce Platform dedicated for Single Customer, where a Customer doesn't have to buy Product in Bulk Quantity, but still can Purchase the Product at an Wholesale Pricing.</p>
			</div>
		</div>
	</div>
	<!-- //welcome -->
	<!-- video -->
	<div class="about">
		<div class="container">
			<!-- tittle heading -->
			<h3 class="tittle-w3l">How Buzztro Works
				<span class="heading-style">
					<i></i>
					<i></i>
					<i></i>
				</span>
			</h3>
			<!-- //tittle heading -->
			<div class="about-tp">
				<div class="col-md-8 about-agileits-w3layouts-left">
					<iframe src="https://player.vimeo.com/video/15520702?color=ffffff&title=0&byline=0"></iframe>
				</div>
				<div class="col-md-4 about-agileits-w3layouts-right">
					<div class="img-video-about">
						<img src="images/videoimg2.png" alt="">
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- //video-->
	<!-- //about page -->
	<!-- newsletter -->
	<div class="footer-top">
		<div class="container-fluid">
			<div class="col-xs-12 agile-leftmk text-center">
				<h2>Become A Seller</h2>
				<p>Expand your business with us</p>
				<form action="./Admin_modules/add_enquiry.php" method="post">
					<div class="form-group">
						<input type="text" class="form-control" name="company_name" placeholder="Company Name" required="">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="mob_num" maxlength="10" placeholder="Mobile No" required="">
					</div>
					<div class="form-group">
						<input type="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="email" placeholder="Email" required="">
					</div>
					
					<input type="submit" name="about_submit" value="Submit">
				</form>
				<div class="newsform-w3l">
					<span class="fa fa-envelope-o" aria-hidden="true"></span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<!-- //newsletter -->
	<?php include 'footer.php'; ?>