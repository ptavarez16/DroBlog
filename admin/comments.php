<?php
  include "includes/header.php";
?>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
          <?php include "includes/navbar.php";?>
          <?php include "includes/sidebar.php";?>
        </nav>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin
                            <small>Comments</small>
                        </h1>
                        
                        <?php
                          if(isset($_GET['source'])) {
                            $source = $_GET['source'];
                          } else {
                            $source = '';
                          }
                          switch($source) {
                            case 'add_comment';
                              include "includes/add_comment.php";
                            break;
                            case 'update_comment';
                              include "includes/update_comment.php";
                            break;
                            default:
                            include "includes/fetch_comments.php";
                          }
                        ?>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
<?php include "includes/footer.php";?>
