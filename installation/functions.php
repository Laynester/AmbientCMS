<?php
/*############################
// AmbientCMS By Laynester  //
############################*/

function writeConfig()
{
  $data =
  '
  <?php
  /*############################
  // AmbientCMS By Laynester  //
  ############################*/
  if(!defined("AmbientCMS"))
  {
    die("Sorry but you cannot access this file!");
  }

  	/* Database Setting */
  $db[\'host\'] = "'.$_SESSION['settings']['db_host'].'";
  $db[\'db\'] = "'.$_SESSION['settings']['db_name'].'";
  $db[\'user\'] = "'.$_SESSION['settings']['db_username'].'";
  $db[\'pass\'] = "'.$_SESSION['settings']['db_password'].'";


  /*AmbientCMS Config*/
  define("VERSION","1.0");
  define("LANGUAGE","en");
  define("hotelname","'.$_SESSION['settings']['site_name'].'");
  define("THEME", "Habbo");
  define("hotelUrl","'.$_SESSION['settings']['site_url'].'");
  define("startCredits","'.$_SESSION['settings']['site_credits'].'");
  define("registerEnabled", true);
  define("avatar_imaging","'.$_SESSION['settings']['site_imaging'].'");
  define("favicon","style/v1/imaging/favicon.ico");

  ?>';
  $fh = @fopen("ambient-config.php","w");

	if (!@fwrite($fh, $data)) {
		@fclose($fh);
		return false;
	} else {
		@fclose($fh);
		return true;
	}
}
?>
