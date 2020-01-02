<?php
include 'includes\header.php';
session_start();
include 'includes\functions.php';
include 'includes\navigation.php';

if(isset($_GET['post_id'])){
  $post_id = $_GET['post_id'];
  $stmt = viewPost($post_id);
}
mysqli_stmt_bind_result($stmt, $post_id, $user_id, $user_firstname, $user_lastname, $user_image,$category_id, $category_name,$post_status_id, $post_status_name,$post_title, $post_content, $post_image, $post_tags, $post_date);

while (mysqli_stmt_fetch($stmt)) {
  $post_date    = date("d-m-Y", strtotime($post_date));
  ?>

  <div class="mx-5 mt-5">
    <div class="text-center">
      <span class="display-3"><?php echo $post_title; ?></span> <small>(title)</small>
    </div>

    <h5 class="lead">
      <img src="images/<?php echo $user_image; ?>" width="auto" height="65" class="rounded">
      <span style="font-size:2.2rem;" class="mt-2"><?php echo $user_firstname. ". ". $user_lastname; ?></span>
      <small class="text-muted">(author)</small>
    </h5>

    <p class="lead">
      <span style="font-weight: 400; font-size:1.5rem">Category: </span>
      <?php echo $category_name; ?>
      <br>
      <span style="font-weight: 400; font-size:1.5rem">Posted on: </span>
      <?php echo $post_date; ?>
      <br>
    </p>

    <div class="row">
      <div class="col-12 col-md-6">
        <img src="posts/post-images/<?php echo $post_image; ?>" class="rounded img-fluid">
      </div>
      <div class="col-12 col-md-6">
        <p><?php echo $post_content; ?></p>
      </div>

    </div>

  </div>




  <?php
}
include 'includes\footer.php';
?>
