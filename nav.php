<!-- header-bot-->
	<div class="header-bot">
		<div class="header-bot_inner_wthreeinfo_header_mid">
			<!-- header-bot-->
			<div class="col-md-4 logo_agile">
				<h1>
					<a href="index.php">
						<img src="images/logo.png" alt=" " style="width: 55%;">
					</a>
				</h1>
			</div>
			<!-- header-bot -->
			<div class="col-md-8 header">
				<!-- header lists -->
				<ul>
					<?php
					error_reporting(0);
					session_start();
					if (!isset($_SESSION['user_id'])) 
						{ ?>

						<li>
							<a href="#" data-toggle="modal" data-target="#myModal1">
								<span class="fa fa-unlock-alt" aria-hidden="true"></span> Sign In </a>
						</li>
						<li>
							<a href="sign_up.php">
								<span class="fa fa-pencil-square-o" aria-hidden="true"></span> Sign Up </a>
						</li>
					<?php
					}

					if (isset($_SESSION['user_id'])) 
					{ 

					?>
					
						<span>Welcome, <?php echo $_SESSION['user_name'];?></span>
					
					<?php
					}

					?>
				</ul>
				<!-- //header lists -->
				<!-- search -->
				<div class="agileits_search">
					<form action="#" method="post" style="width: 80%; display: flex;">
						<input name="Search" id="searchbar" type="search" placeholder="How can we help you today?" required="">
						<button type="button" name="search" id="search" class="btn btn-default" aria-label="Left Align">
							<span class="fa fa-search" aria-hidden="true"> </span>
						</button>
					</form>
				
				<!-- //search -->
				<!-- cart details -->
				<!-- <div class="top_nav_right">
					<div class="wthreecartaits wthreecartaits2 cart cart box_1">
						<form action="#" method="post" class="last">
							<input type="hidden" name="cmd" value="_cart">
							<input type="hidden" name="display" value="1">
							<button class="w3view-cart" type="submit" name="submit" value="">
								<i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
							</button>
						</form>
					</div>
				</div> -->
				<?php
				if (isset($_SESSION['user_id'])) 
				{ 

				?>
				
					<a href="booking.php"><button class="w3view-cart"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
				</button></a>
				
				<?php
				}
				?>
				
				</div>
				<!-- //cart details -->
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<!-- signin Model -->
	<!-- Modal1 -->
	<div class="modal fade" id="myModal1" tabindex="-1" role="dialog">
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
						<h3 class="agileinfo_sign">Sign In </h3>
						<p>
							Sign In now, Let's start your shopping. Don't have an account?
						</p>
						<form action="Admin_modules/user_login.php" method="post">
							<div class="form-group">
								<input type="text" placeholder="Mobile Number" name="sign_mob" pattern="{10}" maxlength="10" class="form-control" autocomplete="off" autofocus required="">
							</div>
							<div class="form-group">
								<input type="password" placeholder="Password" name="sign_pass" class="form-control" autocomplete="new-password" autofocus required="">
							</div>
							<input type="submit" name="sign_submit" value="Sign In">
						</form>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<!-- //Modal content-->
		</div>
	</div>
	<!-- //Modal1 -->
	
	<div class="ban-top" id="navigation">
		<div class="container">
			<div class="agileits-navi_search">
				
				<div class="nav_container"> 
					<span class="nav-stylehead">Category&nbsp;&nbsp;&#9660;</span>
					<ul class="nav_cats">
						<?php 
						include 'Admin_controllers/category.php'; 
						include 'Admin_modules/fetch_categories.php';

						$len = count($prod_cat);

						$firsthalf = array_slice($prod_cat, 0, $len / 2);
						$secondhalf = array_slice($prod_cat, $len / 2);

						foreach ($prod_cat as $key => $value) 
						{ 
						?>
							<li><a href="category_page.php?cat=<?php echo $value['cat_name'];?>"><?php echo $value['cat_name'];?></a></li>
						<?php
						}	
						?>
						
					</ul>
				</div>
				
				<!-- <select id="agileinfo-nav_search" name="agileinfo_search" required="">
					<li><option disabled hidden selected>Select Category</option></li>
				
				</select> -->
			</div>
			<div class="top_nav_left">
				<nav class="navbar navbar-default">
					<div class="container-fluid">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
							    aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
							 <?php
						          $link = $_SERVER['PHP_SELF'];
						          $link_array = explode('/',$link);
						          $page = end($link_array);
						      ?>
							<ul class="nav navbar-nav menu__list">
								<li <?php if($page=="index.php") { ?>  class="active" <?php } else { ?>  class="" <?php } ?> >
									<a class="nav-stylehead" href="index.php">Home</a>
								</li>
								<li <?php if($page=="about.php") { ?>  class="active" <?php } else { ?>  class="" <?php } ?> >
									<a class="nav-stylehead" href="about.php">About Us</a>
								</li> 
								<li <?php if($page=="blog.php") { ?>  class="active" <?php } else { ?>  class="" <?php } ?> >
									<a class="nav-stylehead" href="blog.php">Blogs</a>
								</li>
								<li <?php if($page=="contact.php") { ?> class="active" <?php } else { ?>  class="" <?php } ?> >
									<a class="nav-stylehead" href="contact.php">Contact</a>
								</li>
								
								<?php
								if (isset($_SESSION['user_id'])) 
								{ ?>
									
									<li <?php if($page=="edit_profile.php") { ?>  class="active dropdown" <?php } else { ?>  class="dropdown" <?php } ?>>
					                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">My Account<b class="caret"></b></a>
					                    <ul class="dropdown-menu">
					                        <li>
					                        	<a href="edit_profile.php">Settings</a>
					                        </li>
					                        <li><a href="order_history.php">Order History</a></li>
					                        <li><a href="booking.php">My Bookings</a></li>
					                        <li><a href="wallet.php">Wallet</a></li>
					                        <li><a href="logout.php?logout" href="#">Sign Out</a></li>
					                    </ul>
					                </li>
								<?php
								}
								?>
								<li class="">
									<a href="http://www.buzztro.com/admin/views/become_a_seller.php" target="_blank" class="nav-stylehead" href="#">Become a Seller</a>
								</li>
							</ul>
						</div>
					</div>
				</nav>
			</div>
		</div>
	</div>
	<!-- //navigation -->

	<script>
		$(document).ready(function() {
			
			$("#search").click(function(){
				var key = $("#searchbar").val();

				if (key != "") 
				{
					window.location.href = "search_results.php?query="+key;
				} else {
					alert("Please enter a valid product");
				}
			  	
			});

		});
	</script>