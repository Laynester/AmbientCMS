<?php
/*############################
// AmbientCMS By Laynester  //
############################*/
require "global.php";

// Home PHP
if(!habboProfiles::profileExists(ambientUser::name2id($_GET['qryName']))){habboProfiles::createProfile(ambientUser::name2id($_GET['qryName']));}
if (isset($_GET['qryName']) && habboProfiles::getProfileWidget('main', 'visible',ambientUser::name2id($_GET['qryName'])) == 1)
{
	$qryId = ambientUser::name2id(filter($_GET['qryName']));
	$qryName = ambientUser::id2name($qryId);
	searchUser();
	if($qryName == habboname)
	{
		define('TAB_ID','1');
		define('PAGE_ID','7');
	}
	else
	{
		define('TAB_ID','2');
		define('PAGE_ID','0');
	}
	// Page Title
	$tpl->setParam('title', '%hotelname% - '.$_GET['qryName']."'s %profile%");

	// Params
	$tpl->setParam('profilename', $qryName);
	$tpl->setParam('profileid', $qryId);
	$tpl->setParam('look', ambientUser::userData($qryId,'look'));
	$tpl->setParam('credits', ambientUser::userData($qryId,'credits'));
	$tpl->setParam('duckets', ambientUser::userData($qryId,'duckets'));
	$tpl->setParam('diamonds', ambientUser::userData($qryId,'diamonds'));
	$tpl->setParam('profilemotto', filter(ambientUser::userData($qryId,'motto')));
	$tpl->setParam('profile_header', habboProfiles::getProfileWidget('info', 'header_color',$qryId));
	$tpl->setParam('book_header', habboProfiles::getProfileWidget('guestbook', 'header_color',$qryId));
	$tpl->setParam('stats_header', habboProfiles::getProfileWidget('stats', 'header_color',$qryId));
	$tpl->setParam('rooms_header', habboProfiles::getProfileWidget('rooms', 'header_color',$qryId));
	$tpl->setParam('status_header', habboProfiles::getProfileWidget('status', 'header_color',$qryId));
	$tpl->setParam('groups_header', habboProfiles::getProfileWidget('groups', 'header_color',$qryId));
	$tpl->setParam('badges_header', habboProfiles::getProfileWidget('badges', 'header_color',$qryId));
	$tpl->setParam('friends_header', habboProfiles::getProfileWidget('friends', 'header_color',$qryId));
	$tpl->setParam('profiledate', date('M dS, Y h:iA',ambientUser::userData($qryId,'account_created')));
	$tpl->setParam('online_time', minToTime(ambientUser::userData($qryId,'online_time')));

	// Headers
	$tpl->AddGeneric("header-main");
	$tpl->AddGeneric("header-initial");

	// Body & Profiles start
	$tpl->Write('
		<div class="column full">
			<div class="ambient-box">
				<h3 class="title" style="border-bottom:1px solid '.habboProfiles::getProfileWidget('main', 'header_color',$qryId).' !important;color:'.habboProfiles::getProfileWidget('main', 'header_color',$qryId).' !important;">%profilename%</h3>
				<div class="ambient-box-content" style="padding:15px;background:url('.hotelUrl.'/includes/templates/'.THEME.'/style/v1/imaging/profile_backgrounds/'.habboProfiles::getProfileWidget('main', 'widget_background',$qryId).');">
					<div class="col inside">');

					$getCol1 = $conn->prepare("SELECT * FROM `site_profiles` WHERE `col_id` = '1' AND `user_id` = :id AND `visible` = '1' ORDER BY order_number ASC");
					$getCol1->bindParam(':id', $qryId);
					$getCol1->execute();
					$tpl->Write('<div class="column" style="width:35%;">');
					while($exec = $getCol1->fetch())
					{
						$tpl->AddGeneric('profile_'.$exec['widget']);
					}
					$tpl->Write('<div class="ambient-box">
						<div class="ambient-box-content">
						<form method="POST">
						<input type="text" name="qryName" placeholder="Search for a user">
						<input type="submit"name="searchuser"value="Search">
						</form>
						</div>
					</div></div>');
					$getCol2 = $conn->prepare("SELECT * FROM `site_profiles` WHERE `col_id` = '2' AND `user_id` = :id AND `visible` = '1' ORDER BY order_number ASC");
					$getCol2->bindParam(':id', $qryId);
					$getCol2->execute();
					$tpl->Write('<div class="column" style="width:64%;">');
					while($exec = $getCol2->fetch())
					{
						$tpl->AddGeneric('profile_'.$exec['widget']);
					}
					$tpl->Write('</div>');
	// Column 2 End & Profiles end
	$tpl->Write('</div></div></div></div>');

	// Template Output
	$tpl->AddGeneric("footer");
	$tpl->Output();
}
else
{
	header('Location: /404');
}


 ?>
