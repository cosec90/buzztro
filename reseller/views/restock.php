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

        <?php include '../Admin_modules/fetch_products.php';?>
         

        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-users"></i>
            Product Info</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Total Stock</th>
                    <th>Current Stock</th>
                    <th>Action</th>
                    <th>Restock</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($fetch_products as $key => $value) 
                  { ?>
                  
                  <tr>
                    <td><?php echo $value['prod_id'];?></td>
                    <td><?php echo $value['prod_name'];?></td>
                    <td><?php echo $value['prod_stock'];?></td>
                    <td><?php echo $value['stock'];?></td>
                    <td>
                      <div class="row">
                        <div class="col-lg-6">
                          <a href="product_details.php?id=<?php echo $value['prod_id'];?>"><button type="submit" name="prod_details" class="btn_custom" style="width: 100%;">Edit Product</button></a>
                        </div>
                        <div class="col-lg-6">
                          <a href="add_products.php?id=<?php echo $value['prod_id'];?>"><button type="submit" class="btn_custom" style="width: 100%;">Duplicate</button></a>
                        </div>
                      </div>
                    </td>
                    <td class="text-center">
                      <?php 
                        if ($value['stock'] == 0) 
                        { ?>
                        <a href="pricing.php?id=<?php echo $value['prod_id'];?>"><button type="submit" name="item_pricing" class="btn_custom" style="width: 100%;">Restock</button></a>
                        <?php }
                        else
                        { ?>
                          <p>Product restock limit hasn't reached</p>
                        <?php }
                      ?>
                    </td>
                  </tr>

                <?php }

                ?>

                </tbody>
              </table>
            </div>
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
