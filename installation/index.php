<?php
/*############################
// AmbientCMS By Laynester  //
############################*/
session_start();
include 'functions.php';
$page = (int) $_POST['page'];if(empty($page)){ $page = 1; }
if(!isset($_SESSION['settings'])){ $_SESSION['settings'] = array(); }

if(!empty($_POST['submit']) && $_POST['submit'] == 'Continue'){
	foreach($_POST as $id => $value){
		if($id == "page"){ continue; }
		$_SESSION['settings'][$id] = $value;
	}
  switch($page){
    case 2:
    foreach($_POST as $value)
    {
      if(empty($value))
      {
        $error = 'Fill in all fields!';
      }
    }
    break;
    case 3:
    foreach($_POST as $value)
    {
      if(empty($value))
      {
        $error = 'Fill in all fields!';
      }
    }
    break;
    case 4:
    break;
  }
  if(!isset($error)){
    $page++;
  }
}
elseif($_POST['submit'] == 'Back'){
  $page--;
}

switch($page){
  case 1:
    define('title', 'Introduction');
    $desc = '<input name="page" hidden value="1"/>Welcome to AmbientCMS! Please begin by selecting an option!';
    $form = '<h1 style="color:#fff; margin:auto;"><center>'.title.'</center></h1>';
    $form .= '<label>Server Options</label><br><select name="server"><option value="1">I have an existing Arcturus Database</option><option value="2">Install Arcturus Database</option></select>';
  break;
  case 2:
  define('title', 'Database');
  $form = '<h1 style="color:#fff; margin:auto;"><center>'.title.'</center></h1>';
  $form .= '<input name="page" hidden value="2"/>';
  if($_POST['server'] == 1 || $_SESSION['server'] = 'existing')
  {
  $desc = 'Fill in the information about the database AmbientCMS will connect to. Note: You have selected that you have an existing Arcturus database, nothing will be overwritten, and no data will be lost.';
  $_SESSION['server'] = 'existing';
  }
  if($_POST['server'] == 2 || $_SESSION['server'] = 'none'){
    $desc = 'Fill in the information about the database AmbientCMS will connect to. Note: You have selected that you do not have an existing Arcturus Database, AmbientCMS will insert the database for you.';
    $_SESSION['server'] = 'none';
  }
  $form .= '<label>Database Host</label>';
  $form .= '<input type="text" name="db_host" value="localhost"/>';
  $form .= '<label>Database Port</label>';
  $form .= '<input type="text" name="db_port" value="3306"/>';
  $form .= '<label>Database Username</label>';
  $form .= '<input type="text" name="db_username" value="root"/>';
  $form .= '<label>Database Password</label>';
  $form .= '<input type="text" name="db_password"/>';
  $form .= '<label>Database Name</label>';
  $form .= '<input type="text" name="db_name"/>';
  break;
  case 3:
  $_SESSION['db_host'] = $_POST['db_host'];
  $_SESSION['db_port'] = $_POST['db_port'];
  $_SESSION['db_username'] = $_POST['db_username'];
  $_SESSION['db_password'] = $_POST['db_password'];
  $_SESSION['db_name'] = $_POST['db_name'];
  define('title', 'Site');
  $desc = 'Set your site settings';
  $form = '<h1 style="color:#fff; margin:auto;"><center>'.title.'</center></h1>';
  $form .= '<input name="page" hidden value="3"/>';
  $form .= '<label>Site URL</label>';
  $form .= '<input type="text" name="site_url">';
  $form .= '<label>Start Credits</label>';
  $form .= '<input type="text" name="site_credits">';
  $form .= '<label>Avatar Imaging</label>';
  $form .= '<input type="text" name="site_imaging">';
  $form .= '<label>Hotel Name</label>';
  $form .= '<input type="text" name="site_name">';
  break;
  case 4:
  define('title', 'Write Config');
  $_SESSION['site_url'] = $_POST['site_url'];
  $_SESSION['site_credits'] = $_POST['site_credits'];
  $_SESSION['site_imaging'] = $_POST['site_imaging'];
  $_SESSION['site_name'] = $_POST['site_name'];
  writeConfig($_SESSION['server']);
  $passed['permission_config'] = (is_writable('../installation/') ? true : false);

  $desc =  'Ambient is now creating the configuration file!';
  $form = '<input name="page" hidden value="4"/><label>Writing Configuration</label>';
  $form .= $passed['permission_config'] ? '<div style="color:green;">Passed</div>' : '<div style="color:red;">Failed ../installation/ is not writable</div>';
  $form .= '<label>Database connection</label>';
  try{
    $dbh = new pdo( 'mysql:host='.$_SESSION['db_host'].':'.$_SESSION['db_port'].';dbname='.$_SESSION['db_name'].'',
                    $_SESSION['db_username'],
                    $_SESSION['db_password'],
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $form .= '<div style="color:green;">Connected</div>';
}
catch(PDOException $ex){
    $form .= '<div style="color:red;">Unable to connect</div>';
    $disable_continue = true;
}

  break;
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel='shortcut icon' href='%favicon%'>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--AmbientCMS by Laynester-2018-->
<title>Ambient Installation: <?php echo title; ?></title>
<style>
.logo
{
  background-image:url(https://cdn.discordapp.com/attachments/509802230589685760/510208990328651776/ambient_logo4.gif)!important;
  width:250px !important;
  height:86px !important;
}
</style>
<link rel="stylesheet" href="/includes/templates/Habbo/style/v1/css/index.css?v=%nocache%" type="text/css" />
<link rel="stylesheet" href="/includes/templates/Habbo/style/v1/css/constant.css?v=%nocache%" type="text/css" />
</head>
<body>
  	<div class="container">
  	<header style="height:100px;">
  		<div class="logo"></div>
  		<div class="online">
  		    <span class="onlineHotel"></span><?php echo $page; ?>/5 <font color="#FF8000"><?php echo title; ?></font>
  		</div>
  	</header>
    <?php if(isset($error)){ ?>
          <div style="background:red;border-radius:5px;padding:5px;color:#fff;margin-bottom:5px;">
              <center><?php echo $error; ?></center>
          </div>
    <?php } ?>
    <div class="mid_box">
     <div style="width: 45%;float:left;">
       <div style="padding:5px;border-radius:5px;background:#93938A;color:#fff;">
         <?php echo $desc; ?>
       </div>
     </div>
     <div style="width: 54%;float:left;margin-left:5px;">
       <form method="POST">
       <div style="padding:5px;border-radius:5px;background:#2192C2;color:#fff;">
         <?php echo $form; ?>
       </div>
       <?php if(!$disable_continue){ ?><input type="submit" class="continue" name="submit" value="Continue"/><?php } ?>
       <?php if($page <> 1){ ?><input type="submit" class="back" name="submit" value="Back"/><?php } ?>
     </form>
     </div>
   </div>
   <div class="clearfix"></div>
   <footer></footer>
   </div>
   </body>
   </html>
