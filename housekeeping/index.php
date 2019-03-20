<?php
/*############################
// AmbientCMS By Laynester  //
############################*/
define('AmbientCMS', 2);
include_once $_SERVER['DOCUMENT_ROOT'].'/global.php';
include 'core.php';
adminLogin();
if (isset($_SESSION['hk_user_id'])){header('Location: dash');}
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <title>Ambient HK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <div class="content-container login">
      <h1 class="title">AmbientCMS</h1>
      <div class="content-box">
    <h1  class="title">
      Sign In
    </h1>
    <form method="post">
      <div class="left">
        <p><label>Username:</label></p>
        <p><label>Password:</label></p>
      </div>
      <div class="right">
        <p><input type="text" name="username"></p>
        <p><input type="password" name="password"></p>
        <p><input type="submit" class="right" name="login" value="Next"></p>
      </div>
    </form>
<?php include 'bottom.php'; ?>
