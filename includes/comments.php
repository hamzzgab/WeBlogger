<div class="row my-3 mb-5">

  <div class="col-12">
    <h1 class="display-4">Comments</h1>


    <?php if (!isLoggedout()): ?>
    <div class="d-flex align-items-start">
        <img  class="rounded rounded-lg" src="images/<?php echo $_SESSION['user_image']; ?>" width="70" height="70">
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
      $comment_content  = $row['comment_content'];
      $user_firstname   = $row['user_firstname'];
      $user_lastname    =$row['user_lastname'];
      $user_image       = $row['user_image'];
      $comment_date     = date("d-m-Y", strtotime($row['comment_date']));
      ?>


      <div class="row">
        <div class="col-12 col-md-9">
          <div class="d-flex align-items-start">
            <?php if (!empty($user_image)): ?>
              <img  class="rounded rounded-lg" src="images/default-profile.png" width="70" height="70">
            <?php else: ?>
              <img  class="rounded rounded-lg" src="images/<?php echo $user_image; ?>" width="70" height="70">
            <?php endif; ?>


            <div class="pl-2">
              <div class="lead d-flex justify-content-between">
                <span style="font-size: 1.7rem;" class="d-block"><?php echo $user_firstname.". ".$user_lastname; ?></span>
                <small class="text-muted d-block pl-2"><?php echo $comment_date; ?></small>
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
