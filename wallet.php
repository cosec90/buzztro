<?php include 'header.php';
include './Admin_controllers/wallet.php';
?>

<body>
	
	<?php include 'nav.php';?>

	<div class="container">
		<!-- Add Money Row -->
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<?php
				if (isset($_GET['success'])) 
				{ ?>
					<div class="alert alert-success text-center" role="alert">
					  <h4>Your payment was successful</h4>
					</div>
				<?php
				} 
				elseif(isset($_GET['failed']))
				{ ?>
					<div class="alert alert-danger text-center" role="alert">
					  <h4>Payment failed. Please try again</h4>
					</div>
				<?php
				}
				?>
					
				<div class="wallet_bal text-center">
					<?php include './Admin_modules/fetch_wallet.php'; ?>

					<?php
					if (!isset($_SESSION['user_id'])) 
					{ ?>
						<h4 style="color: red">Login to see wallet balance</h4>
					<?php
					}
					else
					{ ?>
						<h4>Current Balance: <i class="fa fa-inr"></i>&nbsp;<?php echo $wallet;?></h4>
					
						<button class="button button_class_custom" type="button" class="add_button" data-toggle="modal" data-target="#add_wallet">Add Money</button>
					<?php
					}
					?>
				</div>
			</div>

			<div class="modal fade" id="add_wallet" role="dialog">
			    <div class="modal-dialog" role="document" style="max-width: 850px;">
			      <div class="modal-content">
			        <div class="modal-header">
			          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
			            <span aria-hidden="true">×</span>
			          </button>
			        </div>
			        <div class="modal-body text-center">
			          <h6 style="margin-bottom: 28px; font-size: 13px;">(Fields marked <span style="color: red">*</span> are mandatory)</h6>
			          <form action="./Admin_modules/pay.php" method="post">
			            <div class="row"> 
			                <div class="form-group">
			                  <div class="form-label-group">
			                  	<label for="amt">Enter Amount<sup style="color: red;">*</sup></label>
			                    <input type="text" id="amt" name="amt" class="form-control" autofocus required style="width: 50%; margin: auto;">
			                  </div>
			                </div>
			            </div>
			        </div>
			        <div class="modal-footer text-center">
			            <button type="submit" class="btn btn-success"  name="submit" data-toggle="modal" data-target="#confirm">Submit</button>
			          </form>
			        </div>
			      </div>
			    </div>
			  </div>
		</div>
	</div>

<?php include 'footer.php'; ?>