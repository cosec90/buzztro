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
              include '../Admin_modules/fetch_users.php';
        ?>
         

        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-users"></i>
            User's Info</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email ID</th>
                    <th>Mobile No.</th>
                    <th>Full Address</th>
                    <th>Last Login</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($fetch_users as $key => $value) 
                  { ?>
                  
                  <tr>
                    <td><?php echo $value['user_name'];?></td>
                    <td><?php echo $value['user_mail'];?></td>
                    <td><?php echo $value['user_mob'];?></td>
                    <td><?php echo $value['add1'].'<br>'.$value['add2'].'<br>Landmark: '.$value['landmark'].'<br>'.$value['pincode'];?></td>
                    <td><?php echo $value['last_login'];?></td>
                    <td class="text-center">
                      <?php 
                        if ($value['user_status'] == 'Active') 
                        { ?>
                        <button type="submit" id="<?php echo $value['user_id'];?>" class="btn_custom" data-toggle="modal" data-target="#blk_modal<?php echo $value['user_id'];?>" style="width: 100%;">Block</button>
                        <?php }
                        elseif ($value['user_status'] == 'Blocked') 
                        { ?>
                          <button type="submit" id="<?php echo $value['user_id'];?>" class="btn_custom" data-toggle="modal" data-target="#unblk_modal<?php echo $value['user_id'];?>" style="width: 100%;">Unblock</button>
                        <?php }
                        else
                        {
                          echo "Seller is ".$value['user_status'];
                        }
                      ?>
                    </td>
                  </tr>
                  <!-- Modals -->
                  <div class="modal fade" id="blk_modal<?php echo $value['user_id'];?>" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Confirm blocking User?</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="../Admin_modules/auth_users.php?id=<?php echo $value['user_id'];?>&&name=<?php echo $value['user_name'];?>&&mail=<?php echo $value['user_mail'];?>" method="post">

                          <p>Reason for Blocking <sup style="color: red">*</sup></p>
                    
                          <div class="form-group">
                            <div class="form-label-group"> 
                              <textarea type="text" id="reason" name="reason" class="form-control" placeholder="Reason" autofocus="autofocus" required="true"></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn_custom" name="block">Confirm</button></form>
                          <button class="btn_custom" type="button" data-dismiss="modal">Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="modal fade" id="unblk_modal<?php echo $value['user_id'];?>" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Unblock user confirm?</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-footer">
                          <form action="../Admin_modules/auth_users.php?id=<?php echo $value['user_id'];?>&&name=<?php echo $value['user_name'];?>&&mail=<?php echo $value['user_mail'];?>" method="post"><button type="submit" class="btn_custom" name="unblock">Confirm</button></form>
                          <button class="btn_custom" type="button" data-dismiss="modal">Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
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
