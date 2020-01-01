<?php
  if (isset($_POST['add_post'])) {
    $user_id          = $_SESSION['user_id'];
    $category_id      = escape($_POST['category_id']);
    $post_status_id      = escape($_POST['post_status_id']);
    $post_title       = escape($_POST['post_title']);
    $post_content     = escape($_POST['post_content']);
    $post_image       = $_FILES['image']['name'];
    $tmp_post_image   = $_FILES['image']['tmp_name'];
    $post_tags        = escape($_POST['post_tags']);

    $error = [
      'post_title' => '',
      'post_content' => '',
    ];

    if (empty($_POST['post_title'])) {
      $error['post_title'] = 'Blog title cannot be empty';
    }

    if (empty($_POST['post_content'])) {
      $error['post_content'] = 'Blog content cannot be empty';
    }

    if (strlen($_POST['post_content']) < 45) {
      $error['post_content'] = 'Minimum 10-15 words in the blog';
    }

    foreach ($error as $key => $value) {
      if (empty($value)) {
        unset($error[$key]);
      }
    }

    if (empty($error)) {
      addPost($user_id, $category_id, $post_status_id,$post_title, $post_content, $tmp_post_image, $post_image, $post_tags);
    }



  }
?>

<div class="mx-5 my-3">
  <h5 class="display-4">
    New Blog
  </h5>
  <form class="" action="" method="post" enctype="multipart/form-data">
    <label for="" class="mt-3">Blog Title</label>
    <input type="text" name="post_title" class="form-control" value="<?php if (isset($_POST['add_post'])) {
      echo $_POST['post_title'];
    } ?>">
    <?php if (isset($error['post_title'])): ?>
      <p class="text-danger">
        <?php echo $error['post_title']; ?>
      </p>
    <?php endif; ?>



    <label class="mt-3">Blog Content</label>
    <textarea name="post_content" class="form-control" rows="8" cols="80" id="body"><?php if (isset($_POST['add_post'])) {
      echo $_POST['post_content'];
    } ?></textarea>
    <?php if (isset($error['post_content'])): ?>
      <p class="text-danger">
        <?php echo $error['post_content']; ?>
      </p>
    <?php endif; ?>

    <div class="row">
      <div class="col-12 col-md-3">
        <label class="mt-3">Blog Image</label> <br>
        <input type="file" name="image">
      </div>
      <!--  BLOG images -->
      <div class="col-12 col-md-3">
        <label class="mt-3">Blog Category</label>
        <select class="form-control" name="category_id">
          <?php
            $stmt = mysqli_prepare($connection, "SELECT category_id, category_name FROM categories ORDER BY category_name ASC");
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt,$category_id, $category_name);
            confirmQuery($stmt);
            while(mysqli_stmt_fetch($stmt)){ ?>
              <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
          <?php
            }
          ?>
        </select>
      </div>
      <!-- BLOG CATEGORIES -->
      <div class="col-12 col-md-3">
        <label class="mt-3">Blog Tags</label>
        <textarea name="post_tags" class="form-control"><?php if (isset($_POST['add_post'])) { echo $_POST['post_tags']; } ?></textarea>
      </div>
      <!-- BLOG TAGS -->
      <div class="col-12 col-md-3">
        <label class="mt-3">Blog Status</label>
        <select class="form-control" name="post_status_id">
          <?php
            $stmt = mysqli_prepare($connection, "SELECT post_status_id, post_status_name FROM post_status");
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt,$post_status_id, $post_status_name);
            confirmQuery($stmt);
            while(mysqli_stmt_fetch($stmt)){ ?>
              <option value="<?php echo $post_status_id; ?>"><?php echo $post_status_name; ?></option>
          <?php
            }
          ?>
        </select>
      </div>
      <!-- BLOG STATUS -->
    </div>

    <input type="submit" name="add_post" value="Submit" class="mt-3 form-control btn btn-outline-primary">

  </form>
</div>
