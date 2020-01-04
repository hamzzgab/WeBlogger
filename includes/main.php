<div class="row mx-3">
  <?php
  if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $stmt = selectPostsWithCategory($category_id);
  }else if(isset($_POST['search'])){
    $search = $_POST['search_for'];
    $stmt = searchPosts($search);
  }else{
    $stmt = selectPostsWithStatus('Publish');
  }

  mysqli_stmt_bind_result($stmt, $post_id, $user_id, $user_firstname, $user_lastname, $user_image,$category_id, $category_name,$post_status_id, $post_status_name,$post_title, $post_content, $post_image, $post_tags, $post_date);

  while (mysqli_stmt_fetch($stmt)) {
    $post_content = trim(substr($post_content, 0, 40));
    $post_content = $post_content . "...";
    $post_date    = date("d-m-Y", strtotime($post_date));
    ?>
    <div class="col-12 col-md-6 col-lg-4 my-3">
      <?php include 'includes\view_blog_card.php'; ?>
    </div>

  <?php
    }
  ?>
</div>
