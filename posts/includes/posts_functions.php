<?php
function deletePost($post_id){
  global $connection;

  $stmt = mysqli_prepare($connection, "DELETE FROM posts WHERE post_id = ?");
  mysqli_stmt_bind_param($stmt, "i", $post_id);
  mysqli_stmt_execute($stmt);
  confirmQuery($stmt);

  header("Location: ./posts.php");
}

function editPost($post_id, $user_id, $category_id, $post_status_id,$post_title, $post_content, $tmp_post_image, $post_image, $post_tags){
  global $connection;

  if (empty($post_image)) {
    $query = mysqli_query($connection, "SELECT post_image FROM posts WHERE post_id = $post_id");
    confirmQuery($query);
    while($row = mysqli_fetch_assoc($query)){
      $post_image = $row['post_image'];
    }
  }

  move_uploaded_file($tmp_post_image, "post-images/$post_image");

  $stmt = mysqli_prepare($connection, "UPDATE posts SET user_id = ?, category_id = ?, post_status_id = ?, post_title = ?, post_content = ?, post_image = ?, post_tags = ?, post_date = now()");
  confirmQuery($stmt);
  mysqli_stmt_bind_param($stmt, "iiissss", $user_id, $category_id, $post_status_id, $post_title, $post_content, $post_image, $post_tags);
  mysqli_stmt_execute($stmt);
}

function addPost($user_id, $category_id, $post_status_id,$post_title, $post_content, $tmp_post_image,$post_image, $post_tags){
  global $connection;

  move_uploaded_file($tmp_post_image, "post-images/$post_image");

  $stmt = mysqli_prepare($connection, "INSERT INTO posts(user_id, category_id, post_status_id,post_title, post_content, post_image, post_tags, post_date) VALUES(?,?,?,?,?,?,?, now())");
  mysqli_stmt_bind_param($stmt, "iiissss", $user_id, $category_id, $post_status_id,$post_title, $post_content, $post_image, $post_tags);
  mysqli_stmt_execute($stmt);
  confirmQuery($stmt);

  header("Location: ./posts.php");
}
?>
