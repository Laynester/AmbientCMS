<?php
/*############################
// AmbientCMS By Laynester  //
############################*/
require "global.php";
define('TAB_ID','2');
define('PAGE_ID','3');
// Page Title
$tpl->setParam('title', '%hotelname% - '.$page['index']);

// Headers
$tpl->AddGeneric("header-main");
$tpl->AddGeneric("header-initial");

// Column 1
$tpl->Write('<div class="column fourtyfive">');
$tpl->AddGeneric("online_users");
$tpl->AddGeneric("hot_campaigns");
$tpl->Write('</div>');

// Column 2
$tpl->Write('<div class="column thirty">');
$tpl->AddGeneric("news");
$tpl->AddGeneric("discord");
$tpl->Write('</div>');

// Column 3
$tpl->AddGeneric('generic_column3');

$tpl->AddGeneric("footer");



//Template Output
$tpl->Output();


 ?>
