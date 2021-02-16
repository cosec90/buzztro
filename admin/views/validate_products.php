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

?>

<script>
  
  window.onload = function() {
    if(!window.location.hash) {
        window.location = window.location + '#loaded';
        window.location.reload();
    }
}
</script>

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
        <?php
        include '../Admin_modules/fetch_products.php';
        include '../Admin_modules/fetch_categories.php';

        $results_per_page = 1;
        $number_of_results = 0;

        foreach ($fetch_products as $key => $value) 
        {
          $number_of_results++;
        }

        $number_of_pages = ceil($number_of_results/$results_per_page);

        if (!isset($_GET['page'])) 
        {
          $page = 1;
        }
        else
        {
          $page = $_GET['page'];
        }

        $starting_limit_number = ($page-1)*$results_per_page;


        $sql = "SELECT * FROM `product_info` WHERE `prod_status` = 'Not Approved' LIMIT " . $starting_limit_number .','.$results_per_page;
        $result=mysqli_query($conn,$sql);

        while($row = mysqli_fetch_array($result))
        {
          $prod_data[] = $row;
        }

        $products = array();

        $count = 0;
        foreach ($prod_data as $key => $value) 
        {
          $details = GET_DETAILS($value['sold_by']);
        ?>
          
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-user"></i>&nbsp;&nbsp;
              Sold By:&nbsp;&nbsp; <b><?php echo $value['sold_by'];?></b></div>
            <div class="card-body">
              <u><h5>Product Details</h5></u><br>
              <div class="row">
                <div class="col-lg-6">
                  <b><p style="color: #ff0000;">Product ID: <input class="form-control" type="text" name="prod_id" value="<?php echo $value['prod_id'];?>" readonly></p></b>
                  <p>Product Description: <textarea class="form-control" type="text" rows="6" name="prod_new_desc" id="prod_new_desc" placeholder="Enter Description" required oninput="modal_values()"><?php echo strip_tags($value['prod_desc']);?></textarea></p>
                  <p>Total Stock: <?php echo $value['prod_stock'];?></p>
                </div>
                <div class="col-lg-6">   
                  <p>Product Name: <input class="form-control" type="text" name="prod_new_name" id="prod_new_name" placeholder="Enter Name" value="<?php echo $value['prod_name'];?>" required oninput="modal_values()"></p>
                  <p>Rate: <?php echo '&#8377;'.$value['prod_rate'];?></p>
                  <p>Display Time: <input class="form-control" type="date" name="display_time" id="display_time" oninput="modal_values()" required ></p>
                  <p>Booking Amount: <input class="form-control" type="text" name="booking_amt" id="booking_amt" required oninput="modal_values()"></p>
                </div>
              </div>

              <script type="text/javascript">
                $(function(){
                    var dtToday = new Date();
                    
                    var month = dtToday.getMonth() + 1;
                    var day = dtToday.getDate() + 1;
                    var year = dtToday.getFullYear();
                    if(month < 10)
                        month = '0' + month.toString();
                    if(day < 10)
                        day = '0' + day.toString();
                    
                    var maxDate = year + '-' + month + '-' + day;
                    $('#display_time').attr('min', maxDate);
                });
              </script>

              <div class="row">
                <div class="col-lg-1"></div>

                <?php
                  $real = realpath('../images/'.$value['sold_by'].'_'.$details[0]['gst_no'].'/products/'.$value['prod_id']);
                  
                  $fi = new FilesystemIterator($real, FilesystemIterator::SKIP_DOTS);
                  $file_counter = iterator_count($fi);

                  for ($i=1; $i <= $file_counter; $i++) 
                  { ?>
                    
                  <div class="col-lg-2 seller_docs">
                    <a data-fancybox="gallery" href="../images/<?php echo $value['sold_by'].'_'.$details[0]['gst_no'].'/products/'.$value['prod_id'].'/'.$value['file'.$i];?>"><img class="doc_img" src="../images/<?php echo $value['sold_by'].'_'.$details[0]['gst_no'].'/products/'.$value['prod_id'].'/'.$value['file'.$i];?>"></a>
                  </div>

                  <?php
                  }
                
                ?>

                <div class="col-lg-1"></div>
              </div>
              
              <h4 class="text-center" style="text-transform: uppercase; margin-bottom: 20px;">Pricing</h4>
              <!-- Table -->
              <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8 text-center">
                  <table border="1" class="table">
                    <thead>
                      <th>Items Sold</th>
                      <th>Price per Item (in Rs)</th>
                      <th>Admin Pricing (in Rs)</th>
                    </thead>
                    <tbody>
                      
                      <?php

                        array_push($products, $value['prod_id']);
                        $_SESSION['products'] = $products;

                        $input_count = 0;
                        foreach ($fetch_rate[$count] as $key => $stock_rate) 
                        { 
                          $input_count++;
                          ?>

                          <tr>
                            <td>
                              <p><?php echo $stock_rate['prod_stock'];?></p>
                            </td>
                            <td>
                              <p><?php echo '&#8377;'.$stock_rate['prod_rate'];?></p>
                            </td>
                            <td>
                              <input class="form-control" type="text" id="admin_rate<?php echo $input_count;?>" name="admin_rate" placeholder="Enter Rate" required>
                            </td>
                          </tr>

                        <?php 

                        }

                      ?>
                    
                    </tbody>
                  </table>
                </div>
                <div class="col-lg-2"></div>
              </div>
              <!-- Table -->

              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <div class="form-label-group"> 
                      <select name="prod_cat" id="cat" class="form-control" required oninput="modal_values()">
                        <option value="">Select Category</option>
                        <?php

                        foreach ($fetch_all as $key => $cat) 
                        { ?>

                          <option value="<?php echo $cat['cat_name'];?>"><?php echo $cat['cat_name'];?></option>
                       
                       <?php
                        }

                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">   
                  <div class="form-group">
                      <textarea type="text" id="inp_tags" name="tags" class="form-control" autofocus="autofocus" rows="7" required oninput="modal_values()"></textarea>
                  </div>
                </div>
                <div class="col-lg-6">   
                  
                </div>
                <div class="col-lg-6">   
                  <div class="alert alert-info">
                    Separate tags using comma ','
                  </div>
                </div>
              </div>

              <script>
                
                $(document).ready(function(){
                  var loop_counter = 1;
                  var tr_len = $('table tbody tr').length;

                  for (var i = loop_counter; i <= tr_len; i++) 
                  {
                    $('#admin_rate'+i).on('keyup',function(){
                      var rate = $(this).val();
                      
                      if (!rate.match(/^\d+$/))
                      {
                        alert ("Please enter numeric value");
                        $(this).val("");
                      }

                    });
                  }

                });
                
              </script>

              <div class="btn_row" style="margin-top: 20px;"> 
                <button type="submit" style="display: none;" id="<?php echo $value['prod_id'];?>" class="btn_approve" data-toggle="modal" data-target="#appr_modal<?php echo $value['prod_id'];?>">Approve</button>
                <button class="btn_custom" id="validate_btn" type="submit" style="margin-bottom: 10px;" onclick="validate_price()">Validate Pricing</button>
                <button type="submit" id="<?php echo $value['prod_id'];?>" class="btn_reject" data-toggle="modal" data-target="#rej_modal<?php echo $value['prod_id'];?>">Reject</button>
              </div>

            </div>
          </div>

          <script>
            function validate_price()
            {
              var adm_rate = [];

              var error = 0;

              $('input[name="admin_rate"]').each(function(i , elem)
              {
                if ($(elem).val() != "") 
                {
                  adm_rate.push($(elem).val());
                }
                else
                {
                  $('input[name="admin_rate"]').val('');
                  error = 1;
                  return false;
                }
              });

              if ($("#prod_new_name").val() == "") {error = 1;}
              if ($("#prod_new_desc").val() == "") {error = 1;}
              if ($("#inp_tags").val() == "") {error = 1;}
              if ($("#prod_cat").val() == "") {error = 1;}
              if ($("#display_time").val() == "") {error = 1;}
              if ($("#booking_amt").val() == "") {error = 1;}

              if (error == 1)
              {
                alert("Fields cannot be empty");
                $('input[name="admin_rate"]').val('');
              }
              else
              {
                $("#rate_arr").val(adm_rate);
                $("#validate_btn").hide();
                $(".btn_approve").show();
              }
            }

            function modal_values()
            {
              $("#prod_new_name_modal").val($("#prod_new_name").val());
              $("#prod_new_desc_modal").val($("#prod_new_desc").val());
              $("#inp_tags_modal").val($("#inp_tags").val());
              $("#prod_cat_modal").val($("#cat").val());
              $("#timer").val($("#display_time").val());
              $("#book_amt").val($("#booking_amt").val());
            }
            
          </script>

          <!-- Modals -->
          <div class="modal fade" id="appr_modal<?php echo $value['prod_id'];?>" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Are you sure you want to approve this product</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-footer">
                  <form action="../Admin_modules/auth_products.php?id=<?php echo $value['prod_id'];?>&&name=<?php echo $value['prod_name'];?>&&company=<?php echo $value['sold_by'];?>" method="POST">

                    <input type="hidden" name="prod_new_name_modal" id="prod_new_name_modal" required>
                    <textarea name="prod_new_desc_modal" id="prod_new_desc_modal" required style="display: none;"></textarea>
                    <textarea name="inp_tags_modal" id="inp_tags_modal" required style="display: none;"></textarea>
                    <input type="hidden" name="prod_cat_modal" id="prod_cat_modal" required>
                    <input type="hidden" name="rate_arr" id="rate_arr" required>
                    <input type="hidden" name="timer" id="timer" required>
                    <input type="hidden" name="book_amt" id="book_amt" required>

                    <button type="submit" class="btn_approve" name="approve">Yes</button>
    
                  </form>
                  <button class="btn_reject" type="button" data-dismiss="modal">No</button>
                </div>
              </div>
            </div>
          </div>


          <div class="modal fade" id="rej_modal<?php echo $value['prod_id'];?>" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Reject Product</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="../Admin_modules/auth_products.php?id=<?php echo $value['prod_id'];?>&&name=<?php echo $value['prod_name'];?>&&company=<?php echo $value['sold_by'];?>&&new_name=<?php echo $_GET['prod_new_name'];?>" method="post">
                    <p>Reason for Rejection <sup style="color: red">*</sup></p>
                    
                    <div class="form-group">
                      <div class="form-label-group"> 
                        <textarea type="text" id="reason" name="reason" class="form-control" placeholder="Reason" autofocus="autofocus" required="true"></textarea>
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button class="btn_custom" name="reject">Confirm Reject</button></form>
                  <button type="button" class="btn_custom" data-dismiss="modal">Close</button>
                </div>  
              </div>
            </div>
          </div>
          <!-- Modals -->


        <?php 
          $count = $count + 1;
        }

        for ($page=1; $page <= $number_of_pages ; $page++) 
        { 
          echo '<a href="validate_products.php?page='.$page.'"><button class="btn_custom" style="margin-right: 12px;">&nbsp;&nbsp;&nbsp;'  .  $page  .  '&nbsp;&nbsp;&nbsp;</button></a>';
        }

        ?>
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
