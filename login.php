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


<div class="card border-danger" style="width: 20rem;">
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

<?php
}else{
  header("Location: ./index.php");
}

?>


<?php include 'includes/footer.php'; ?>
