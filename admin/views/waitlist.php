<?php

date_default_timezone_set("Asia/Kolkata");

error_reporting(0);
session_start();

// [adm_Id] => adm_3 
// [adm_name] => Name 
// [adm_username] => username 
// [adm_password] => Pass 
// [adm_status] => Active 
// [adm_type] => Super

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

        <?php include '../Admin_modules/fetch_waitlist.php';?>
         

        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-clock"></i>
            Waitlist</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>No. of people waiting</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($waitlist as $key => $value) 
                  { ?>
                  
                  <tr>
                    <td><?php echo $value['prod_id'];?></td>
                    <td><?php echo $value['prod_name'];?></td>
                    <td><?php echo $value['total'];?></td>
                    <td class="text-center">
                        <a href="single_waitlist.php?id=<?php echo $value['prod_id'];?>" ><button class="btn_custom" style="width: 100%;"><i class="fas fa-fw fa-eye"></i>&nbsp;&nbsp;View</button></a>
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
