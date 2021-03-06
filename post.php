<?php include "includes/db.php";?>
<?php include "includes/header.php";?>
<!-- Navigation -->
  <?php include "includes/navigation.php";?>
  <!-- Page Content -->
  <div class="container">

      <div class="row">

          <!-- Blog Entries Column -->
          <div class="col-md-8">
            
            <?php
            if(isset($_GET['p_id'])) {
              $post_id = $_GET['p_id'];
              
              $views_query = "UPDATE posts SET
                                views = views + 1
                              WHERE id = $post_id";
              $viewsUp = mysqli_query($connection, $views_query);
              confirm($viewsUp);
            
              $query = "SELECT * FROM posts WHERE id = $post_id";
              
              $fetchPosts = mysqli_query($connection, $query);
              
              while($row = mysqli_fetch_assoc($fetchPosts)) {
                $post_title = $row['title'];
                $post_author = $row['author'];
                $post_date = $row['date'];
                $post_image = $row['image'];
                $post_content = $row['content'];
                
                ?>
                <h1 class="page-header">
                    <?php echo $post_title;?>
                </h1>
                <!-- Blog Posts -->
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author;?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date;?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content;?></p>

                <hr>
            <?php
                }
              } else {
                header("Location: index.php");
              }
            ?>
            <?php include "includes/comments.php";?>
          </div>

          <!-- Blog Sidebar Widgets Column -->
          <?php include "includes/sidebar.php";?>
          
      </div>
      <!-- /.row -->

      <hr>
<?php include "includes/footer.php";?>
