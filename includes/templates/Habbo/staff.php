<?php
/*############################
// AmbientCMS By Laynester  //
############################*/
require "global.php";
define('TAB_ID', '2');
define('PAGE_ID', '5');
// Page Title
$tpl->setParam('title', '%hotelname% - Staff');

// Headers
$tpl->AddGeneric("header-main");
$tpl->AddGeneric("header-initial");


// Column 1
$tpl->Write('<div class="column fourtyfive">');
$getvars = $conn->prepare("SELECT * FROM `permissions` WHERE `id` > '2' ORDER by id DESC");
$getvars->execute();
while ($val = $getvars->fetch())
{
    $tpl->Write('
    <div class="ambient-box black">
    <h2 class="title" style="background:' . $val['prefix_color'] . ' !important;">' . $val['rank_name'] . '</h2>
    <div class="ambient-box-content">');
    $users = $conn->prepare("SELECT * FROM `users` WHERE `rank` = :rank ORDER by id DESC");
    $users->bindParam(':rank', $val['id']);
    $users->execute();
    while ($val2 = $users->fetch())
    {
        $tpl->Write('<div class="staff">');
        $tpl->Write('<div style="position: relative; overflow:hidden; height:65px;width:15.982%;float:left;"><img class="staff-avatar" src="%imager%' . $val2['look'] . '"/></div>');
        $tpl->Write('<div class="staff-middle">
      <p><a href="/profile/' . $val2['username'] . '">' . $val2['username'] . '</a></p>
      <p>' . filter($val2['motto']) . '</p>
      </div>');
        $tpl->Write('<div class="staff-right"><img src="includes/templates/habbo/style/v1/imaging/' . ambientUser::onlineStatus($val2['id']) . '.gif"></div>');
        $tpl->Write('</div>');
    }
    $tpl->Write('</div></div>');
}
$tpl->Write('</div>');

// Column 2
$tpl->Write('<div class="column thirty">');
$tpl->AddGeneric("about_staff");
$tpl->Write('</div>');

// Column 3
$tpl->AddGeneric('generic_column3');
$tpl->AddGeneric("footer");

$tpl->Output();



?>
