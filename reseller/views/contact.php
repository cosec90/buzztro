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
              <i class="fas fa-fw fa-user-cog"></i>&nbsp;&nbsp;
              Contact Buzztro</div>
            <div class="card-body">

              <form action="../Admin_modules/add_enquiry.php" method="post" enctype="multipart/form-data">
                <p>(Fields marked <sup style="color: red;">*</sup> are mandatory)</p>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <div class="form-label-group"> 
                        <textarea type="text" id="enquiry" name="enquiry" class="form-control" rows="5" placeholder="Enter Message" autofocus="autofocus" required></textarea>
                      </div><br>
                      <b><p class="text-center">Or call us on <i class="fas fa-fw fa-phone"></i>&nbsp;&nbsp;+91 70218 52578 or +91 98206 70734</p></b>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-4">
                    <button class="btn_custom" style="margin: 20px 0;" type="submit" name="submit">Submit Query</button>
                  </div>
                  <div class="col-lg-4">
                  </div>
                  <div class="col-lg-4">
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
