<?php
include 'includes\header.php';
session_start();
include 'includes\functions.php';
include 'includes\navigation.php';

if (isset($_POST['login'])) {
  $user_email = escape($_POST['user_email']);
  $user_password = escape($_POST['user_password']);
  loginUser($user_email, $user_password);
}

if (isLoggedout()) { ?>

<div class="container d-flex justify-content-center" style="margin-top: 150px;">
  <div class="card login-border" style="width: 20rem;">
    <div class="card-header text-center text-color-login login-border card-header-footer-bg display-3 pt-0">Login</div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">
        <form class="" action="" method="post">
          <input type="text" name="user_email" class="form-control" placeholder="Email">
          <input type="password" name="user_password" class="form-control my-2" placeholder="Password">
          <input type="submit" name="login" value="Sign In" class="form-control btn sign-in-bg text-white">
        </form>
      </li>
      <li class="list-group-item">
        <a href="./register.php" class="form-control btn sign-up-bg text-white">Sign Up</a>
      </li>
    </ul>
  </div>

</div>


<?php
}else{
  header("Location: ./index.php");
}
 include 'includes/footer.php'; ?>
