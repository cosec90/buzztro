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
        include '../Admin_controllers/products.php';
        $item = $_GET['id'];

        $fetch_products = FETCH_RATE($item);
        ?>
         

        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-users"></i>
            Product Info</div>
          <div class="card-body">
            <form action="../Admin_modules/edit_pricing.php" method="post">
              <div class="table-responsive">
                <p>Product ID: <?php echo $item ?></p>

               <table border="1" class="table">
                  <thead>
                    <th>Items Sold</th>
                    <th>Price per Item (in Rs)</th>
                    <th>Admin Pricing (in Rs)</th>
                  </thead>
                  <tbody>
                    
                    <?php
                    
                      foreach ($fetch_products as $key => $stock_rate) 
                      { 
                        ?>

                        <tr>
                          <td>
                            <p><?php echo $stock_rate['prod_stock'];?></p>
                          </td>
                          <td>
                            <p><?php echo '&#8377;'.number_format($stock_rate['prod_rate']);?></p>
                          </td>
                          <td>
                            <p style="display: flex;">
                              &#8377;&nbsp;&nbsp; <input class="form-control" type="text" id="adm_rate" name="admin_rate" placeholder="Enter Rate" required value="<?php echo $stock_rate['admin_rate'];?>" readonly>
                            </p>
                          </td>
                        </tr>

                      <?php 

                      }

                    ?>
                  
                  </tbody>
                </table>
              </div>

              <div class="row">
                <div class="col-lg-4">
                  
                </div>
                <div class="col-lg-1">
                  
                </div>
                <div class="col-lg-2">

                  <button type="button" class="btn_custom" id="edit_prod" onclick="change_price()" style="width: 100%; display: block;"><i class="fas fa-fw fa-edit"></i>&nbsp;&nbsp;Edit Pricing</button>
                  <button class="btn_custom" id="done_prod" onclick="done_price()" name="conf_price" style="width: 100%; display: none;"><i class="fas fa-fw fa-check"></i>&nbsp;&nbsp;Confirm Pricing</button>
                </div>
                <div class="col-lg-1">
                  
                </div>
                <div class="col-lg-4">
                  
                </div>
              </div>

              <input type="hidden" name="prod_id" value="<?php echo $item ?>">
              <input type="hidden" name="new_ad_rates" id="new_ad_rates">
            </form>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
      <script>
        function change_price()
        {
          var edit = $('#edit_prod');
          var done = $('#done_prod');
          var inputs = $('input[name="admin_rate"]');

          edit.hide();
          inputs.removeAttr("readonly");
          done.show();
        }

        function done_price()
        {
          var new_adm_rate = [];
          var error = 0;

          var edit = $('#edit_prod');
          var done = $('#done_prod');
          var inputs = $('input[name="admin_rate"]');

          $('input[name="admin_rate"]').each(function(i , elem)
          {
            if ($(elem).val() != "") 
            {
              new_adm_rate.push($(elem).val());
            }
            else
            {
              $('input[name="admin_rate"]').val('');
              error = 1;
              return false;
            }
          });

          if (error == 1)
          {
            alert("Fields cannot be empty");
            $('input[name="admin_rate"]').val('');
          }
          else
          {
            $("#new_ad_rates").val(new_adm_rate);
            done.hide();
            edit.show();
            inputs.attr("readonly","");
          }
          
        }
      </script>
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
