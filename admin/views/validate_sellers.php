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

        <!-- Area Chart Example-->
        <?php include '../Admin_modules/fetch_sellers.php';

        $results_per_page = 3;
        $number_of_results = 0;

        foreach ($fetch_sellers as $key => $value) 
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


        $sql = "SELECT * FROM `seller_registration` WHERE `seller_status` = 'Not Approved' LIMIT " . $starting_limit_number .','.$results_per_page;
        $result=mysqli_query($conn,$sql);

        while($row = mysqli_fetch_array($result))
        {
          $seller_data[] = $row;
        }

       
        foreach ($seller_data as $key => $value) 
        {
          
        ?>
          
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-user"></i>&nbsp;&nbsp;
              Seller ID:&nbsp;&nbsp; <b><?php echo $value['seller_Id'];?></b></div>
            <div class="card-body">
              <u><h5>Seller Details</h5></u><br>
              <div class="row">
                <div class="col-lg-6">
                  <p>Name: <?php echo $value['seller_name'];?></p>
                  <p>Company: <?php echo $value['company_name'];?></p>
                  <p>Address: <?php echo $value['company_addr'];?></p>
                  <b><p style="color: #ff0000;">GST No: <?php echo $value['gst_no'];?></p></b>
                </div>
                <div class="col-lg-6">
                  <p>Mobile Number: <?php echo $value['mob_no'];?></p>
                  <?php
                    if ($value['alt_mob'] != 0) { ?>
                     <p>Alternate Mobile No.: <?php echo $value['alt_mob'];?></p>
                   <?php }
                  ?>     
                  <p>Email ID: <?php echo $value['mail_id'];?></p>
                  <p>Date & Time of Registration: <?php echo $value['timestamp'];?></p>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-3 seller_docs">
                  <a data-fancybox="gallery" href="../images/<?php echo $value['company_name'].'_'.$value['gst_no'].'/documents/'.$value['file1'];?>"><img class="doc_img" src="../images/<?php echo $value['company_name'].'_'.$value['gst_no'].'/documents/'.$value['file1'];?>"></a>
                </div>
                <div class="col-lg-3 seller_docs">
                  <a data-fancybox="gallery" href="../images/<?php echo $value['company_name'].'_'.$value['gst_no'].'/documents/'.$value['file2'];?>"><img class="doc_img" src="../images/<?php echo $value['company_name'].'_'.$value['gst_no'].'/documents/'.$value['file2'];?>"></a>
                </div>
                <div class="col-lg-3 seller_docs">
                  <a data-fancybox="gallery" href="../images/<?php echo $value['company_name'].'_'.$value['gst_no'].'/documents/'.$value['file3'];?>"><img class="doc_img" src="../images/<?php echo $value['company_name'].'_'.$value['gst_no'].'/documents/'.$value['file3'];?>"></a>
                </div>
                <div class="col-lg-3 seller_docs">
                  <a data-fancybox="gallery" href="../images/<?php echo $value['company_name'].'_'.$value['gst_no'].'/documents/'.$value['file4'];?>"><img class="doc_img" src="../images/<?php echo $value['company_name'].'_'.$value['gst_no'].'/documents/'.$value['file4'];?>"></a>
                </div>
              </div>

              <div class="btn_row" style="margin-top: 20px;"> 
                <button type="submit" id="<?php echo $value['seller_Id'];?>" class="btn_approve" data-toggle="modal" data-target="#appr_modal<?php echo $value['seller_Id'];?>">Approve</button>
                <button type="submit" id="<?php echo $value['seller_Id'];?>" class="btn_reject" data-toggle="modal" data-target="#rej_modal<?php echo $value['seller_Id'];?>">Reject</button>
              </div>
            </div>
          </div>

          <!-- Modals -->
          <div class="modal fade" id="appr_modal<?php echo $value['seller_Id'];?>" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Are you sure you want to approve this seller</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-footer">
                  <form action="../Admin_modules/auth_sellers.php?id=<?php echo $value['seller_Id'];?>" method="post"><button type="submit" class="btn_approve" name="approve">Yes</button></form>
                  <button class="btn_reject" type="button" data-dismiss="modal">No</button>
                </div>
              </div>
            </div>
          </div>


          <div class="modal fade" id="rej_modal<?php echo $value['seller_Id'];?>" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Reject Seller</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="../Admin_modules/auth_sellers.php?id=<?php echo $value['seller_Id'];?>&&name=<?php echo $value['seller_name'];?>&&company=<?php echo $value['company_name'];?>&&mail=<?php echo $value['mail_id'];?>" method="post">
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

        }

        for ($page=1; $page <= $number_of_pages ; $page++) 
        { 
          echo '<a href="validate_sellers.php?page='.$page.'"><button class="btn_custom" style="margin-right: 12px;">&nbsp;&nbsp;&nbsp;'  .  $page  .  '&nbsp;&nbsp;&nbsp;</button></a>';
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
