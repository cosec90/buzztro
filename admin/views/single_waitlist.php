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

        <?php 
        include '../Admin_controllers/waitlist.php';
        $item = $_GET['id'];

        $fetch_waitlist = FETCH_ALL_WAITLIST($item);
        ?>
         

        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-users"></i>
            Waitlist Users</div>
          <div class="card-body">
              <div class="table-responsive">
                <p>Product ID: <?php echo $item ?></p>

               <table border="1" class="table">
                  <thead>
                    <th>Name</th>
                    <th>Mobile Number</th>
                    <th>Mail ID</th>
                  </thead>
                  <tbody>
                    
                    <?php
                    
                      foreach ($fetch_waitlist as $key => $value) 
                      { 
                        ?>

                        <tr>
                          <td>
                            <p><?php echo $value['user_name'];?></p>
                          </td>
                          <td>
                            <p><?php echo $value['user_mob'];?></p>
                          </td>
                          <td>
                            <p><?php echo $value['user_mail'];?></p>
                          </td>
                        </tr>

                      <?php 

                      }

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
