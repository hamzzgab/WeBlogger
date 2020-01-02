<div class="card border-success" style="color: #0000000; width: 20rem;">
  <div class="card-header border-success" style="font-weight: 600; font-size: 1.2rem;">
    <?php echo $_SESSION['user_firstname'] . '. ' . $_SESSION['user_lastname']; ?>
  </div>
  <?php if (!empty($_SESSION['user_image'])): ?>
    <div class="p-1">
      <img src="images/<?php echo $_SESSION['user_image']; ?>" class="card-img-top rounded rounded-lg" alt="">
    </div>
  <?php endif; ?>

  <div class="card-body" >
    <p class="card-text text-center" style="font-size: 1.19rem;">
      <i class="fa fa-envelope"></i> <span><?php echo $_SESSION['user_email']; ?> </span>
      <br>
      <i class="fa fa-user"></i> <span><?php echo $_SESSION['username']; ?> </span>
      <br>
      <i class="fa fa-phone"></i> <span><?php echo $_SESSION['user_phonenumber']; ?> </span>
      <br>
      <i class="fa fa-calendar"></i> <span><?php echo $_SESSION['user_dob']; ?> </span>
    </p>
  </div>

  <div class="card-footer border-success d-flex justify-content-between">
    <a href="" class="btn btn-primary border-dark">Profile</a>
    <form class="" action="./includes/logout.php" method="post">
      <input type="submit" name="logout" value="Logout" class="form-control btn btn-danger border-dark">
    </form>
  </div>
</div>

<!-- <div class="d-flex justify-content-center" style="width: 20rem;">
  <a  class="btn btn-primary text-white mt-3" href="./posts/posts.php?source=add_post" style="padding-left: 100px; padding-right: 100px;">
    <i class="fa fa-edit"></i> Write a New Post
  </a>
</div> -->
