<?php
/*############################
// AmbientCMS By Laynester  //
############################*/
require "global.php";
define('TAB_ID','1');
define('PAGE_ID','8');
if(!loggedIn())
{
  header('Location: /index');
}
// Params
$tpl->setParam('title', '%hotelname% - %habboname%');

// Headers
$tpl->AddGeneric("header-main");
$tpl->AddGeneric("header-initial");

// Column 1
$tpl->Write('<div class="column fourtyfive">');
$widgetMe = new Template('me');
$widgetMe->setParam('look', ambientUser::userData(ambientUser::name2id(habboname),'look'));
$widgetMe->setParam('credits', ambientUser::userData(ambientUser::name2id(habboname),'credits'));
$widgetMe->setParam('duckets', ambientUser::userData(ambientUser::name2id(habboname),'duckets'));
$widgetMe->setParam('diamonds', ambientUser::userData(ambientUser::name2id(habboname),'diamonds'));
$widgetMe->setParam('last_login', date('M dS, Y h:iA', ambientUser::userData(ambientUser::name2id(habboname),'last_login')));
$tpl->AddTemplate($widgetMe);
$tpl->AddGeneric("hot_campaigns");
$tpl->AddGeneric("tags");
$tpl->Write('</div>');

// Column 2
$tpl->Write('<div class="column thirty">');
$tpl->AddGeneric("news");
$tpl->AddGeneric("discord");
$tpl->Write('</div>');

// Column 3
$tpl->AddGeneric("generic_column3");

$tpl->AddGeneric("footer");



//Template Output
$tpl->Output();


 ?>
