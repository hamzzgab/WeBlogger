<div class="card card-border">
  <div class="card-header d-flex justify-content-between card-border card-header-footer-bg">
    <span style="font-weight: 600; font-size: 1.2rem;">
      <?php if (empty($user_image)): ?>
        <img src="images/default-profile.png" width="25" height="25" class="rounded">
      <?php else: ?>
        <img src="images/<?php echo $user_image; ?>" width="25" height="25" class="rounded">
      <?php endif; ?>

      <?php echo $user_firstname. ". ". $user_lastname; ?>
    </span>
    <span>
      <?php echo $post_date; ?>
    </span>
  </div>
  <div class="card-body">
    <div class="text-center">
      <h5 class="card-title"><?php echo $post_title; ?></h5>
    </div>

    <?php if (!empty($post_image)): ?>
      <img src="posts/post-images/<?php echo $post_image; ?>" class="card-img-top rounded rounded-lg">
    <?php endif; ?>


  </div>
  <div class="card-footer d-flex justify-content-between card-border card-header-footer-bg">
    <div class="card-text"><?php echo $post_content; ?></div>
    <a href="./post.php?post_id=<?php echo $post_id; ?>" class="btn text-white read-more-btn">Read More</a>
  </div>
</div>
