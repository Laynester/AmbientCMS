<?php
/*############################
// AmbientCMS By Laynester  //
############################*/
require "global.php";
define('TAB_ID','0');
define('PAGE_ID','0');
// Page Title
$tpl->setParam('title', '%hotelname% - 404 %error%');

// Headers
$tpl->AddGeneric("header-main");
$tpl->AddGeneric("header-initial");

// Body
$tpl->AddGeneric("page-404");
$tpl->AddGeneric("footer");



//Template Output
$tpl->Output();


 ?>
