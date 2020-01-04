<?php if (isset($_GET['post_id'])):
  $post_id = $_GET['post_id'];
  if (isset($_POST['edit_post'])) {
    $user_id          = $_SESSION['user_id'];
    $category_id      = escape($_POST['category_id']);
    $post_status_id   = escape($_POST['post_status_id']);
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
      editPost($post_id, $user_id, $category_id, $post_status_id,$post_title, $post_content, $tmp_post_image, $post_image, $post_tags);
    }
  }
  ?>

  <div class="mx-5 my-3">
    <?php
    $query = "SELECT posts.post_id, posts.user_id, posts.category_id, categories.category_name, posts.post_status_id, ";
    $query .= "post_status.post_status_name,posts.post_title, posts.post_content, posts.post_image, posts.post_tags, ";
    $query .= "posts.post_date FROM posts INNER JOIN categories ON posts.category_id = categories.category_id INNER JOIN ";
    $query .= "post_status ON posts.post_status_id = post_status.post_status_id WHERE post_id = $post_id";
    $query = mysqli_query($connection, $query);
    confirmQuery($query);
    while($row = mysqli_fetch_assoc($query)){
      $post_id =$row['post_id'];
      $category_id = $row['category_id'];
      $category_name = $row['category_name'];
      $post_status_id = $row['post_status_id'];
      $post_status_name = $row['post_status_name'];
      $post_title = $row['post_title'];
      $post_content = $row['post_content'];
      $post_image = $row['post_image'];
      $post_tags = $row['post_tags'];
      ?>

      <h5 class="header">
        <span class="display-4">
          Edit Blog
        </span>
        <small>
          (<?php echo $post_title; ?>)
        </small>
      </h5>

      <?php if (isset($_POST['edit_post'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Hola!</strong> You just editted your post.
          <a href="../post.php?post_id=<?php echo $post_id; ?>">View it!</a>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <form class="" action="" method="post" enctype="multipart/form-data">
        <label for="" class="mt-3">Blog Title</label>
        <input type="text" name="post_title" class="form-control" value="<?php
        if (isset($_POST['add_post'])) {
          echo $_POST['post_title'];
        }else{
          echo $post_title;
        }
        ?>">
        <?php if (isset($error['post_title'])): ?>
          <p class="text-danger">
            <?php echo $error['post_title']; ?>
          </p>
        <?php endif; ?>



        <label class="mt-3">Blog Content</label>
        <textarea name="post_content" class="form-control" rows="8" cols="80" id="body"><?php if (isset($_POST['add_post'])) {
          echo $_POST['post_content'];
        }else{
          echo $post_content;
        } ?></textarea>
        <?php if (isset($error['post_content'])): ?>
          <p class="text-danger">
            <?php echo $error['post_content']; ?>
          </p>
        <?php endif; ?>

        <div class="row">
          <div class="col-12 col-md-3">
            <label class="mt-3">Blog Image</label> <br>
            <img src="post-images/<?php echo $post_image; ?>" class="rounded rounded-lg img-fluid">
            <input type="file" name="image">
          </div>
          <!--  BLOG images -->
          <div class="col-12 col-md-3">
            <label class="mt-3">Blog Category</label>
            <select class="form-control" name="category_id">

              <option value="<?php echo $category_id; ?>" selected><?php echo $category_name; ?></option>

              <?php
              $query = mysqli_query($connection, "SELECT * FROM categories WHERE category_id != $category_id");
              confirmQuery($query);
              while($row = mysqli_fetch_assoc($query)){
                $category_id = $row['category_id'];
                $category_name = $row['category_name']; ?>
                <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
              <?php } ?>
            </select>
          </div>
          <!-- BLOG CATEGORIES -->
          <div class="col-12 col-md-3">
            <label class="mt-3">Blog Tags</label>
            <textarea name="post_tags" class="form-control"><?php
            if (isset($_POST['add_post'])){
              echo $_POST['post_tags'];
            }else {
              echo $post_tags;
            } ?></textarea>
          </div>
          <!-- BLOG TAGS -->
          <div class="col-12 col-md-3">
            <label class="mt-3">Blog Status</label>
            <select class="form-control" name="post_status_id">
              <option value="<?php echo $post_status_id; ?>" selected><?php echo $post_status_name; ?></option>

              <?php
              $query = mysqli_query($connection, "SELECT * FROM post_status WHERE post_status_id != $post_status_id");
              confirmQuery($query);
              while($row = mysqli_fetch_assoc($query)){
                $post_status_id = $row['post_status_id'];
                $post_status_name = $row['post_status_name']; ?>

                <option value="<?php echo $post_status_id; ?>"><?php echo $post_status_name; ?></option>

              <?php } ?>
            </select>
          </div>
          <!-- BLOG STATUS -->
        </div>

        <input type="submit" name="edit_post" value="Submit" class="mt-3 form-control btn btn-outline-primary">

      </form>
    <?php } ?>
  </div>


<?php endif; ?>
