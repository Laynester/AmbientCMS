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
$tpl->setParam('title', '%hotelname% - Client');

// Headers
$tpl->AddGeneric("header-main");

$client = new Template('client');
$client->setParam('swf_base', ambientCore::siteConfig('client_swf_base'));
$client->setParam('swf', ambientCore::siteConfig('client_swf'));
$client->setParam('client_ip', ambientCore::siteConfig('client_ip'));
$client->setParam('client_port', ambientCore::siteConfig('client_port'));
$client->setParam('user_sso', ambientUser::userData(ambientUser::name2id(habboname),'auth_ticket'));
$client->setParam('client_variables', ambientCore::siteConfig('client_variables'));
$client->setParam('client_override_variables', ambientCore::siteConfig('client_override_variables'));
$client->setParam('client_flash_texts', ambientCore::siteConfig('client_flash_texts'));
$client->setParam('client_override_texts', ambientCore::siteConfig('client_override_texts'));
$client->setParam('client_figuredata', ambientCore::siteConfig('client_figuredata'));
$client->setParam('client_furnidata', ambientCore::siteConfig('client_furnidata'));
$client->setParam('client_productdata', ambientCore::siteConfig('client_productdata'));
$client->setParam('bgcolor', ambientCore::siteConfig('client_loader_background'));
$tpl->AddTemplate($client);

//Template Output
$tpl->Output();


 ?>
