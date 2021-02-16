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

       <?php include '../Admin_modules/fetch_queries.php';

        $results_per_page = 4;
        $number_of_results = 0;

        foreach ($fetch_user_enquiries as $key => $value) 
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


        $sql = "SELECT * FROM `user_enquiry` WHERE `query_status` = 'Unsolved' LIMIT " . $starting_limit_number .','.$results_per_page;
        $result=mysqli_query($conn,$sql);

        while($row = mysqli_fetch_array($result))
        {
          $queries[] = $row;
        }

       
        foreach ($queries as $key => $value) 
        {
          
        ?>
          
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-user"></i>&nbsp;&nbsp;
              User ID:&nbsp;&nbsp; <b><?php echo $value['user_Id'];?></b></div>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-4">
                  <p>From: <?php echo $value['user_name'];?></p>
                </div>
                <div class="col-lg-4">
                </div>
                <div class="col-lg-4">
                  <p>Time: <?php echo date('d/m/Y, h:i A', strtotime($value['datetime']));?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <p>Email: <?php echo $value['user_email'];?></p>
                </div>
                <div class="col-lg-4">
                </div>
                <div class="col-lg-4">
                  <p>Subject: <?php echo $value['user_subject'];?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <p>Query Number: <b><?php echo $value['query_no'];?></b></p>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <textarea type="text" id="enquiry" name="enquiry" class="form-control" rows="5" readonly=""><?php echo strip_tags($value['user_msg']);?></textarea>
                </div>
              </div>

              <div class="btn_row" style="margin-top: 20px;"> 
                <button type="submit" class="btn_custom" data-toggle="modal" data-target="#solve_query<?php echo $value['query_no'];?>">Close Query</button>
              </div>
            </div>
          </div>

          <!-- Modals -->
          <div class="modal fade" id="solve_query<?php echo $value['query_no'];?>" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Are you sure you want to close this query</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-footer">
                  <form action="../Admin_modules/fetch_queries.php?code=<?php echo $value['query_no'];?>&&type=user" method="post"><button type="submit" class="btn_approve" name="close_query">Yes</button></form>
                  <button class="btn_reject" type="button" data-dismiss="modal">No</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Modals -->

        <?php 

        }

        for ($page=1; $page <= $number_of_pages ; $page++) 
        { 
          echo '<a href="enquiries.php?page='.$page.'"><button class="btn_custom" style="margin-right: 12px;">&nbsp;&nbsp;&nbsp;'  .  $page  .  '&nbsp;&nbsp;&nbsp;</button></a>';
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
