<div class="row m-0 d-flex justify-content-center">
  <?php
  if (isset($_POST['login'])) {
    $user_email = escape($_POST['user_email']);
    $user_password = escape($_POST['user_password']);
    loginUser($user_email, $user_password);
  }
  ?>


  <?php if (!isLoggedout()): ?>
    <!-- if the user is logged in -->
    <div class="col-12 col-md-3 my-3 mx-3">
      <?php include 'includes\logged_in_card.php'; ?>
    </div>
  <?php else: ?>
    <!-- if the user is logged out -->
    <div class="col-12 col-md-3 my-3 mx-3">
      <?php include 'includes/login.php'; ?>
    </div>
  <?php endif;


  $stmt = selectPostsWithStatus('Publish');
  mysqli_stmt_bind_result($stmt, $post_id, $user_id, $user_firstname, $user_lastname, $user_image,$category_id, $category_name,$post_status_id, $post_status_name,$post_title, $post_content, $post_image, $post_tags, $post_date);

  while (mysqli_stmt_fetch($stmt)) {
    $post_content = trim(substr($post_content, 0, 45));
    $post_content = $post_content . "...";
    $post_date    = date("d-m-Y", strtotime($post_date));
  ?>

  <!-- displaying the blog  -->
  <div class="col-12 col-md-8 my-3 mx-3">
    <?php include 'includes\view_blog_card.php'; ?>
  </div>

  <?php
  }
  ?>
</div>
