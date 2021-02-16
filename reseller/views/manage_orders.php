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
              <p>Current User: <b><?php echo ($_SESSION['adm_name'])?></b></p>
            </div>
            <div class="col-lg-6 col-md-6">
              <p id="datetime" style="text-align: right;">
                <?php echo date("l").", ".date("d/m/Y");?>
              </p>
            </div>
          </div>
        </div>

        <?php 
              include '../Admin_modules/fetch_orders.php';
              //print_r($fetch_bookings);
        ?>
         
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-truck"></i>
            Orders</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Mobile No.</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total Amount</th>
                    <th>Shipment</th>
                    <th>Manifest</th>
                    <th>Invoice</th>
                    <th>Date & Time</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($fetch_orders as $key => $value) 
                  { ?>
                  
                  <tr>
                    <td><?php echo $value['user_name'];?></td>
                    <td><?php echo $value['user_mob'];?></td>
                    <td><?php echo $value['prod_name'];?></td>
                    <td><?php echo $value['order_quantity'];?></td>
                    <td><?php echo $value['order_amt'];?></td>
                    <td>
                      <?php
                        if ($value['shipment_label'] == null) 
                        {
                          echo "null";
                        }
                        else
                        {
                          ?>
                          <a href="../../api/docs.php?url=<?php echo $value['shipment_label'];?>" ><button class="btn_custom" style="width: 100%;">Label</button></a>
                        <?php
                        }
                      ?>
                    </td>
                    <td>
                      <?php
                        if ($value['manifest'] == null) 
                        {
                          echo "null";
                        }
                        else
                        {
                          ?>
                          <a href="../../api/docs.php?url=<?php echo $value['manifest'];?>" ><button class="btn_custom" style="width: 100%;">Manifest</button></a>
                        <?php
                        }
                      ?>
                    </td>
                    <td>
                      <?php
                        if ($value['invoice'] == null) 
                        {
                          echo "null";
                        }
                        else
                        { ?>
                          <a href="../../api/docs.php?url=<?php echo $value['invoice'];?>" ><button class="btn_custom" style="width: 100%;">Invoice</button></a>
                        <?php
                        }
                      ?>
                    </td>
                    <td><?php echo $value['date_time'];?></td>
                  </tr>
                  <!-- Modals -->
                  

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
