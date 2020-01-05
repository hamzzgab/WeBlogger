<nav class="navbar navbar-expand-lg navbar-dark nav-bg">
  <a class="navbar-brand">WeBlogger</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="../">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Posts
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item
            <?php if ($_GET['source'] === 'view_all_posts'): ?> active <?php endif; ?>"
            href="./posts.php?source=view_all_posts">
            View My Posts
          </a>
          <a class="dropdown-item
            <?php if ($_GET['source'] === 'add_post'): ?> active <?php endif; ?>"
            href="./posts.php?source=add_post">
            New Post
          </a>
        </div>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <?php if (!isLoggedout()): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php if (empty($_SESSION['user_image'])): ?>
              <img  class="rounded" src="../images/default-profile.png" width="30" height="30">
            <?php else: ?>
              <img src="../images/<?php echo $_SESSION['user_image']; ?>" class="rounded" width="30" height="30">
            <?php endif; ?>
            <span class="pl-1"><?php echo $_SESSION['username']; ?></span>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Profile</a>
            <a class="dropdown-item">
              <form class="" action="../includes/logout.php" method="post">
                <input type="submit" name="logout" value="Logout" class="btn btn-danger">
              </form>
            </a>
          </div>
        </li>
      <?php endif; ?>
    </ul>
    <form class="form-inline my-2 ml-3 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
