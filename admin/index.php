<?php include "includes/header.php";?>
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
                            Welcome to the Admin
                            <small><?php echo $_SESSION['username']?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                <div class="row">
                  <div class="col-lg-3 col-md-6">
                      <div class="panel panel-yellow">
                          <div class="panel-heading">
                              <div class="row">
                                  <div class="col-xs-3">
                                      <i class="fa fa-users fa-5x"></i>
                                  </div>
                                  <div class="col-xs-4 text-right">
                                    <?php
                                      $query = "SELECT * FROM users";
                                      $fetch_users = mysqli_query($connection,$query);
                                      $users_count = mysqli_num_rows($fetch_users);
                                    ?>
                                  <div class='huge'><?php echo $users_count; ?></div>
                                      <div>Users</div>
                                  </div>
                                  <div class="col-xs-5 text-right">
                                    <div class='huge usersonline'></div>
                                        <div>Online Users</div>
                                  </div>
                              </div>
                          </div>
                          <a href="users.php">
                              <div class="panel-footer">
                                  <span class="pull-left">View Users</span>
                                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                  <div class="clearfix"></div>
                              </div>
                          </a>
                      </div>
                  </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-pencil-square-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php
                                      $query = "SELECT * FROM posts";
                                      $fetch_posts = mysqli_query($connection,$query);
                                      $posts_count = mysqli_num_rows($fetch_posts);
                                    ?>
                                  <div class='huge'><?php echo $posts_count; ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Posts</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                      <?php
                                        $query = "SELECT * FROM categories";
                                        $fetch_categories = mysqli_query($connection,$query);
                                        $categories_count = mysqli_num_rows($fetch_categories);
                                      ?>
                                        <div class='huge'><?php echo $categories_count; ?></div>
                                         <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Categories</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                      <?php
                                        $query = "SELECT * FROM comments";
                                        $fetch_comments = mysqli_query($connection,$query);
                                        $comments_count = mysqli_num_rows($fetch_comments);
                                      ?>
                                     <div class='huge'><?php echo $comments_count; ?></div>
                                      <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Comments</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <?php
                  $query = "SELECT * FROM users WHERE role = 'subscriber'";
                  $fetch_subscribers = mysqli_query($connection,$query);
                  $subscribers_count = mysqli_num_rows($fetch_subscribers);
                ?>
                
                <div class="row">
                  <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                      var data = google.visualization.arrayToDataTable([
                        ['Data', 'Count'],
                        <?php
                          $text = ['Users', 'Subscribers', 'Active Posts', 'Categories', 'Comments'];
                          $count = [$users_count, $subscribers_count, $posts_count, $categories_count, $comments_count];
                          
                          for($i = 0; $i < count($text); $i++) {
                            echo "['{$text[$i]}', {$count[$i]}],";
                          }
                        ?>
                      ]);

                      var options = {
                        chart: {
                          title: '',
                          subtitle: '',
                        }
                      };

                      var chart = new google.charts.Bar(document.getElementById('columnchart'));

                      chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                  </script>
                  <div id="columnchart" style="width: 'auto'; height: 500px;"></div>
                </div>
                <!-- /.row -->
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
<?php include "includes/footer.php";?>
