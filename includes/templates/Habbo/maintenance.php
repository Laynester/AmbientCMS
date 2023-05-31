<?php
/*############################
// AmbientCMS By Laynester  //
############################*/
require "global.php";

// Page Title
$tpl->setParam('title', '%hotelname% - '.$page['maint']);

//Body
$tpl->AddGeneric("header-main");
$tpl->AddGeneric("header-processor");
$tpl->AddGeneric("page-maint");
$tpl->AddGeneric("footer-processor");


//Template Output
$tpl->Output();


 ?>
