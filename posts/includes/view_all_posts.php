

<?php

  $stmt = mysqli_prepare($connection,"SELECT posts.post_id, posts.user_id, posts.category_id, categories.category_name, posts.post_status_id, post_status.post_status_name,posts.post_title, posts.post_content, posts.post_image, posts.post_tags, posts.post_date FROM posts INNER JOIN categories ON posts.category_id = categories.category_id INNER JOIN post_status ON posts.post_status_id = post_status.post_status_id WHERE user_id = ?");
  confirmQuery($stmt);
  $user_id = $_SESSION['user_id'];
  mysqli_stmt_bind_param($stmt, "i", $user_id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $post_id, $user_id, $category_id, $category_name,$post_status_id, $post_status_name,$post_title, $post_content, $post_image, $post_tags, $post_date);

?>



<div class="mx-4 my-4">
  <table class="table table-bordered">
    <thead>
      <td>Delete</th>
      <td>Edit</th>
      <td>View</th>
      <th class="text-center">Id</th>
      <th class="text-center">Title</th>
      <th class="text-center px-3">Content</th>
      <th class="text-center">Image</th>
      <th class="text-center">Tags</th>
      <th class="text-center">Posted on</th>
      <th class="text-center">Category</th>
      <th class="text-center">Status</th>
    </thead>
    <tbody>

      <?php
      while (mysqli_stmt_fetch($stmt)) { ?>
        <tr>
          <td class="text-center">
            <form class="" action="" method="post" onsubmit="return confirm('Are you sure you want to delete?');">
              <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
              <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            </form>
          </td>

          <td class="text-center">
            <a href="./posts.php?source=edit_post&post_id=<?php echo $post_id; ?>">
              <i class="fa fa-edit text-primary fa-lg"></i>
            </a>
          </td>

          <td class="text-center">
            <a href="../trek.php?trek_id=<?php echo $trek_id; ?>">
              <i class="fa fa-eye text-dark fa-sm"></i>
            </a>
          </td>

          <td class="text-center"><?php echo $post_id; ?></td>
          <td class="text-center"><?php echo $post_title; ?></td>
          <td class="text-center"><?php echo $post_content; ?></td>
          <td class="text-center" ><img src="post-images/<?php echo $post_image; ?>" width="200" height="100"></td>
          <td class="text-center" ><?php echo $post_tags; ?></td>
          <td class="text-center" ><?php echo $post_date; ?></td>
          <td class="text-center"><?php echo $category_name; ?></td>
          <td class="text-center"><?php echo $post_status_name; ?></td>
        </tr>

      <?php
        }
      ?>


    </tbody>
  </table>
</div>


<?php
  if (isset($_POST['delete'])) {
    $trek_id = $_POST['post_id'];
    deletePost($post_id);
  }
?>
