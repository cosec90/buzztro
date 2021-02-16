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
              Manage Category</div>
            <div class="card-body">

              <form action="../Admin_modules/add_category.php" method="post" enctype="multipart/form-data">
                <p>(Fields marked <sup style="color: red;">*</sup> are mandatory)</p>
                <div class="row">
                  <div class="col-lg-4">
                    <div class="form-group">
                      <div class="form-label-group"> 
                        <?php include '../Admin_modules/fetch_categories.php';?>
                        <input type="text" id="cat_id" name="cat_id" class="form-control" pattern="[a-zA-Z\s]+" placeholder="Category ID (Auto fetched)" autofocus="autofocus" readonly value="<?php echo $fetch_last;?>">
                        <label for="cat_id">Category ID (Auto fetched)</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <div class="form-label-group"> 
                        <input type="text" id="cat_name" name="cat_name" class="form-control" placeholder="Category Name" autofocus="autofocus" required>
                        <label for="cat_name">Category Name<sup style="color: red;">*</sup></label>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <div class="form-label-group"> 
                        <input type="file" id="cat_img" name="cat_img" class="form-control" autofocus="autofocus" required>
                        <label for="cat_img">Category Image<sup style="color: red;">*</sup></label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-4">
                    <button class="btn_custom" style="margin: 20px 0;" type="submit" name="submit">Add Category</button>
                  </div>
                  <div class="col-lg-4">
                  </div>
                  <div class="col-lg-4">
                  </div>
                </div>
              </form>

            </div>

            <!-- Table -->
            <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($fetch_all as $key => $value) 
                  { ?>
                  
                  <tr>
                    <td><?php echo $value['cat_id'];?></td>
                    <td><?php echo $value['cat_name'];?></td>
                    <td class="text-center">
                        <button type="submit" id="<?php echo $value['cat_id'];?>" class="btn_custom" data-toggle="modal" data-target="#del_cat<?php echo $value['cat_id'];?>" style="width: 100%;">Delete</button>
                    </td>
                  </tr>
                  <!-- Modals -->
                  <div class="modal fade" id="del_cat<?php echo $value['cat_id'];?>" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Confirm Deleting Category?</h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-footer">
                          <form action="../Admin_modules/add_category.php?id=<?php echo $value['cat_id'];?>" method="post">
                            <button type="submit" class="btn_reject" name="delete">Delete</button>
                          </form>
                          <button class="btn_custom" type="button" data-dismiss="modal">Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
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
