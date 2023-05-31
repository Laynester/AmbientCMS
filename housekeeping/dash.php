<?php
/*############################
// AmbientCMS By Laynester  //
############################*/
include 'top.php';
if (!isset($_SESSION['hk_user_id'])){header('Location: /index.php');}
?>
<div class="right main-content">
  <h1  class="title">
    Dashboard
  </h1>
</div>
<?php include 'bottom.php'; ?>
