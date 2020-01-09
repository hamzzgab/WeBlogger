<?php
include 'includes\header.php';
session_start();
include 'includes\functions.php';
include 'includes\navigation.php';

if(isset($_GET['post_id'])){
  $post_id = $_GET['post_id'];
  if (isset($_POST['post_comment'])) {
    $comment_content = escape($_POST['comment_content']);
    $user_id = $_SESSION['user_id'];

    $error = [
      'comment_content' => ''
    ];

    if (empty($comment_content)) {
      $error['comment_content'] = "Please add some content";
    }

    foreach ($error as $key => $value) {
      if (empty($value)) {
        unset($error[$key]);
      }
    }

    if (empty($error)) {
      insertComment($user_id,$post_id,$comment_content);
    }
  }
  $stmt = viewPost($post_id);
}
mysqli_stmt_bind_result($stmt, $post_id, $user_id, $user_firstname, $user_lastname, $user_image,$category_id, $category_name,$post_status_id, $post_status_name,$post_title, $post_content, $post_image, $post_tags, $post_date);

while (mysqli_stmt_fetch($stmt)) {
  $post_date    = date("d-m-Y", strtotime($post_date));
}
?>

<div class="mx-5 mt-3">
  <div class="text-center">
    <span class="display-3"><?php echo $post_title; ?></span> <small>(title)</small>
  </div>

  <h5 class="lead">
    <?php if (empty($user_image)): ?>
      <img src="images/default-profile.png" width="auto" height="65" class="rounded">
    <?php else: ?>
      <img src="images/<?php echo $user_image; ?>" width="auto" height="65" class="rounded">
    <?php endif; ?>


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
      <?php if (!empty($post_image)): ?>
        <img src="posts/post-images/<?php echo $post_image; ?>" class="rounded img-fluid">
      <?php endif; ?>

    </div>
    <div class="col-12 col-md-6">
      <p><?php echo $post_content; ?></p>

      <div class="text-center d-flex justify-content-around">
      <?php if (isset($_SESSION['user_id'])): ?>
          <form class="" action="" method="post">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
            <?php
            $user_id = $_SESSION['user_id'];
            $query = mysqli_query($connection, "SELECT * FROM likes where post_id = $post_id"); ?>

            <input type="submit" name="like" value="Likes : <?php echo mysqli_num_rows($query); ?>" class="btn btn-success btn-sm d-block"
            <?php
            $user_like = mysqli_query($connection, "SELECT * FROM likes where user_id = $user_id AND post_id = $post_id");
            confirmQuery($user_like);
            if (mysqli_num_rows($user_like) > 0) {
              echo "disabled";
            }
            ?>
            >
          </form>
          <form class="" action="" method="post">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
            <?php
            $user_id = $_SESSION['user_id'];
            $query = mysqli_query($connection, "SELECT * FROM dislikes where post_id = $post_id"); ?>

            <input type="submit" name="dislike" value="Dislikes : <?php echo mysqli_num_rows($query); ?>" class="btn btn-danger btn-sm d-block"
            <?php
            $user_like = mysqli_query($connection, "SELECT * FROM dislikes where user_id = $user_id AND post_id = $post_id");
            confirmQuery($user_like);
            if (mysqli_num_rows($user_like) > 0) {
              echo "disabled";
            }
            ?>
            >
          </form>
          <form class="" action="" method="post">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
            <input type="submit" name="reset" value="Reset" class="btn btn-primary btn-sm d-block">
          </form>
      <?php elseif(!isset($_SESSION['user_role'])): ?>
        <button type="submit" name="button" class="btn btn-sm btn-success" disabled>Like</button>
        <button type="submit" name="button" class="btn btn-sm btn-danger" disabled>Dislike</button>
      <?php endif; ?>
    </div>
    </div>

  </div>

  <?php

  $query = mysqli_query($connection, "SELECT comments.comment_id, comments.user_id, users.user_firstname, users.user_lastname, users.user_image, comments.post_id, comments.comment_content, comments.comment_date FROM comments INNER JOIN users ON comments.user_id = users.user_id WHERE comments.post_id = $post_id ORDER BY comments.comment_id DESC");
  confirmQuery($query);
  include 'includes/comments.php';
  ?>

</div>


<?php
if (isset($_POST['like'])) {
  $user_id = $_POST['user_id'];
  $post_id = $_POST['post_id'];

  $stmt = mysqli_prepare($connection, "INSERT INTO likes(user_id, post_id) VALUES(?,?)");
  mysqli_stmt_bind_param($stmt, 'ii', $user_id, $post_id);
  mysqli_stmt_execute($stmt);

  $stmt = mysqli_prepare($connection, "DELETE FROM dislikes WHERE user_id = ? AND post_id = ?");
  mysqli_stmt_bind_param($stmt, 'ii', $user_id, $post_id);
  mysqli_stmt_execute($stmt);

  header("Location: ./post.php?post_id=$post_id");
}

if (isset($_POST['dislike'])) {
  $user_id = $_POST['user_id'];
  $post_id = $_POST['post_id'];

  $stmt = mysqli_prepare($connection, "INSERT INTO dislikes(user_id, post_id) VALUES(?,?)");
  mysqli_stmt_bind_param($stmt, 'ii', $user_id, $post_id);
  mysqli_stmt_execute($stmt);

  $stmt = mysqli_prepare($connection, "DELETE FROM likes WHERE user_id = ? AND post_id = ?");
  mysqli_stmt_bind_param($stmt, 'ii', $user_id, $post_id);
  mysqli_stmt_execute($stmt);

  header("Location: ./post.php?post_id=$post_id");
}

if (isset($_POST['reset'])) {
  $user_id = $_POST['user_id'];
  $post_id = $_POST['post_id'];

  $stmt = mysqli_prepare($connection, "DELETE FROM likes WHERE user_id = ? AND post_id = ?");
  mysqli_stmt_bind_param($stmt, 'ii', $user_id, $post_id);
  mysqli_stmt_execute($stmt);


  $stmt = mysqli_prepare($connection, "DELETE FROM dislikes WHERE user_id = ? AND post_id = ?");
  mysqli_stmt_bind_param($stmt, 'ii', $user_id, $post_id);
  mysqli_stmt_execute($stmt);

  header("Location: ./post.php?post_id=$post_id");
}



include 'includes\footer.php';
?>
