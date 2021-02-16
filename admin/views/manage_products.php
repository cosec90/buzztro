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

if (isset($_POST['disable'])) 
{
 // echo $id = $_POST['prod_id'];
}

if (isset($_POST['enable'])) 
{
 // echo $id = $_POST['prod_id'];
}
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
            Products Info</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Sold By</th>
                    <th>Total Stock</th>
                    <th>Expiry</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                 // print_r($view_products);
                  foreach ($view_products as $key => $value) 
                  { ?>
                  
                  <tr>
                    <td><?php echo $value['prod_id'];?></td>
                    <td><?php echo $value['prod_name'];?></td>
                    <td><?php echo $value['sold_by'];?></td>
                    <td><?php echo $value['prod_stock'];?></td>
                    <td><?php echo $value['prod_timer'];?></td>
                    <!-- <td class="text-center">
                      <?php 
                        if ($value['prod_status'] == 'Approved') 
                        { ?>
                        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                          <input type="hidden" name="prod_id" value="<?php echo $value['prod_id'];?>" >
                          <button type="submit" class="btn_custom" name="disable" style="width: 100%;">Disable</button>
                        <?php }
                        elseif ($value['prod_status'] == 'Not Approved') 
                        { ?>
                          <button type="submit" class="btn_custom" name="enable" style="width: 100%;">Enable</button></form>
                        <?php
                        }
                      ?>
                    </td> -->
                    <td class="text-center">
                        <a href="single_prod.php?id=<?php echo $value['prod_id'];?>" ><button class="btn_custom">View</button></a>
                        <a href="single_prod_edit.php?id=<?php echo $value['prod_id'];?>" ><button class="btn_custom">Edit</button></a>
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
