<?php
/*############################
// AmbientCMS By Laynester  //
############################*/

// Session Handling
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!defined('AmbientCMS'))
{
  die('Sorry but you cannot access this file!');
}

ob_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/Core/ambient-config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/Core/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/Core/db.php';
foreach (glob($_SERVER['DOCUMENT_ROOT'].'/includes/Classes/*.php') as $className)
{
  require_once $className;
}

// Replacements
$tpl = new AmbientTpl();
$tpl->setParam('title',hotelname);
$tpl->setParam('theme', THEME);
$tpl->setParam('nocache',time('now'));
$tpl->setParam('version', VERSION);
$tpl->setParam('hotelname',hotelname);
$tpl->setParam('www', hotelUrl);
$tpl->setParam('habboname', habboname);
$tpl->setParam('favicon', hotelUrl.'/includes/templates/'.THEME.'/'.favicon);
$tpl->setParam('imager',avatar_imaging);
$tpl->setParam('logo', 'includes/templates/'.THEME.'/'.ambientCore::siteConfig('Logo'));
include 'includes/Language/'.LANGUAGE.'.php';
if(file_exists('includes/templates/'.THEME.'/theme.core.php')){require_once 'includes/templates/'.THEME.'/theme.core.php';}

processForms();

?>
