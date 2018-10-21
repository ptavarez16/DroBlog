<?php
  if(isset($_POST['checkBoxArray'])) {
    foreach($_POST['checkBoxArray'] as $box_id) {
      $bulk_options = $_POST['bulk_options'];
      
      switch($bulk_options) {
        case 'published':
          $query = "UPDATE posts SET
                      status = '{$bulk_options}'
                    WHERE id = $box_id";
          $to_published = mysqli_query($connection, $query);
          confirm($to_published);
        break;
        case 'draft':
          $query = "UPDATE posts SET
                      status = '{$bulk_options}'
                    WHERE id = $box_id";
          $to_draft = mysqli_query($connection, $query);
          confirm($to_draft);
        break;
        case 'delete':
          $query = "DELETE FROM posts WHERE id = {$box_id}";
          $bulk_delete = mysqli_query($connection, $query);
          confirm($bulk_delete);
        break;
      }
    }
  }
?>

<form class="" action="" method="post">
  <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <div class="col-xs-6 col-md-4" id="bulkOptionsContainer">
        <select class="form-control" name="bulk_options">
          <option selected disabled>Options</option>
          <option value="published">Publish</option>
          <option value="draft">Draft</option>
          <option value="delete">Delete</option>
        </select>
      </div>
      <div class="col-xs-6 col-md-4">
        <input type="submit" name="submit" value="Apply" class="btn btn-success">
        <a class="btn btn-primary" href="?source=add_post">New Post</a>
      </div>
      <thead>
        <tr>
          <th><input id="selectAll" type="checkbox"></th>
          <th>ID</th>
          <th>Category</th>
          <th>Title</th>
          <th>Author</th>
          <th>Date</th>
          <th>Image</th>
          <th>Content</th>
          <th>Tags</th>
          <th>Comment Count</th>
          <th>Status</th>
          <th>Update</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
      <?php
      $query = "SELECT * FROM posts";
      $fetchPosts = mysqli_query($connection, $query);
      
      while($row = mysqli_fetch_assoc($fetchPosts)) {
        $post_id = $row['id'];
        $post_cat_id = $row['category_id'];
        $post_title = $row['title'];
        $post_author = $row['author'];
        $post_date = $row['date'];
        $post_image = $row['image'];
        $post_content = $row['content'];
        $post_tags = $row['tags'];
        $post_comments = $row['comment_count'];
        $post_status = $row['status'];
        
        $query2 = "SELECT * FROM categories WHERE id = $post_cat_id";
        $fetchCat = mysqli_query($connection, $query2);
        
        confirm($fetchCat);

        echo "<tr>";
          echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='{$post_id}'></td>";
          echo "<td>{$post_id}</td>";
          while($row = mysqli_fetch_assoc($fetchCat)) {
            $cat_title = $row['title'];
            echo "<td>{$cat_title}</td>";
          }
          echo "<td>{$post_title}</td>";
          echo "<td>{$post_author}</td>";
          echo "<td>{$post_date}</td>";
          echo "<td><img width='100' src='../images/$post_image' alt='$post_image'></td>";
          echo "<td>{$post_content}</td>";
          echo "<td>{$post_tags}</td>";
          echo "<td>{$post_comments}</td>";
          echo "<td>{$post_status}</td>";
          echo "<td class='text-center'>
                  <a href='posts.php?source=update_post&p_id={$post_id}' class='btn btn-warning'></a>
                </td>";
          echo  "<td class='text-center'>
                  <a href='posts.php?delete={$post_id}' class='btn btn-danger'></a>
                </td>";
        echo "</tr>";
      }
      ?>
      </tbody>
    </table>
  </div>
</form>

<?php
  if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    $query = "DELETE FROM posts WHERE id = {$id}";
    $delete_post = mysqli_query($connection, $query);
    header("Location: posts.php");
  }
?>
