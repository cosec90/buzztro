<?php 
include 'Admin_config/connection.php';
include 'header.php';
?>
<body>
	<?php include 'nav.php';
	?>
	<!-- contact page -->
	<div class="contact-w3l">
		<div class="container">
			<!-- tittle heading -->
			<h3 class="tittle-w3l">Contact Us
				<span class="heading-style">
					<i></i>
					<i></i>
					<i></i>
				</span>
			</h3>
			<!-- //tittle heading -->
			<!-- contact -->
			<div class="contact agileits">
				<div class="contact-agileinfo">
					<div class="contact-form wthree">
						<form action="./Admin_modules/add_enquiry.php" method="post">
							<div class="">
								<?php
								if (isset($_SESSION['user_name'])) 
								{ ?>
									<input type="text" name="name" placeholder="Name" value="<?php echo $_SESSION['user_name']; ?>" required="" readonly>
								<?php
								}
								else
								{ ?>
									<input type="text" name="name" placeholder="Name" required="">
								<?php
								}
								?>
								
							</div>
							<div class="">
								<input class="text" type="text" name="subject" placeholder="Subject" required="">
							</div>
							<div class="">
								<?php
								if (isset($_SESSION['user_name'])) 
								{ ?>
									<input class="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?php echo $_SESSION['user_mail']; ?>" name="email" placeholder="Email" required="" readonly>
								<?php
								}
								else
								{ ?>
									<input class="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="email" placeholder="Email" required="">
								<?php
								}
								?>
								
							</div>
							<div class="">
								<textarea placeholder="Message" name="message" required=""></textarea>
							</div>
							<input type="submit" name="submit" value="Submit">
						</form>
					</div>
				</div>
			</div>
			<!-- //contact -->
		</div>
	</div>
	
	<?php include 'footer.php'; ?>