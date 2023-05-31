<?php
/*############################
// AmbientCMS By Laynester  //
############################*/
require "global.php";
session_destroy();
$_SESSION = array();
// Page Title
$tpl->setParam('title', '%hotelname% - '.$page['logout']);

//Body
$tpl->AddGeneric("header-main");
$tpl->AddGeneric("header-processor");
$tpl->AddGeneric("page-logout");
$tpl->AddGeneric("footer-processor");


//Template Output
$tpl->Output();


 ?>
