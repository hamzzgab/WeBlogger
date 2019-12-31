<?php
include 'includes\posts_header.php';
session_start();
include 'includes\posts_navigation.php';


if (isset($_SESSION['user_role'])) {
  if (isset($_GET['source'])) {
    $source = $_GET['source'];
  }else{
    $source = '';
  }

  switch ($source) {
    case 'add_post':
    include 'includes/add_post.php';
    break;

    default:
    include 'includes/view_post.php';
    break;
  }

}

include 'includes\posts_footer.php';
?>
