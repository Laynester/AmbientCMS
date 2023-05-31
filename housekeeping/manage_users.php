<?php
/*############################
// AmbientCMS By Laynester  //
############################*/
include 'top.php';
if (!isset($_SESSION['hk_user_id'])){header('Location: /index.php');}
if(!ambientUser::userData($_SESSION['hk_user_id'],'rank') >= ambientCore::siteConfig('hk_users')){header('Location: /housekeeping/dash');}
?>
<div class="right main-content">
  <?php
  if(isset($_GET['user']))
  {
    if(ambientUser::IdExists(ambientUser::name2id($_GET['user'])))
    {
      $user = filter($_GET['user']);
      $userid = ambientUser::name2id($user);
      echo '<h1  class="title">
        Managing user '.$user.'
      </h1>';
      ?>
        <div class="column">
          <h3 class="title">Information</h3>
          <div class="column" style="width:24%;">
            <p><label>Name</label></p>
            <p><label>Email</label></p>
            <p><label>Credits</label></p>
            <p><label>Diamonds</label></p>
            <p><label>Duckets</label></p>
          </div>
          <div class="column"style="width:72%;">
            <?php
            echo '
            <p>'.ambientUser::userData($userid, 'username').'</p>
            <p>'.ambientUser::userData($userid, 'mail').'</p>
            <p>'.ambientUser::userData($userid, 'credits').'</p>
            <p>'.ambientUser::userData($userid, 'diamonds').'</p>
            <p>'.ambientUser::userData($userid, 'duckets').'</p>
            ';
            ?>
          </div>
        </div>
        <div class="column">
          <h3 class="title">Recent Chats</h3>
          <div style="max-height:300px;overflow-y:scroll;">
          <?php
          $sql = $conn->prepare("SELECT * FROM chatlogs_room,rooms WHERE user_from_id = '{$userid}' AND rooms.id = room_id AND `timestamp` >= UNIX_TIMESTAMP(CURDATE())");
          $sql->execute();
          echo time('now');
          while($chat = $sql->fetch())
          {
            echo '<div class="usertable"><p class="column">Room: '.$chat['name'],'</p><p class="column">'.filter($chat['message']).' @'.date('h:iA', $chat['timestamp']).'</p></div>';
          }

          ?>
        </div>
        </div>
      <?php
    }
    else
    {
      echo '<h1  class="title">
        User Does not exist!
      </h1>';
    }
  }
  else {
  echo '<h1  class="title">
    Manage Users
  </h1>';
    $total = $conn->query("SELECT COUNT(*) FROM users")->fetchColumn();
    $limit = 15;
    $pages = ceil($total / $limit);

    // What page are we currently on?
    $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
        'options' => array(
            'default'   => 1,
            'min_range' => 1,
        ),
    )));

    // Calculate the offset for the query
    $offset = ($page - 1)  * $limit;

    // Some information to display to the user
    $start = $offset + 1;
    $end = min(($offset + $limit), $total);
    $prevpage = $page - 1;

    // The "back" link
    $prevlink = ($page > 1) ? '<a class="pagination" href="/housekeeping/manage_users/1" title="First page">First</a> <a class="pagination" href="/housekeeping/manage_users/' . ($page - 1) . '" title="Previous page">'.$prevpage.'</a>' : '';


    $stmt = $conn->prepare('
        SELECT
            *
        FROM
            users
        ORDER BY
            last_login
            DESC
        LIMIT
            :limit
        OFFSET
            :offset
    ');
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        // Define how we want to fetch the results
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $iterator = new IteratorIterator($stmt);
        echo '<div class= "table">
        <div class="usertable" style="border-bottom:1px dashed #B0F16C;margin-bottom:5px;">
        <div class="userdata username" style="border:0;">Username</div>
        <div class="userdata email" style="border:0;">Email Address</div>
        <div class="userdata created" style="border:0;">Account Creation</div>
        <div class="userdata last_login" style="border:0;">Last Login</div>
        </div>';
        // Display the results
        foreach ($iterator as $row) {
            echo '
            <div class="usertable" onClick="window.location.href=\'/housekeeping/manage_users/user/'.filter($row['username']).'\'">
            <div class="userdata username">', filter($row['username']), '</div>
            <div class="userdata email">'.filter($row['mail']).'</div>
            <div class="userdata created">'.date('d/m/Y',$row['account_created']).'</div>
            <div class="userdata last_login">'.date('d/m/Y',$row['last_login']).'</div>
            </div>
            ';
        }
        echo'</div>';

    }
    else
    {
      echo '<p>No results could be displayed.</p>';
    }
    echo '<div id="paging">Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results <p></div>';
    echo $prevlink;

    if($page < $pages)
    {
      echo '
      <a class="pagination" href="/housekeeping/manage_users/' .$page. '">'.$page.'</a>
      <a class="pagination" href="/housekeeping/manage_users/' . ($page + 1) . '" title="Next page">'.($page + 1).'</a>';
      if($page + 2 < $pages)
      {
        echo' <a class="pagination" href="/housekeeping/manage_users/' . ($page + 2) . '">'.($page + 2).'</a>';
      }
      echo' <a class="pagination" href="/housekeeping/manage_users/' . $pages . '" title="Last page">Last</a>';
    }

}
  ?>
</div>
<?php include 'bottom.php'; ?>
