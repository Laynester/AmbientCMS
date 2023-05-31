<?php
/*############################
// AmbientCMS By Laynester  //
############################*/
require "global.php";
define('TAB_ID','1');
define('PAGE_ID','9');
if(empty($_GET['page'])){header('Location: /settings/1');}
if(!loggedIn())
{
  header('Location: /index');
}
// Params
$tpl->setParam('title', '%hotelname% - '.$page['settings']);
$tpl->setParam('look', ambientUser::userData(habbo_id,'look'));
$tpl->setParam('gender', ambientUser::userData(habbo_id,'gender'));

// Headers
$tpl->AddGeneric("header-main");
$tpl->AddGeneric("header-initial");

// Column 1
$tpl->Write('<div class="column thirty">');
$tpl->AddGeneric("settings-navi");
$tpl->Write('</div>');
// Column 2
$tpl->Write('<div class="column fourtyfive">');
$tpl->AddGeneric("settings");
$tpl->Write('</div>');

// Column 3
$tpl->AddGeneric("generic_column3");

$tpl->AddGeneric("footer");



//Template Output
$tpl->Output();
?>
