<div class="row m-0">

  <?php
  if (isset($_POST['login'])) {
    $user_email = escape($_POST['user_email']);
    $user_password = escape($_POST['user_password']);
    loginUser($user_email, $user_password);
  }
  ?>

  <?php if (!empty($_SESSION['user_email'])): ?>
    <div class="col-12 col-md-3 my-3 mx-3">
      <div class="card text-white bg-success">
        <div class="card-header" style="font-weight: 600; font-size: 1.2rem;">
          <?php echo $_SESSION['user_firstname'] . '. ' . $_SESSION['user_lastname']; ?>
        </div>
        <img src="images/<?php echo $_SESSION['user_image']; ?>" class="card-img-top" alt="">
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
          <a href="./includes/logout.php" class="btn btn-danger border-white">Logout</a>
        </div>

      </div>
    </div>


  <?php else: ?>
    <div class="col-12 col-md-3 my-3 mx-3">
      <div class="card border-danger">
        <div class="card-header text-center bg-warning border-danger">
          <span style="font-weight: 600; font-size: 1.2rem;">
            Login
          </span>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <form class="" action="" method="post">
              <input type="text" name="user_email" class="form-control" placeholder="Email">
              <input type="password" name="user_password" class="form-control my-2" placeholder="Password">
              <input type="submit" name="login" value="Sign In" class="form-control btn btn-success ">
            </form>
          </li>
          <li class="list-group-item">
            <a href="./register.php" class="form-control btn btn-primary">Sign Up</a>
          </li>
        </ul>
      </div>
    </div>
  <?php endif; ?>




  <div class="col-12 col-md-8 my-3 mx-3">
    <div class="card border-primary">
      <div class="card-header border-primary d-flex justify-content-between">
        <span style="font-weight: 600; font-size: 1.2rem;">
          <img src="images/27.jpg" width="25" height="25" class="rounded rounded-circle">
          Hamza. Gabajiwala
        </span>
        <span>
          2 days ago
        </span>
      </div>
      <div class="card-body">
        <div class="text-center">
          <h5 class="card-title">Special title treatment</h5>
        </div>

        <img src="images/27.jpg" class="card-img-top" alt="...">

      </div>
      <div class="card-footer border-primary">
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>


</div>
