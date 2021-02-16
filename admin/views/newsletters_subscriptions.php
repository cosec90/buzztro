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

       <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-newspaper"></i>&nbsp;&nbsp;
            Newsletter Subscriptions</div>
          <div class="card-body">
          
          <div class="row">
            <div class="col-lg-4">
              <div class="form-group">
                <form action="../Admin_modules/excel_download.php" method="post"> 
                  <button type="submit" class="btn btn-primary" name="download_excel"><i class="fas fa-download"></i>&nbsp;&nbsp;Download Excel</button>
                </form>
              </div>
            </div>
          </div>
       </div>

            <!-- Table -->
            <div class="card-body">
              <?php include '../Admin_modules/fetch_newsletters.php';?>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>New Entries</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($fetch_newsletters as $key => $value) 
                    { ?>
                    
                    <tr>
                      <td><?php echo $value['mail'];?></td>
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
