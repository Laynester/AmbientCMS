<?php
/*############################
// AmbientCMS By Laynester  //
############################*/
/*
$tpl->setParam('', '');
*/

//Page Titles
$page = array();
$page['index'] = 'Login';
$page['register'] = 'Registration';
$page['maint'] = 'Maintenance Break!';
$page['logout'] = 'Logged Out';
$page['settings'] = 'Account Settings';

// Index
$tpl->setParam('username', 'Username');
$tpl->setParam('password', 'Password');
$tpl->setParam('email', 'Email');
$tpl->setParam('i_r1', 'Registration');

// Log Out
$tpl->setParam('logged_out', 'You have successfully logged out');

//Maintenance
$tpl->setParam('m_h1', 'Maintenance Break!');
$tpl->setParam('m_t1', 'Sorry! '.hotelname.' is being worked on at the moment.');
$tpl->setParam('m_t2', "We'll be back soon. We promise");

// Profile page
$tpl->setParam('h_widget0', 'Main Box');
$tpl->setParam('h_widget1', 'My Profile');
$tpl->setParam('h_widget2', 'My Badges');
$tpl->setParam('h_widget3', 'My Rooms');
$tpl->setParam('h_widget4', 'My Groups');
$tpl->setParam('h_widget5', 'Guestbook');
$tpl->setParam('h_widget6', 'My Stats');
$tpl->setParam('h_widget7', 'Status Updates');
$tpl->setParam('h_widget8', 'My Friends');
$tpl->setParam('status_label', "What's on your mind?");
$tpl->setParam('time_online','Time Online');
$tpl->setParam('leave_message','Leave a Message');
$tpl->setParam('no_status','I havent updated my status!');
$tpl->setParam('no_replies','No Replies');


// Me


// 404 Page
$tpl->setParam('page_404_1_t1', 'Page not found!');
$tpl->setParam('page_404_1_t2', 'Unfortunately there has been an error with your request. This could be because the page you requested is non-existant, or there may have been an internal server error. If this issue is persistent please contact an administrator.');
$tpl->setParam('page_404_2_t1', 'Were you looking for...');
$tpl->setParam('page_404_2_t2', '<p>A Group or Personal Page?<br>Check out the <a href="/community">Community</a></p>');

// Staff
$tpl->setParam('about_staff','About '.hotelname.' Staff');
$tpl->setParam('about_staff2',"The ".hotelname." staff team is one big happy family, each staff member has a different role and duties to fulfill. <br><br>Most of our team usually consists of players that have been around ".hotelname." for quite a while, but this doesn't mean we only recruit old &amp; known players, we recruit those who shine out to us!");
$tpl->setParam('join_team','How do I join the team?');
$tpl->setParam('join_team2','Every couple of months staff applications may open up via a news article giving users a chance to join the team, though we also like to handpick users that we feel are worthy of a trial. Things that we look out for are professionalism, a clear record, friendly & a frequent event host.');

// Settings
$tpl->setParam('settings_navi','Account Settings');
$tpl->setParam('profile_settings_navi','Profile Settings');
$tpl->setParam('widget_placement','Widget Placement');
$tpl->setParam('background_picker','Background Picker');
$tpl->setParam('hide_widgets','Widget Hider');
$tpl->setParam('widget_colors','Widget Header Colors');

// Universal
$tpl->setParam('count', hotel::usersOnline());
$tpl->setParam('online', hotelname."'s online");
$tpl->setParam('profile', 'Profile');
$tpl->setParam('error', 'Error');
$tpl->setParam('logout', 'Log Out');
$tpl->setParam('latest_news', 'Latest News');
$tpl->setParam('read_more', 'Read More');
$tpl->setParam('more_news', 'More News');
$tpl->setParam('go_there', 'Go There');
$tpl->setParam('campaigns', 'Hot Campaigns');
$tpl->setParam('last_sign', "Last signed in");
$tpl->setParam('credit_leader', 'Credits leaderboard');
$tpl->setParam('diamond_leader', 'Diamonds leaderboard');
$tpl->setParam('my_interests', 'My Tags');
$tpl->setParam('interests', 'Tags');
$tpl->setParam('hot_now', hotelname."'s Like...");
$tpl->setParam('add', 'Add');
$tpl->setParam('tags_desc', 'By adding more tags, chances of you being found are much greater.');

// Buttons
$tpl->setParam('cancel', 'Cancel');
$tpl->setParam('back', 'Back');
$tpl->setParam('i_r2', 'Register Now');
$tpl->setParam('i_r3', 'For Free!');
$tpl->setParam('forgot', 'Forgot Password?');
$tpl->setParam('i_h1', 'Login');
$tpl->setParam('hk_button', 'Housekeeping');
$tpl->setParam('okay', 'Okay');

// Errors
$tpl->setParam('empty_user', 'You must enter a username!');
$tpl->setParam('empty_pass', 'You forgot to enter a password!');
$tpl->setParam('empty_email', 'You forgot to enter an email address!');
$tpl->setParam('invalid_email', 'The email address you entered is invalid!');
$tpl->setParam('invalid_bday', 'Invalid birthday');
$tpl->setParam('invalid_captcha', 'Invalid Captcha code');
$tpl->setParam('taken_email', 'Email has been used!');
$tpl->setParam('taken_name', 'Username is taken!');
$tpl->setParam('empty_tag', 'You forgot to enter a tag!');
$tpl->setParam('user_no_badges','I have no badges!');
?>
