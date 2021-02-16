<?php

date_default_timezone_set("Asia/Kolkata");

error_reporting(0);
session_start();

if (!isset($_SESSION['adm_Id'])) {
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

        <?php include '../Admin_modules/fetch_products.php';?>
         

        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-users"></i>
            Manage Deals of the day</div>
          <div class="card-body">
            <div class="table-responsive" style="overflow-x: hidden;">
              <form action="../Admin_modules/deals_select.php" method="post">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Image</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($view_products as $key => $value) 
                    { ?>
                    
                    <tr>
                      <td><?php echo $value['prod_name'];?></td>
                      <td class="text-center">
                        <img src="../images/all_products/<?php echo $value['prod_id'].'/'.$value['file1'];?>" style="width: 15%;">
                      </td>
                      <td class="text-center">
                          <input type="checkbox" name="deals_sel[]" value="<?php echo $value['prod_id'];?>" style="transform: scale(1.8); padding-top: 15px;">
                      </td>
                    </tr>

                  <?php }

                  ?>

                  </tbody>
                </table>

                <button class="btn_custom" style="margin-top: 25px; padding: 12px 20px;" name="submit">Submit</button>
              </form>
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
