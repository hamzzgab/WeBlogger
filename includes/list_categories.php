<ul class="list-group" style="width: 20rem;">
  <li class="list-group-item active">Categories</li>
  <?php
    $stmt = selectAllCategories();
    mysqli_stmt_bind_result($stmt, $category_id, $category_name);
    while(mysqli_stmt_fetch($stmt)){
  ?>
  <a href="./index.php?category_id=<?php echo $category_id; ?>" class="list-group-item list-group-item-action"><?php echo $category_name; ?></a>
  <?php
    }
  ?>
</ul>
