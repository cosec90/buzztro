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

        <?php 

        $item = $_GET['id'];

        ?>
         

        <div class="row">
          <div class="col-lg-2"></div>
          <div class="col-lg-8 text-center">
            <p>Restock Product: <b><?php echo $item;?></b></p>
            <form action="../Admin_modules/product_restock.php" method="post" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <div class="form-label-group"> 
                        <input type="text" id="prod_stock" name="prod_stock" onkeyup="default_row_stock()" class="form-control" placeholder="Total Stock" autofocus="autofocus" required>
                        <label for="prod_stock">Total Stock</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <div class="form-label-group"> 
                        <input type="text" id="prod_rate" name="prod_rate" onkeyup="default_row_rate()" class="form-control" placeholder="Rate per Item" autofocus="autofocus" required>
                        <label for="prod_rate">Rate per Item</label>
                      </div>
                    </div>
                  </div>
                </div>

            <table border="1" class="table table-hover">
              <thead>
                <th>Items Sold</th>
                <th>Price per Item (in Rs)</th>
                <th style="padding: 0;">
                  <div class="btn_approve" onclick="addrow();" style="display: -webkit-inline-box; margin: 10px 0; cursor: pointer;"><i class="fa fa-plus"></i>&nbsp;&nbsp;<p style="margin-bottom: 0;">Add Row</p></div>
                </th>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <input type="text" id="first_remain" name="item_remain" class="form-control" autofocus="autofocus" readonly value="0" style="width: 60%; text-align: center; margin: auto;" required>
                  </td>
                  <td>
                    <input type="text" id="def_rate" readonly name="item_rate" class="form-control" autofocus="autofocus"style="width: 60%; text-align: center; margin: auto;" placeholder="Rate per Item" required>
                  </td>
                </tr>

                <?php

                for ($i=1; $i <= 2 ; $i++) 
                { ?>

                  <tr id="row<?php echo $i;?>">
                    <td>
                      <input type="text" id="item_remain" onblur="validate_row<?php echo $i;?>()" name="item_remain" class="form-control" placeholder="Items Sold" autofocus="autofocus" style="width: 60%; text-align: center; margin: auto;" required>
                    </td>
                    <td>
                      <input type="text" id="item_rate" onblur="validate_row<?php echo $i;?>()" name="item_rate" class="form-control" placeholder="Rate per Item" autofocus="autofocus" style="width: 60%; text-align: center; margin: auto;" required>
                    </td>
                  </tr>

                <?php

                }

                ?>

                <tr id="before_zero">
                  <td>
                    <input type="text" id="def_remain" name="item_remain" class="form-control" autofocus="autofocus" readonly style="width: 60%; text-align: center; margin: auto;">
                  </td>
                  <td>
                    <input type="text" id="item_rate" name="item_rate" class="form-control" placeholder="Rate per Item" autofocus="autofocus" style="width: 60%; text-align: center; margin: auto;">
                  </td>
                </tr>
                
              </tbody>
            </table>
          </div>
          <div class="col-lg-2"></div>
        </div>

        <script>

          var i = 2;

          function addrow()
          {
            i++;

            if (i >= 7)
            {
              alert('Limit Reached');
              $('.btn_approve').hide();

            }
            else
            {
              $('tr:last').before('<tr id="row'+i+'"><td><input type="text" id="item_remain" onblur="validate_row'+i+'()" name="item_remain" class="form-control" placeholder="Item Remaining" autofocus="autofocus" required style="width: 60%; text-align: center; margin: auto;"></td><td><input type="text" id="item_rate" onblur="validate_row'+i+'()" name="item_rate" class="form-control" placeholder="Rate per Item" autofocus="autofocus" required style="width: 60%; text-align: center; margin: auto;"></td></tr>');
            }
          }

          function default_row_stock()
          {
            var stock = $('#prod_stock').val();
            
            if (stock.match(/^\d+$/)) 
            {
              $('#def_remain').val(stock)
            }
            else
            {
              alert ("Please enter numeric value");
              $('#prod_stock').val("");
            }
            
          }

          function default_row_rate()
          {
            var rate = $('#prod_rate').val();

            if (rate.match(/^\d+$/)) 
            {
              $('#def_rate').val(rate);
            }
            else
            {
              alert ("Please enter numeric value");
              $('#prod_rate').val("");
            }
            
          }

          function validate_row1()
          {
            var stock = $('#first_remain').val();
            var input_stock = $('#row1 #item_remain').val();

            var price = $('#def_rate').val();
            var input_price = $('#row1 #item_rate').val();

            if (stock != "")
            {
              if (parseInt(input_stock) <= parseInt(stock)) 
              {
                alert ("Stock cannot be less than the previous");
                $('#row1 #item_remain').val("");
              }
            }
            else
            {
              alert("Please enter total stock first");
              $('#row1 #item_remain').val("");
            }

            checkRate(price, input_price);
            
          }

          function validate_row2()
          {
            var stock = $('#row1 #item_remain').val();
            var input_stock = $('#row2 #item_remain').val();

            var price = $('#row1 #item_rate').val();
            var input_price = $('#row2 #item_rate').val();

            if (stock != "")
            {
              if (parseInt(input_stock) <= parseInt(stock)) 
              {
                alert ("Stock cannot be less than the previous");
                $('#row2 #item_remain').val("");
              }
            }
            else
            {
              alert("Please enter total stock first");
              $('#row2 #item_remain').val("");
            }

            checkRate(price, input_price);

          }

          function validate_row3()
          {
            var stock = $('#row2 #item_remain').val();
            var input_stock = $('#row3 #item_remain').val();

            var price = $('#row2 #item_rate').val();
            var input_price = $('#row3 #item_rate').val();

            if (stock != "")
            {
              if (parseInt(input_stock) <= parseInt(stock)) 
              {
                alert ("Stock cannot be less than the previous");
                $('#row3 #item_remain').val("");
              }
            }
            else
            {
              alert("Please enter total stock first");
              $('#row3 #item_remain').val("");
            }

            checkRate(price, input_price);
            
          }

          function validate_row4()
          {
            var stock = $('#row3 #item_remain').val();
            var input_stock = $('#row4 #item_remain').val();

            var price = $('#row3 #item_rate').val();
            var input_price = $('#row4 #item_rate').val();

            if (stock != "")
            {
              if (parseInt(input_stock) <= parseInt(stock)) 
              {
                alert ("Stock cannot be less than the previous");
                $('#row4 #item_remain').val("");
              }
            }
            else
            {
              alert("Please enter total stock first");
              $('#row4 #item_remain').val("");
            }

            checkRate(price, input_price);
            
          }

          function validate_row5()
          {
            var stock = $('#row4 #item_remain').val();
            var input_stock = $('#row5 #item_remain').val();

            var price = $('#row4 #item_rate').val();
            var input_price = $('#row5 #item_rate').val();

            if (stock != "")
            {
              if (parseInt(input_stock) <= parseInt(stock)) 
              {
                alert ("Stock cannot be less than the previous");
                $('#row5 #item_remain').val("");
              }
            }
            else
            {
              alert("Please enter total stock first");
              $('#row5 #item_remain').val("");
            }

            checkRate(price, input_price);
            
          }

          function validate_row6()
          {
            var stock = $('#row5 #item_remain').val();
            var input_stock = $('#row6 #item_remain').val();

            var price = $('#row5 #item_rate').val();
            var input_price = $('#row6 #item_rate').val();

            if (stock != "")
            {
              if (parseInt(input_stock) <= parseInt(stock)) 
              {
                alert ("Stock cannot be less than the previous");
                $('#row6 #item_remain').val("");
              }
            }
            else
            {
              alert("Please enter total stock first");
              $('#row6 #item_remain').val("");
            }

            checkRate(price, input_price);
            
          }

          function checkRate(price, input_price)
          {
            if (price != "")
            {
              if (parseInt(input_price) >= parseInt(price)) 
              {
                alert ("Value exceeds total price");
                var focused = $(':focus');
                focused.val("");
              }
            }
            else
            {
              alert("Please enter total price first");
              var focused = $(':focus');
              focused.val("");
            }
          }

        </script>

        <div class="row text-center">
          <div class="col-lg-12">
            <button class="btn-custom" id="confirm_btn" style="margin-bottom: 10px; display: none;" type="submit" name="submit">Add Products</button>
          </div>
        </div>

        <input type="hidden" name="id" value="<?php echo $_SESSION['seller_Id'];?>" required>
          <input type="hidden" name="item_arr" id="item_arr" required>
          <input type="hidden" name="rate_arr" id="rate_arr" required>
        </form>

        <div class="col-lg-12 text-center">
                <button class="btn_custom" id="validate_btn" type="button" style="margin-bottom: 10px;" onclick="validate_price()">Validate Pricing</button>
              </div>
        
        <script>

                  function validate_price()
                  {
                    var item = [];
                    var rate = [];
                    var item_prev = "";
                    var rate_prev = "";

                    var success_one = true;
                    var success_two = true;

                    var row_count = $('input[name="item_remain"]').length;

                    $('input[name="item_remain"]').each(function(i , elem)
                    {
                      if (i == 0)
                      {
                        item.push($(elem).val());
                        item_prev = $(elem).val();
                      }
                      else
                      {
                        if ($(elem).val() > item_prev) 
                        {
                          item.push($(elem).val());
                          item_prev = $(elem).val();
                        }
                        else
                        {
                          alert("Stock cannot be less than the previous");
                          $(elem).val("");
                          success_one = false;
                        }
                      }
                      
                    });


                    $('input[name="item_rate"]').each(function(i , elem)
                    {
                      if (i == 0)
                      {
                        rate.push($(elem).val());
                        rate_prev = $(elem).val();
                      }
                      else
                      {
                        if ($(elem).val() < rate_prev) 
                        {
                          rate.push($(elem).val());
                          rate_prev = $(elem).val();
                        }
                        else
                        {
                          alert("Price cannot be greater than the previous");
                          $(elem).val("");
                          success_two = false;
                        }
                      }
                      
                    });

                    
                    if (success_one && success_two) 
                    {
                      $("#validate_btn").hide();
                    $("#confirm_btn").show();
                    }

                    item.join(',');
                    rate.join(',');
                    
                    $("#item_arr").val(item);
                    $("#rate_arr").val(rate);
                    
                  }

                </script>

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
