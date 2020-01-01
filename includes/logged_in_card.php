<div class="card text-white bg-success">
  <div class="card-header" style="font-weight: 600; font-size: 1.2rem;">
    <?php echo $_SESSION['user_firstname'] . '. ' . $_SESSION['user_lastname']; ?>
  </div>
  <?php if (!empty($_SESSION['user_image'])): ?>
    <img src="images/<?php echo $_SESSION['user_image']; ?>" class="card-img-top" alt="">
  <?php endif; ?>

  <div class="card-body">
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

  <div class="card-footer border-white d-flex justify-content-between">
    <a href="" class="btn btn-primary border-white">Profile</a>
    <form class="" action="./includes/logout.php" method="post">
      <input type="submit" name="logout" value="Logout" class="form-control btn btn-danger border-white">
    </form>
  </div>
</div>

<div class="d-flex justify-content-center">
  <a  class="btn btn-primary text-white mt-3 px-5" href="./posts/posts.php?source=add_post">
    <i class="fa fa-edit"></i> Write a New Post
  </a>
</div>
