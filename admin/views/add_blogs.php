<?php

date_default_timezone_set("Asia/Kolkata");

error_reporting(0);
session_start();

if (!isset($_SESSION['adm_Id'])) {
  header('Location: login.php');
}
include 'header.php';
include '../Admin_modules/manage_blogs.php';
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

        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-newspaper"></i>&nbsp;&nbsp;
            Add Blogs</div>
          <div class="card-body">

            <form action="../Admin_modules/blog_add.php" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <div class="form-label-group"> 
                      <input type="text" id="bl_title" name="bl_title" class="form-control" placeholder="Blog Title" autofocus="autofocus">
                      <label for="bl_title">Blog Title</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group"> 
                      <input type="text" id="bl_url" name="bl_url" maxlength="255" pattern="https?://.+" class="form-control" placeholder="URL (http://www.example.com)" autofocus="autofocus" required>
                      <label for="bl_url">URL (http://www.example.com)</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="file" id="bl_img" name="bl_img" class="form-control" placeholder="Blog Image" accept="image/*" required>
                      
                      <label for="bl_img">Blog Image</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group"> 
                      <textarea type="text" id="bl_desc" name="bl_desc" class="form-control" rows="15" placeholder="Blog Description" autofocus="autofocus" required></textarea>
                    </div>
                  </div>
                  <button class="btn_custom" type="submit" name="submit">Submit Blog</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->

      <script src="ckeditor/ckeditor.js"></script>
      <script>
        CKEDITOR.replace( 'bl_desc', {
        toolbar: [
        { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
        { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
        { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
        { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
        '/',
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
        { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
        { name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
        '/',
        { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
        { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
        { name: 'others', items: [ '-' ] },
        { name: 'about', items: [ 'About' ] }
    ]
    });

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
