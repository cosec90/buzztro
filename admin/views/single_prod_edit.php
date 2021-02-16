<?php

date_default_timezone_set("Asia/Kolkata");
//error_reporting(0);
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
include '../Admin_config/connection.php';
include '../Admin_controllers/products.php';

$id = $_GET['id'];
$getProd = FETCH_PRODUCTS_BY_ID($id);

if (isset($_POST['update'])) 
{
  $id = $_POST['prod_id'];
  $name = str_replace("'","\'",nl2br($_POST['prod_new_name']));;
  $desc = str_replace("'","\'",nl2br($_POST['prod_new_desc']));
  $timer = $_POST['display_time'];

  $update_product = UPDATE_PRODUCT($id,$name,$desc,$timer);
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

        <!-- Area Chart Example-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-user"></i>&nbsp;&nbsp;
              Sold By:&nbsp;&nbsp; <b><?php echo $getProd['sold_by'];?></b></div>
            <div class="card-body">
              <u><h5>Product Details</h5></u><br>
              <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
              <div class="row">
                <div class="col-lg-6">
                  <b><p style="color: #ff0000;">Product ID: <input class="form-control" type="text" name="prod_id" value="<?php echo $getProd['prod_id'];?>" readonly></p></b>
                  <p>Product Description: <textarea class="form-control" type="text" rows="6" name="prod_new_desc" id="prod_new_desc" placeholder="Enter Description" required ><?php echo strip_tags($getProd['prod_desc']);?></textarea></p>
                  
                </div>
                <div class="col-lg-6">   
                  <p>Product Name: <input class="form-control" type="text" name="prod_new_name" id="prod_new_name" placeholder="Enter Name" value="<?php echo $getProd['prod_name'];?>" required ></p>
                  
                  <p>Display Time: <input class="form-control" type="date" name="display_time" value="<?php echo date('Y-m-d',strtotime($getProd['prod_timer'])) ?>" id="display_time" required ></p>
                  
                </div>
              </div>

              <div class="btn_row" style="margin-top: 20px;"> 
                <button type="submit" name="update" class="btn_custom">Update</button>
                
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
