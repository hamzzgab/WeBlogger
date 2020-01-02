<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand">WeBlogger</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="./">Home <span class="sr-only">(current)</span></a>
      </li>
      <?php if (isLoggedout()): ?>
        <li class="nav-item">
          <a class="nav-link" href="./login.php">Login</a>
        </li>
      <?php else: ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Posts
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="posts/posts.php">View My Posts</a>
            <a class="dropdown-item" href="posts/posts.php?source=add_post">Write a new post</a>
          </div>
        </li>

      <?php endif; ?>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php
          $stmt = selectAllCategories();
          mysqli_stmt_bind_result($stmt, $category_id, $category_name);
          while(mysqli_stmt_fetch($stmt)){
            ?>
            <a href="./index.php?category_id=<?php echo $category_id; ?>" class="dropdown-item"><?php echo $category_name; ?></a>
            <?php
          }
          ?>
        </div>
      </li>

      <?php
      if (isLoggedout()):
        ?>
        <form class="form-inline" action="" method="post">
          <input class="form-control mr-2" type="text"     placeholder="Email"    name="user_email" >
          <input class="form-control mr-2" type="password" placeholder="Password" name="user_password" >
          <input class="form-control mr-2 btn btn-success" type="submit" name="login" value="Login">
          <a href="./register.php" class="form-control btn btn-light">Sign Up</a>
        </form>
        <?php
    endif;
    ?>
  </ul>

  <ul class="navbar-nav ml-auto">
    <?php if (!isLoggedout()): ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="images/<?php echo $_SESSION['user_image']; ?>" class="rounded" width="25" height="25">
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Profile</a>
          <a class="dropdown-item">
            <form class="" action="includes/logout.php" method="post">
              <input type="submit" name="logout" value="Logout" class="btn btn-danger">
            </form>
          </a>
        </div>
      </li>
    <?php endif; ?>
  </ul>

  <form class="form-inline my-2 my-lg-0" action="" method="post">
    <input class="form-control mr-sm-2" placeholder="Search"  name="search_for">
    <input type="submit" name="search" value="Search" class="form-control btn btn-outline-light mt-2 mt-sm-0">
  </form>

</nav>
