<?php
/*############################
// AmbientCMS By Laynester  //
// Habbo Theme Core         //
// Needed for templating    //
############################*/
if (!defined('AmbientCMS'))
{
    die('Sorry but you cannot access this file!');
}
class habboTheme
{

    public static function tabbing()
    {
        global $conn;
        $tabs = $conn->prepare("SELECT * FROM `site_navigation` WHERE `parent_id` = '-1' ORDER BY order_id ASC");
        $tabs->execute();
        echo '<div class= "main-nav" id="main-nav">';
        while ($link = $tabs->fetch())
        {
            $allowDisplay = true;
            switch ($link['visibility'])
            {
                default:
                case 0:
                    $allowDisplay = false;
                    break;

                case 1:
                    break;

                case 2:
                    if (!loggedIn())
                    {
                        $allowDisplay = false;
                    }
                    break;

                case 3:
                    if (loggedIn())
                    {
                        $allowDisplay = false;
                    }
                    break;
            }
            if (!$allowDisplay)
            {
                continue;
            }
            $class = 'class="' . $link['class'] . '"';
            if (defined('TAB_ID') && TAB_ID == $link['id'])
            {
                $class = ' class="active"';
            }
            echo '<a ' . $class . ' href="' . htmlspecialchars($link['url']) . '">' . htmlspecialchars($link['caption']) . '</a>';
        }
        if (loggedIn())
        {
            echo '<a href="/logout" class="red">%logout%</a>';
        }
        if (self::hasRank(habbo_id, ambientCore::siteConfig('hk_login')))
        {
            echo '<a href="/housekeeping" class="red">%hk_button%</a>';
        }
        echo '<a href="javascript:void(0);" class="icon" onclick="reSize()"><i class="fa fa-bars"></i></a>';
        echo '</div>';


        // Sub Navi
        $i            = 0;
        $lookupParent = '1';
        if (defined('TAB_ID'))
        {
            $lookupParent = TAB_ID;
        }
        $data = $conn->prepare("SELECT * FROM `site_navigation` WHERE  `parent_id` = :parent  ORDER BY order_id ASC");
        $data->bindParam(':parent', $lookupParent);
        $data->execute();
        echo '<div class= "sub-navi"id="sub-nav"><ul>';
        while ($link = $data->fetch())
        {
            $allowDisplay = true;
            switch ($link['visibility'])
            {
                default:
                case 0:
                    $allowDisplay = false;
                    break;

                case 1:
                    break;
                case 2:
                    if (!loggedIn())
                    {
                        $allowDisplay = false;
                    }
                    break;
                case 3:
                    if (loggedIn())
                    {
                        $allowDisplay = false;
                    }
                    break;
            }
            if (!$allowDisplay)
            {
                continue;
            }
            $class = '';
            if (defined('PAGE_ID') && PAGE_ID == $link['id'])
            {
                $class .= ' active';
            }
            echo '    <li><a class="' . $class . '" href="' . filter($link['url']) . '"><span>' . filter($link['caption']) . '</span></a></li>';
            echo '</li>';
        }
        echo '</ul></div>';
    }
    public static function hasRank($user, $rank)
    {
        if (ambientUser::userData($user, 'rank') >= $rank)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public static function getNews()
    {
        global $conn;
        $getNews = $conn->prepare("SELECT * FROM `site_news` ORDER BY timestamp DESC LIMIT 3 ");
        $getNews->execute();
        echo'<div class="ambient-box" id="newsList">';
        echo '<div id="stage">';
        while ($n = $getNews->fetch())
        {
            echo '<div id="ticker" class="mySlides" style="background-color:#d8d9ce;background-image:url(/includes/templates/' . THEME . '/style/v1/imaging/ts/' . $n['topstory_image'] . ');background-repeat:no-repeat;height:187px;padding:5px;">';
            echo '<h1>%latest_news%</h1>';
            echo '<h2>' . $n['title'] . '</h2>';
            echo '<p>' . $n['snippet'] . '</p>';
            echo '<p><a href="/articles/' . $n['id'] . '">%read_more%</a></p>';
            echo '</div>';
        }
        echo '</div>';
        $getNewsList = $conn->prepare("SELECT * FROM `site_news` ORDER BY timestamp DESC LIMIT 3,4 ");
        $getNewsList->execute();
        echo '<div class="wide_list">';
        while ($n2 = $getNewsList->fetch())
        {
            echo '<li><p class="title">' . $n2['title'] . '</p><p class="date">' . date('d-m-y, h:ia', $n2['timestamp']) . '</p></li>';
        }
        echo '<li class="last"><a href="#"><small>%more_news%</small></a></li>';
        echo '</div></div>';
    }

    public static function getCampaigns()
    {
        global $conn;
        $getCampaigns = $conn->prepare("SELECT * FROM `site_campaigns` ORDER BY order_id ASC");
        $getCampaigns->execute();
        while ($cs = $getCampaigns->fetch())
        {
            echo '
      <div class="campaign_container">
        <a class="campaign image" href="' . $cs['link'] . '">
          <img src="/includes/templates/%theme%/style/v1/imaging/campaigns/' . $cs['image'] . '"/>
        </a>
        <div class="text">
          <b>' . filter($cs['title']) . '</b>
          <p>' . filter($cs['desc']) . '</p>
          <p class="link"><a href="' . filter($cs['link']) . '">%go_there%</a></p>
        </div>
      </div>';
        }
    }
    public static function getOnlineUsers()
    {
        global $conn;
        $online = $conn->prepare("SELECT username,look,id FROM `users` ORDER BY RAND() LIMIT 14");
        $online->execute();
        while ($avatar = $online->fetch())
        {
            echo '<a href="/profile/' . $avatar['username'] . '" class="random_user tooltip"><img src="%imager%' . $avatar['look'] . '&direction=4&head_direction=3&action=wav&gesture=sml"/><span class="tooltiptext">' . $avatar['username'] . '</span></a>';
        }
    }
    public static function getStatusUpdates()
    {
        global $conn;
        $status = $conn->prepare("SELECT * FROM `site_statuses` WHERE `timestamp` >= UNIX_TIMESTAMP(CURDATE())  ORDER BY id DESC LIMIT 10");
        $status->execute();
        if ($status->RowCount() > 0)
        {
          while ($a = $status->fetch())
          {
            echo '<p class="status_update">' . nl2br($a['status']) . '</p>';
            echo '<p class="motto">'.ambientUser::id2name($a['user_id']).'</p><p class="date">Today at: ' . date('h:ia', $a['timestamp']) . '</p>';
          }
        }
        else{echo"<center>No %hotelname%'s have posted any status updates today</center>";}
    }
    public static function creditLeader()
    {
      global $conn;
      $coins = $conn->prepare("SELECT credits,username FROM `users` ORDER BY credits DESC");
      $coins->execute();
      $x = 1;
      while($credits = $coins->fetch())
      {
		  if($x==1){
			 echo '<div class="leader-board-row"><div class="leader-board-rank gold">1st</div><div class="leader-board-user">'.$credits['username'].'</div><div class="leader-board-currency credits">'.$credits['credits'].'</div></div>';
		  }
		  if($x==2){
			 echo '<div class="leader-board-row"><div class="leader-board-rank silver">2nd</div><div class="leader-board-user">'.$credits['username'].'</div><div class="leader-board-currency credits">'.$credits['credits'].'</div></div>';;
		  }
		  if($x==3){
			  echo '<div class="leader-board-row"><div class="leader-board-rank bronze">3rd</div><div class="leader-board-user">'.$credits['username'].'</div><div class="leader-board-currency credits">'.$credits['credits'].'<br></div></div>';
		  }
		  $x++;
      }

    }
    public static function diamondsLeader()
    {
      global $conn;
      $coins = $conn->prepare("SELECT amount,user_id,username FROM `users`,`users_currency` WHERE `user_id` = users.id AND `type` = '5' ORDER BY amount DESC");
      $coins->execute();
      $x = 1;
      while($credits = $coins->fetch())
      {
		  if($x==1){
			 echo '<div class="leader-board-row"><div class="leader-board-rank gold">1st</div><div class="leader-board-user">'.$credits['username'].'</div><div class="leader-board-currency diamonds">'.$credits['amount'].'</div></div>';
		  }
		  if($x==2){
			 echo '<div class="leader-board-row"><div class="leader-board-rank silver">2nd</div><div class="leader-board-user">'.$credits['username'].'</div><div class="leader-board-currency diamonds">'.$credits['amount'].'</div></div>';;
		  }
		  if($x==3){
			  echo '<div class="leader-board-row"><div class="leader-board-rank bronze">3rd</div><div class="leader-board-user">'.$credits['username'].'</div><div class="leader-board-currency diamonds">'.$credits['amount'].'<br></div></div>';
		  }
		  $x++;
      }

    }
    public static function profileSettings($thing,$col = '')
    {
      global $conn;
      switch($thing){
        case 1:
        $dir    = 'includes/templates/'.THEME.'/style/v1/imaging/profile_backgrounds';
        foreach(new DirectoryIterator($dir) as $file)
        {
          if ($file->isFile())
          {
            echo '<input type="radio" class="background_image" style="background:url(/'.$dir.'/'.$file.');" name="background" value="'.$file.'">';
          }
        }
        break;
        case 2:
        $id = habbo_id;
        $get = $conn->prepare("SELECT * FROM `site_profiles` WHERE `user_id` = :id AND `col_id` = :col AND `visible` = '1' ORDER BY order_number ASC");
        $get->bindParam(':id', $id);
        $get->bindParam(':col', $col);
        $get->execute();
          while($exec = $get->fetch())
          {
            if($exec['col_id'] == 1)
            {
              echo'<li class="re-organizer" id="'.$exec['id'].'">'.$exec['widget'].'<a style="float:right;border-left:1px solid #111; padding-left:5px;background:#ccc;" href="4&move='.$exec['id'].'&col_id=2">></a></li>';
            }
            else
            {
              echo'<li style="text-align:right;" class="re-organizer" id="'.$exec['id'].'"><a style="float:left;border-right:1px solid #111;padding-right:5px;background:#ccc;" href="4&move='.$exec['id'].'&col_id=1"><</a>'.$exec['widget'].'</li>';
            }
          }
        break;
        case 3:
        $id = habbo_id;
        $get = $conn->prepare("SELECT * FROM `site_profiles` WHERE `user_id` = :id AND widget <> 'Main' AND widget <> 'Info' ORDER BY order_number ASC");
        $get->bindParam(':id', $id);
        $get->execute();
        while($exec = $get->fetch())
        {
          if($exec['visible'] == '1')
          {
            echo '<li><a href="5&hide='.$exec['id'].'&state=0">Hide</a> '.$exec['widget'].'</li>';
          }
          else
          {
            echo '<li><a href="5&hide='.$exec['id'].'&state=1">Show</a> '.$exec['widget'].'</li>';
          }
        }
        break;
        case 4:
        if(isset($_POST['h_widget0']))
        {
          $color = $_POST['h_widget0'];
          $widget = $_POST['widget0'];
          $id = habbo_id;
          $update = $conn->prepare("UPDATE site_profiles SET header_color = '{$color}' WHERE user_id = '{$id}' AND widget = '{$widget}'");
          $update->execute();
        }
        if(isset($_POST['h_widget1']))
        {
          $color = $_POST['h_widget1'];
          $widget = $_POST['widget'];
          $id = habbo_id;
          $update = $conn->prepare("UPDATE site_profiles SET header_color = '{$color}' WHERE user_id = '{$id}' AND widget = '{$widget}'");
          $update->execute();
        }
        if(isset($_POST['h_widget2']))
        {
          $color = $_POST['h_widget2'];
          $widget = $_POST['widget2'];
          $id = habbo_id;
          $update = $conn->prepare("UPDATE site_profiles SET header_color = '{$color}' WHERE user_id = '{$id}' AND widget = '{$widget}'");
          $update->execute();
        }
        if(isset($_POST['h_widget3']))
        {
          $color = $_POST['h_widget3'];
          $widget = $_POST['widget3'];
          $id = habbo_id;
          $update = $conn->prepare("UPDATE site_profiles SET header_color = '{$color}' WHERE user_id = '{$id}' AND widget = '{$widget}'");
          $update->execute();
        }
        if(isset($_POST['h_widget4']))
        {
          $color = $_POST['h_widget4'];
          $widget = $_POST['widget4'];
          $id = habbo_id;
          $update = $conn->prepare("UPDATE site_profiles SET header_color = '{$color}' WHERE user_id = '{$id}' AND widget = '{$widget}'");
          $update->execute();
        }
        if(isset($_POST['h_widget5']))
        {
          $color = $_POST['h_widget5'];
          $widget = $_POST['widget5'];
          $id = habbo_id;
          $update = $conn->prepare("UPDATE site_profiles SET header_color = '{$color}' WHERE user_id = '{$id}' AND widget = '{$widget}'");
          $update->execute();
        }
        if(isset($_POST['h_widget6']))
        {
          $color = $_POST['h_widget6'];
          $widget = $_POST['widget6'];
          $id = habbo_id;
          $update = $conn->prepare("UPDATE site_profiles SET header_color = '{$color}' WHERE user_id = '{$id}' AND widget = '{$widget}'");
          $update->execute();
        }
        if(isset($_POST['h_widget7']))
        {
          $color = $_POST['h_widget7'];
          $widget = $_POST['widget7'];
          $id = habbo_id;
          $update = $conn->prepare("UPDATE site_profiles SET header_color = '{$color}' WHERE user_id = '{$id}' AND widget = '{$widget}'");
          $update->execute();
        }
        if(isset($_POST['h_widget8']))
        {
          $color = $_POST['h_widget8'];
          $widget = $_POST['widget8'];
          $id = habbo_id;
          $update = $conn->prepare("UPDATE site_profiles SET header_color = '{$color}' WHERE user_id = '{$id}' AND widget = '{$widget}'");
          $update->execute();
        }
        break;
      }

      /* Form Data */
      if(isset($_POST['update_background']))
      {
        global $conn;
        $bg = $_POST['background'];
        $id = habbo_id;
        $update = $conn->prepare("UPDATE site_profiles SET widget_background = '{$bg}' WHERE user_id = '{$id}' AND widget = 'Main'");
        $update->execute();
        header('Location: /settings/3');
      }
      if(isset($_GET['move']))
      {
        $id = filter($_GET['move']);
        $col = filter($_GET['col_id']);
        $update = $conn->prepare("UPDATE site_profiles SET col_id=".$col." WHERE id=".$id);
        $update->execute();
        header('Location: 4');
      }
      if(isset($_POST["submit"])) {
      	$id_ary = explode(",",$_POST["row_order"]);
      	for($i=0;$i<count($id_ary);$i++) {
      	$update = $conn->prepare("UPDATE site_profiles SET order_number='" . $i . "' WHERE id=". $id_ary[$i]);
        $update->execute();
        header('Location: /settings/4');
      	}
      }
      if(isset($_POST["submit2"])) {
      	$id_ary = explode(",",$_POST["row_order2"]);
      	for($i=0;$i<count($id_ary);$i++) {
      	$update = $conn->prepare("UPDATE site_profiles SET order_number='" . $i . "' WHERE id=". $id_ary[$i]);
        $update->execute();
        header('Location: /settings/4');
      	}
      }
      if(isset($_GET['hide']))
      {
        $id = filter($_GET['hide']);
        $state = filter($_GET['state']);
        $userid = habbo_id;
        $update = $conn->prepare("UPDATE site_profiles SET visible='".$state."' WHERE id=".$id." AND user_id = ".$userid." ");
        $update->execute();
        header('Location: 5');
      }
    }
    public static function meTags()
    {
      global $conn;
      $id = habbo_id;
      $get = $conn->prepare("SELECT * FROM `site_tags` WHERE `user_id` = '{$id}'");
      $get->execute();
      while($tags = $get->fetch())
      {
          echo $tags['tag'].'<input hidden name="tag_id"value="'.$tags['id'].'"><input type="submit" class="delete" name="delete_tag" value="-">';
      }
      if(isset($_POST['delete_tag']))
      {
        $id = filter($_POST['tag_id']);
        $user = habbo_id;
        $delete = $conn->prepare("DELETE FROM `site_tags` WHERE `id` = '{$id}' AND `user_id` = '{$user}'");
        $delete->execute();
        header('Location: /me');
      }
      if(isset($_POST['1_add_tag']))
      {
        if(!empty($_POST['add_tag']))
        {
          $tag = filter($_POST['add_tag']);
          $user = habbo_id;
          $insert = $conn->prepare("INSERT INTO `site_tags` (user_id,tag) VALUES('{$user}','{$tag}')");
          $insert->execute();
          header('Location: /me');
        }
        else
        {
         $error = '%empty_tag%';
        }
      }
    }
}

class habboProfiles
{
  public static function profileExists($id)
  {
      global $conn;
      $exist = $conn->prepare("SELECT null FROM `site_profiles` WHERE `user_id` = :id");
      $exist->bindParam(':id', $id);
      $exist->execute();
      if ($exist->RowCount() > 0)
      {
          return true;
      }
  }
  public static function createProfile($id)
  {
      global $conn;
      if (ambientUser::userTaken(ambientUser::id2name($id)))
      {
          $conn->beginTransaction();
          $conn->exec("INSERT INTO site_profiles (user_id,widget_background,widget,visible,order_number,col_id) VALUES('{$id}','bg_colour_03.gif','Main','1','-1','0')");
          $conn->exec("INSERT INTO site_profiles (user_id,widget,visible,order_number,col_id) VALUES('{$id}','Info','1','1','1')");
          $conn->exec("INSERT INTO site_profiles (user_id,widget,visible,order_number,col_id) VALUES('{$id}','Stats','1','2','1')");
          $conn->exec("INSERT INTO site_profiles (user_id,widget,visible,order_number,col_id) VALUES('{$id}','Status','1','1','2')");
          $conn->exec("INSERT INTO site_profiles (user_id,widget,visible,order_number,col_id) VALUES('{$id}','GuestBook','1','2','2')");
          $conn->exec("INSERT INTO site_profiles (user_id,widget,visible,order_number,col_id) VALUES('{$id}','Rooms','1','3','1')");
          $conn->exec("INSERT INTO site_profiles (user_id,widget,visible,order_number,col_id) VALUES('{$id}','Groups','1','3','2')");
          $conn->exec("INSERT INTO site_profiles (user_id,widget,visible,order_number,col_id) VALUES('{$id}','Badges','1','4','2')");
          $conn->exec("INSERT INTO site_profiles (user_id,widget,visible,order_number,col_id) VALUES('{$id}','Friends','1','4','1')");
          $conn->commit();
      }
  }
  public static function getProfileWidget($var, $thing, $id)
  {
      global $conn;
      $widget = $conn->prepare("SELECT " . $thing . " FROM `site_profiles` WHERE `widget` = :widget AND `user_id` = :id");
      $widget->bindParam(':widget', $var);
      $widget->bindParam(':id', $id);
      $widget->execute();
      $val = $widget->fetch();
      return $val[$thing];
  }
  public static function statusUpdate()
  {
      global $conn;
      // Status Updates
      if ((isset($_POST['status'])))
      {
          if (!empty($_POST['status_message']))
          {
              $user_id = ambientUser::name2id(habboname);
              $status  = htmlspecialchars($_POST['status_message'],ENT_QUOTES);
              $time    = time('now');
              $status  = $conn->prepare("INSERT INTO site_statuses (user_id, status, timestamp) VALUES('{$user_id}','{$status}','{$time}')");
              $status->execute();
              header('Location: /profile/' . habboname . '&posted');
          }
      }
  }
  public static function getStatuses($userid)
  {
      global $conn;
      $status = $conn->prepare("SELECT * FROM `site_statuses` WHERE `user_id` = :id ORDER BY timestamp DESC");
      $status->bindParam(':id', $userid);
      $status->execute();
      if ($status->RowCount() > 0)
      {
        while ($a = $status->fetch())
        {
            if(habbo_id == $a['user_id']){echo'<form method="post">';}
            echo '<p class="status_update">' . nl2br($a['status']) . '</p><p class="status_date date">'.date('D M dS Y, h:ia', $a['timestamp']);
            if(habbo_id == $a['user_id']){echo'<input class="none" type="submit" name="delete_status" value="Delete"/><input hidden value="'.$a['id'].'" name="status_id"/></form>';}
            echo '</p>';
          }
      }
      else
      {
        echo '<center>%no_status%</center>';
      }
      if(isset($_POST['delete_status']))
      {
        $id = filter($_POST['status_id']);
        $user = habbo_id;
        $delete = $conn->prepare("DELETE FROM `site_statuses` WHERE `id` = '{$id}' AND `user_id` = '{$user}'");
        $delete->execute();
        header('Location: /profile/'.habboname);
      }
  }
  public static function getBadges($id,$type)
  {
    global $conn;
    $exec = $conn->prepare("SELECT * FROM users_badges WHERE user_id = '{$id}' ORDER BY RAND()");
    $exec->execute();
    if($type == '1')
    {
      if ($exec->RowCount() > 0)
      {
        $count = $exec->rowCount();
        echo'('.$count.')';
      }
    }
    if($type == '2')
    {
      if ($exec->RowCount() > 0)
      {
        while($badges = $exec->fetch())
        {
          echo '<div class="badges" style="background-image:url('.ambientCore::siteConfig('badges_url').$badges['badge_code'].'.gif)"></div>';
        }
      }
      else
      {
        echo '<center>%user_no_badges%</center>';
      }
    }
  }
  public static function GuestBook($id)
  {
    $gid = $id;
    global $conn;
    $replies = $conn->prepare("SELECT * FROM site_guestbook WHERE guestbook_id = '{$gid}' ORDER BY timestamp DESC");
    $replies->execute();
    if ($replies->RowCount() > 0)
    {
      while($b = $replies->fetch())
      {
        echo '<p class="status_update">' . filter($b['message']) . '</p>
        <p class="status_date date">'.date('D M dS Y, h:ia', $b['timestamp']).' <b>From: '.ambientUser::id2name($b['user_id']).'</b></p>';
      }
    }
    else
    {
      echo '<center>%no_replies%</center>';
    }
    if(isset($_POST['guestbook']))
    {
      if(!empty($_POST['gb_message']))
      {
        $message = filter($_POST['gb_message']);
        $user = habbo_id;
        $time = time('now');
        $insert = $conn->prepare("INSERT INTO site_guestbook (message,user_id,guestbook_id,timestamp) VALUES('$message','$user','$gid','$time')");
        $insert->execute();
        header('Location: /profile/'.ambientUser::id2name($id));
      }
    }
  }


}


// Random functions
function searchUser()
{
  if(isset($_POST['searchuser']))
  {
    header('Location: /profile/'.$_POST['qryName']);
  }
}
function updateLook()
{
  global $conn;
  if(isset($_POST['habbo-avatar']))
  {
    $id = habbo_id;
    $look = $_POST['habbo-avatar'];
    $insert = $conn->prepare("UPDATE users SET look = '{$look}' WHERE id = '{$id}'");
    $insert->execute();
  }
}
function minToTime($minutes = '0') {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$minutes");
    return $dtF->diff($dtT)->format('%ad, %hh, %im and %ss');
}



?>
