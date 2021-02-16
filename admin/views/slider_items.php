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

       <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-stream"></i>&nbsp;&nbsp;
              Manage Slider Items</div>
            <div class="card-body">

              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Slider Number</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include '../Admin_modules/fetch_slider.php';
                  foreach ($fetch_slider_data as $key => $value) 
                  { ?>
                  
                  <tr>
                    <td><?php echo $value['sl_name'];?></td>
                    <td style="width: 50%; text-align: center;">
                      <?php 
                        if($value['sl_img'] == null)
                        {
                          echo "Image Not Set";
                        }
                        else
                        { ?>
                          <img src="../images/website_config/slider_items/<?php echo $value['sl_img'];?>" style="width: 65%;">
                        <?php
                        }
                      ?>    
                    </td>
                    <td style="display: flex; flex-direction: row;">
                        <button type="submit" id="<?php echo $value['sl_id'];?>" class="btn_custom" data-toggle="modal" data-target="#set_slider<?php echo $value['sl_id'];?>" style="width: 50%; margin: 15px;">Change</button>
                        
                        <?php 
                        if($value['sl_img'] != null)
                        { ?>
                          <button type="submit" id="<?php echo $value['sl_id'];?>" class="btn_custom" data-toggle="modal" data-target="#remove_slider<?php echo $value['sl_id'];?>" style="width: 50%; margin: 15px;">Remove</button>
                        <?php
                        }
                      ?>
                    </td>
                    <!-- Modals -->
                    <div class="modal fade" id="set_slider<?php echo $value['sl_id'];?>" role="dialog">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Set Slider Image</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="../Admin_modules/add_slider.php" method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                <label for="sl_img">Slider Image<sup style="color: red;">*</sup></label>
                                <div> 
                                  <input type="file" id="sl_img" name="sl_img" class="form-control" placeholder="Slider Image" autofocus="autofocus" accept="image/*" required>
                                  <input type="hidden" name="sl_num" value="<?php echo $value['sl_id'];?>">
                                </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn_custom" name="set_slider">Set Image</button>
                            </form>
                          <button class="btn_custom" type="button" data-dismiss="modal">Cancel</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="modal fade" id="remove_slider<?php echo $value['sl_id'];?>" role="dialog">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Remove Slider Image</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <div class="modal-footer">
                            <form action="../Admin_modules/del_slider.php" method="post" enctype="multipart/form-data">
                              <input type="hidden" name="sl_num" value="<?php echo $value['sl_id'];?>">
                              <button type="submit" class="btn_custom" name="rem_slider">Remove Image</button>
                            </form>
                          <button class="btn_custom" type="button" data-dismiss="modal">Cancel</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Modals -->
                  </tr>
                <?php }

                ?>

                </tbody>
              </table>

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
