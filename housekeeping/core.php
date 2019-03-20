<?php
/*############################
// AmbientCMS By Laynester  //
############################*/



function adminLogin()
{
	global $conn;

	if (isset($_POST['login']))
    if (!empty($_POST['username']))
    {
      if (!empty($_POST['password']))
      {
        $user = filter($_POST['username']);
        $pass = filter($_POST['password']);
        $stmt = $conn->prepare("SELECT id, password, username, rank FROM `users` WHERE `username` = :username");
        $stmt->bindParam(':username', $user);
        $stmt->execute();
        if ($stmt->RowCount() == 1)
        {
          $a = $stmt->fetch();
          if (ambientUser::verifyUser($pass,$a['password'],$a['username']))
          {
            if(ambientUser::userData($a['id'],'rank') >= ambientCore::siteConfig('hk_login'))
            {
              $_SESSION['hk_user_id'] = $a['id'];
              header('Location: dash');
            }
          }
        }
      }
    }
  }
?>
