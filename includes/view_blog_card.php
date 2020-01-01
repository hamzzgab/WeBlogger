<div class="card border-primary">
  <div class="card-header border-primary d-flex justify-content-between">
    <span style="font-weight: 600; font-size: 1.2rem;">
      <img src="images/<?php echo $user_image; ?>" width="25" height="25" class="rounded rounded-circle">
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

    <img src="posts/post-images/<?php echo $post_image; ?>" class="card-img-top">

  </div>
  <div class="card-footer border-primary">
    <p class="card-text"><?php echo $post_content; ?></p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
