<?php
/*############################
// AmbientCMS By Laynester  //
############################*/
class ambientUser
{
  public static function hashed($password)
  {
    return password_hash($password,PASSWORD_BCRYPT);
  }

  public static function verifyUser($password, $passwordDb, $username)
  {
    global $conn;
    if (substr($passwordDb, 0, 1) == "$")
    {
      if (password_verify($password, $passwordDb))
      {
        return true;
      }
      return false;
    }
    else
    {
      $passwordBcrypt = self::hashed($password);
      if (md5($password) == $passwordDb)
      {
        $stmt = $conn->prepare("UPDATE users SET password = :password WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $passwordBcrypt);
        $stmt->execute();
        return true;
      }
      return false;
    }
  }
  public static function login($user,$pass)
  {
    global $conn;

    $stmt = $conn->prepare("SELECT id, password, username, rank FROM `users` WHERE `username` = :username");
    $stmt->bindParam(':username', $user);
    $stmt->execute();
    if ($stmt->RowCount() == 1)
    {
      $a = $stmt->fetch();
      if (self::verifyUser($pass,$a['password'],$a['username']))
      {
        $update = $conn->prepare("UPDATE `users` SET `last_login` = :last_login WHERE `username` = :username");
        $update->bindParam(':last_login', time('now'));
        $update->bindParam(':username', $user);
        $update->execute();
        $_SESSION['id'] = $a['id'];
        $_SESSION['ambient_user'] = $a['username'];
      }
      else
      {
        $error = true;
        $emessage = '%wrong_cred%';
      }
    }
    else
    {
      $error = true;
      $emessage = '%wrong_cred%';
    }

  }
  public static function emailTaken($email)
  {
    global $conn;
    $stmt = $conn->prepare("SELECT mail FROM users WHERE mail = :email LIMIT 1");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    if ($stmt->RowCount() > 0)
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  public static function validName($username)
  {
    if(strlen($username) <= 12 && strlen($username) >= 3 && ctype_alnum($username))
    {
      return true;
    }
    return false;
  }
  public static function userTaken($username)
  {
    global $conn;
    $stmt = $conn->prepare("SELECT username FROM users WHERE username = :username LIMIT 1");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    if ($stmt->RowCount() > 0)
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  public static function register($user,$bpass,$motto,$sso,$femail,$avatar,$credits,$userip,$date,$gender)
  {
    global $conn;
      $registry = $conn->prepare("INSERT INTO users(username, password, rank, auth_ticket, motto, account_created, account_day_of_birth, last_online, mail, look, gender, ip_current, ip_register, credits)
      VALUES(:username,:password,'1',:sso,:motto,:timed,:accountbday,:last_online,:email,:avatar,:gender,:userip,:userip,:credits)");
      $registry->bindParam(':username', $user);
      $registry->bindParam(':password', $bpass);
      $registry->bindParam(':motto', $motto);
      $registry->bindParam(':sso', $sso);
      $registry->bindParam(':email', $femail);
      $registry->bindParam(':avatar', $avatar);
      $registry->bindParam(':credits', $credits);
      $registry->bindParam(':userip', $userip);
      $registry->bindParam(':gender', $gender);
      $registry->bindParam(':accountbday', strtotime($date));
      $registry->bindParam(':timed', strtotime('now'));
      $registry->bindParam(':last_online', strtotime('now'));
      $registry->execute();
      $getId = $conn->lastInsertId();
      $update = $conn->prepare("UPDATE `users` SET `last_login` = :last_login WHERE `username` = :username");
      $update->bindParam(':last_login', time('now'));
      $update->bindParam(':username', $user);
      $update->execute();
      $_SESSION['id'] = $getId;
      $_SESSION['ambient_user'] = $user;
      header('Location: /me');
      if (!$registry) {
        echo "\nPDO::errorInfo():\n";
        print_r($registry->errorInfo());
      }
  }
  public static function name2id($username = '')
  {
    global $conn;
    $a = $conn->prepare("SELECT id FROM `users` WHERE `username` = :user");
    $a->bindParam(':user', $username);
    $a->execute();
    $b = $a->fetch();
    if ($a->RowCount() > 0)
    {
      return $b['id'];
    }
  }
  public static function id2name($id)
  {
    global $conn;
    $a = $conn->prepare("SELECT username FROM `users` WHERE `id` = :id");
    $a->bindParam(':id', $id);
    $a->execute();
    $b = $a->fetch();
    if ($a->RowCount() > 0)
    {
      return $b['username'];
    }
  }
  public function IdExists($id = 0)
	{
    global $conn;
    $a = $conn->prepare("SELECT null FROM `users` WHERE `id` = :id");
    $a->bindParam(':id', $id);
    $a->execute();
    $b = $a->fetch();
    if ($a->RowCount() > 0)
    {
      return true;
    }
    else{ return false;}
  }
  public static function onlineStatus($id)
  {
    global $conn;
    $online = $conn->prepare("SELECT online FROM `users` WHERE `id` = :id");
    $online->bindParam(':id', $id);
    $online->execute();
    $b = $online->fetch();
    if($b['online'] == '1')
    {
      $online = 'online';
    }
    else
    {
      $online = 'offline';
    }
    return $online;

  }
  public static function userData($userid,$var)
  {
    global $conn;
    if ( in_array($var, array('duckets', 'diamonds', 'estars')) )
    {
      switch($var)
      {
        case "duckets":
        $var = '0';
        break;
        case "diamonds":
        $var = '5';
        break;
        case "estars":
        $var = '103';
        break;
        default:
        break;
      }
      $stmt = $conn->prepare("SELECT ".$var.",user_id,type,amount FROM users_currency WHERE user_id = :id AND type = :type");
      $stmt->bindParam(':id', $userid);
      $stmt->bindParam(':type', $var);
      $stmt->execute();
      if ($stmt->RowCount() > 0)
      {
        $row = $stmt->fetch();
        return $row['amount'];
      }
      else
      {
        return '0';
      }
    }
    if ( in_array($var, array('respects_given', 'respects_recieved', 'online_time')) )
    {
      $stmt = $conn->prepare("SELECT ".$var." FROM users_settings WHERE user_id = :id");
      $stmt->bindParam(':id', $userid);
      $stmt->execute();
      if ($stmt->RowCount() > 0)
      {
        $row = $stmt->fetch();
        return $row[$var];
      }
      else
      {
        return 0;
      }
    }
    else
    {
    $userData = $conn->prepare("SELECT ".$var." FROM `users` WHERE `id` = :id");
    $userData->bindParam(':id', $userid);
    $userData->execute();
    $result = $userData->fetch();
    return $result[$var];
    }
  }
}


if(loggedIn())
{
  define('habboname',$_SESSION['ambient_user']);
  define('habbo_id',ambientUser::name2id(habboname));
}
else
{
  define('habboname','Guest');
  define('habbo_id','0');
}

?>
