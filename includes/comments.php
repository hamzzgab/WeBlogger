<div class="row my-3 mb-5">

  <div class="col-12">
    <h1 class="display-4">Comments</h1>


    <?php if (!isLoggedout()): ?>
      <div class="d-flex align-items-start">
        <?php if (empty($_SESSION['user_image'])): ?>
          <img  class="rounded rounded-lg" src="images/default-profile.png" width="70" height="70">
        <?php else: ?>
          <img  class="rounded rounded-lg" src="images/<?php echo $_SESSION['user_image']; ?>" width="70" height="70">
        <?php endif; ?>


        <div class="pl-2">
          <span class="lead" style="font-size: 1.7rem;">
            <?php echo $_SESSION['user_firstname'].". ".$_SESSION['user_lastname']; ?>
          </span>

          <form class="" action="" method="post">
            <div class="input-group">
              <textarea name="comment_content" class="form-control" cols="100" rows="4" placeholder="Add a comment" required></textarea>
              <p class="text-danger">
                <?php if (isset($error['comment_content'])): ?>
                  <?php echo $error['comment_content']; ?>
                <?php endif; ?>
              </p>
              <div class="input-group-append">
                <span class="input-group-text">
                  <input type="submit" name="post_comment" value="Submit" class="form-control btn btn-success">
                </span>
              </div>
            </div>
          </form>
        </div>
      </div>
    <?php else: ?>
      <p class="lead text-danger" style="font-size: 2.5rem;">
        Log in to add comments
      </p>
    <?php endif; ?>

    <hr>

    <?php
    while ($row = mysqli_fetch_assoc($query)) {
      $comment_id       = $row['comment_id'];
      $user_id          = $row['user_id'];
      $comment_content  = $row['comment_content'];
      $user_firstname   = $row['user_firstname'];
      $user_lastname    = $row['user_lastname'];
      $user_image       = $row['user_image'];
      $comment_date     = date("d-m-Y", strtotime($row['comment_date']));
      ?>


      <div class="row">
        <div class="col-12 col-md-9">
          <div class="d-flex align-items-start">
            <?php if (empty($user_image)): ?>
              <img  class="rounded rounded-lg" src="images/default-profile.png" width="70" height="70">
            <?php else: ?>
              <img  class="rounded rounded-lg" src="images/<?php echo $user_image; ?>" width="70" height="70">
            <?php endif; ?>


            <div class="pl-2">
              <div class="lead d-flex justify-content-between">
                <span style="font-size: 1.7rem;" class="d-block"><?php echo $user_firstname.". ".$user_lastname; ?></span>
                <form class="" action="" method="post" onsubmit="return confirm('Are you sure you want to delete?')">
                  <small class="text-muted d-block pl-5"><?php echo $comment_date; ?>
                    <input type="hidden" name="comment_id" value="<?php echo $comment_id; ?>">
                    <?php if ($_SESSION['user_id'] == $user_id): ?>
                      <input type="submit" name="comment_delete" value="Delete" class="btn btn-danger">
                    <?php endif; ?>

                  </small>
                </form>
              </div>
              <p class="text-justify">
                <?php echo $comment_content; ?>
              </p>
            </div>
          </div>
        </div>
      </div>

      <hr>
    <?php
      }
    ?>
  </div>
</div>


<?php
if (isset($_POST['comment_delete'])) {
  $comment_id = $_POST['comment_id'];

  $stmt = mysqli_prepare($connection, "DELETE FROM comments WHERE comment_id = ?");
  mysqli_stmt_bind_param($stmt, 'i', $comment_id);
  confirmQuery($stmt);
  mysqli_stmt_execute($stmt);
  header("Location: ./post.php?post_id=$post_id");
}
?>
