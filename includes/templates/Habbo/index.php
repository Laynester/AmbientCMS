<?php
/*############################
// AmbientCMS By Laynester  //
############################*/
require "global.php";
if(loggedIn())
{
  header('Location: /me');
}
// Page Title
$tpl->setParam('title', '%hotelname% - '.$page['index']);

//Body
$tpl->AddGeneric("header-main");
$tpl->AddGeneric("header-processor");
$tpl->AddGeneric("index");
$tpl->AddGeneric("footer-processor");


//Template Output
$tpl->Output();


 ?>
