<?php

date_default_timezone_set("Asia/Kolkata");

error_reporting(0);
session_start();

if (!isset($_SESSION['adm_Id'])) {
  header('Location: login.php');
}
include 'header.php';
include '../Admin_modules/blog_operations.php';
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
        if (isset($_GET['id']))
        {
          ?>

          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-cogs"></i>
              Manage Blogs</div>
            <div class="card-body">
              <div class="table-responsive">
                <b><?php echo $blog['blog_title'];?></b>
                <br><br>
                <p><?php echo $blog['blog_desc'];?></p>
                <br><br>
                <a href="manage_blogs.php"><button class="btn_custom" style="margin: 0;">Go back</button></a>
              </div>
            </div>
          </div>

        <?php
        }
        else
        { 
        ?>

          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-cogs"></i>
              Manage Blogs</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Date & Time</th>
                      <th colspan="2">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($blogs as $key => $value) 
                    { ?>

                      <tr>
                        <td><?php echo $value['blog_title'];?></td>
                        <td><?php echo $value['datetime'];?></td>
                        <td style="text-align: center;">
                          <form action="manage_blogs.php?id=<?php echo $value['blog_id'];?>" method="post">
                            <input type="submit" name="view_story" class="btn_custom" value="View" style="margin: 2px;">
                          </form>
                        </td>
                        <td style="text-align: center;">
                          <a href="edit_blogs.php?id=<?php echo $value['blog_id'];?>" class="btn_custom" style="margin: 2px;">Edit</a>
                        </td>
                      </tr>

                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        <?php
        }
        ?>
          
      </div>
      <!-- /.container-fluid -->

      
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
