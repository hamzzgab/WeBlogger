<?php

//CHANGE POST STATUS
function changePostStatus($post_status_id, $post_id){
  global $connection;
  
  $stmt = mysqli_prepare($connection, "UPDATE posts SET post_status_id = ? WHERE post_id = ?");
  mysqli_stmt_bind_param($stmt, "ii", $post_status_id, $post_id);
  mysqli_stmt_execute($stmt);
  confirmQuery($stmt);
  header("Location: ./posts.php");
}

//SELECT POSTS
function selectUsersPost($user_id){
  global $connection;

  $query  = "SELECT posts.post_id, posts.user_id, posts.category_id, categories.category_name, posts.post_status_id, ";
  $query .= "post_status.post_status_name,posts.post_title, posts.post_content, posts.post_image, posts.post_tags, ";
  $query .= "posts.post_date FROM posts ";
  $query .= "INNER JOIN categories ON posts.category_id = categories.category_id ";
  $query .= "INNER JOIN post_status ON posts.post_status_id = post_status.post_status_id ";
  $query .= "WHERE user_id = ?";
  $stmt = mysqli_prepare($connection, $query);
  confirmQuery($stmt);
  mysqli_stmt_bind_param($stmt, "i", $user_id);
  mysqli_stmt_execute($stmt);
  return $stmt;
}









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

  $stmt = mysqli_prepare($connection, "UPDATE posts SET user_id = ?, category_id = ?, post_status_id = ?, post_title = ?, post_content = ?, post_image = ?, post_tags = ?, post_date = now() WHERE post_id = ?");
  confirmQuery($stmt);
  mysqli_stmt_bind_param($stmt, "iiissssi", $user_id, $category_id, $post_status_id, $post_title, $post_content, $post_image, $post_tags, $post_id);
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
