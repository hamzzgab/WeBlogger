

<?php

  $user_id = $_SESSION['user_id'];
  $stmt = selectUsersPost($user_id);
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
      while (mysqli_stmt_fetch($stmt)) {
        $post_content = trim(substr($post_content, 0, 45));
        $post_content = $post_content . "...";
        $post_date    = date("d-m-Y", strtotime($post_date));
      ?>
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
            <a href="../post.php?post_id=<?php echo $post_id; ?>">
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
          <td class="text-center">
              <form class="" action="" method="post" onsubmit="return confirm('Are you sure?')">
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                <input type="hidden" name="post_status_id" value="<?php echo $post_status_id; ?>">
                <input type="hidden" name="post_status_name" value="<?php echo $post_status_name; ?>">
                <span  class="badge badge-pill badge-<?php if ($post_status_name == 'Draft') {echo "danger"; }else{ echo "primary"; }?>">
                  <input type="submit" name="change_status" value="<?php echo $post_status_name; ?>" style="background: none; border:none; font-weight: 600; font-size: 0.9rem;" class="text-light">
                </span>
              </form>
          </td>
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
  if (isset($_POST['change_status'])) {
    $post_id          = $_POST['post_id'];
    $post_status_id   = $_POST['post_status_id'];
    $post_status_name = $_POST['post_status_name'];

    if ($post_status_name == 'Draft') {
      $post_status_id = '2';
      changePostStatus($post_status_id, $post_id);
    }elseif ($post_status_name == 'Publish') {
      $post_status_id = '1';
      changePostStatus($post_status_id, $post_id);
    }
  }
?>
