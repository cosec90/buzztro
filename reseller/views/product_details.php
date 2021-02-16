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

  <?php include 'navbar.php';?>

  <div id="wrapper">

  <?php include 'sidebar.php';?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <div class="breadcrumb_custom">
          <div class="row">
            <div class="col-lg-6 col-md-6">
              <p>Current User: <b><?php echo ($_SESSION['seller_name'])?></b></p>
            </div>
            <div class="col-lg-6 col-md-6">
              <p id="datetime" style="text-align: right;">
                <?php echo date("l").", ".date("d/m/Y");?>
              </p>
            </div>
          </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-edit"></i>&nbsp;&nbsp;
              Edit Product</div>
            <div class="card-body">
            	<?php
            	include '../Admin_controllers/product.php';

            	$curr_prod_id = $_GET['id'];

            	$curr_product = FETCH_PRODUCT_DETAILS($curr_prod_id);
            	?>
              <h5>Edit details for <b><?php echo $curr_prod_id;?></b></h5><br>
              
				
              <form action="../Admin_modules/edit_product.php" method="post" enctype="multipart/form-data">
                <p>(Fields marked <sup style="color: red;">*</sup> are mandatory)</p>
                <div class="row">
                  <div class="col-lg-2"></div>	
                  <div class="col-lg-8">
                    <div class="form-group">
                      <div class="form-label-group"> 
                        <input type="text" id="prod_name" name="prod_name" class="form-control" placeholder="Product Name" autofocus="autofocus" required value="<?php echo $curr_product['prod_name'];?>">
                        <label for="prod_name">Product Name<sup style="color: red;">*</sup></label>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2"></div>
                </div>

                <div class="row">
                  <div class="col-lg-2"></div>
                  <div class="col-lg-8">
                    <div class="form-group">
                      <div class="form-label-group"> 
                        <textarea type="text" id="prod_desc" name="prod_desc" class="form-control" rows="5" placeholder="Product Description" autofocus="autofocus" required><?php echo strip_tags($curr_product['prod_desc']);?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2"></div>
                </div>

               <input type="hidden" name="prod_id" value="<?php echo $curr_prod_id;?>">

                <div class="row text-center">
                  <div class="col-lg-12">
                    <button class="btn_custom" id="confirm_btn" style="margin-bottom: 10px;" type="submit" name="submit">Confirm Edit</button>
                  </div>
                </div>
              </form>

            </div>
        </div>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Buzztro <?php echo date(Y);?></span>
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

  <?php include 'scripts.php';?>

</body>

</html>
