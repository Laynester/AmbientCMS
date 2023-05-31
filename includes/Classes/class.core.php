<?php
/*############################
// AmbientCMS By Laynester  //
############################*/
if(!defined('AmbientCMS'))
{
  die('Sorry but you cannot access this file!');
}
define('maintenance', ambientCore::siteConfig('maintenance'));
class ambientCore
{

  public static function SystemError($title, $text)
	{
		echo '<title>System Error</title>';
		echo '<div style="padding:15px;
		border: 1px solid maroon !important;
		color: #000;
		background: #FFA07A;
		display: table;
		margin: 0 auto;
		font-size: 15px;border-radius:7px;">';
		echo '<br><center><b>' . $title. '</b><br /></center>';
		echo '<center>&nbsp;' . $text;
		echo '</b><hr size="1" style="width: 100%; margin: 15px 0px 15px 0px;" /></center>';
		echo '<center style="font-family: verdana;">Error Location <b>/includes/templates/'.THEME.'/widgets/</b></center><br>';
		echo '<center>
This error occurs when the mentioned file is being called in a part of the site, and this does not exist.</center><br>';
		echo '</div><center style="font-family: verdana; font-size: 10px;"><i>Powered by <a href="http://laynester.cf">AmbientCMS</a> - Copyright &copy 2018.</i></center>';
		exit;
	}
  public static function siteConfig($key)
  {
    global $conn;
    $getvars = $conn->prepare("SELECT var FROM `site_config` WHERE `key` = :key");
    $getvars->bindParam(':key', $key);
    $getvars->execute();
    $val = $getvars->fetch();
    return $val['var'];
  }
}


?>
