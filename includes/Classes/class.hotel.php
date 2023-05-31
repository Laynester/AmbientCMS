<?php
define('findretros_account', ambientCore::siteConfig('findretros_account'));
class hotel
{
  public static function sso($page)
  {
    global $conn,$config;
    $sessionKey  = 'AmbientSSO-'.VERSION.'-'.substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 25);
    if($page == 'client')
    {
      $stmt = $conn->prepare("UPDATE users SET auth_ticket = :sso , last_online = :timenow WHERE id = :id");
      $stmt->bindParam(':timenow',  strtotime("now"));
      $stmt->bindParam(':id', $_SESSION['id']);
      $stmt->bindParam(':sso', $sessionKey);
      $stmt->execute();
    }
    else if ($page == 'register')
    {
      return $sessionKey;
    }
  }
  Public static function usersOnline()
  {
    global $conn;
    $userCount = $conn->prepare("SELECT online FROM users WHERE online = '1'");
    $userCount->execute();
    return $userCount->RowCount();
  }
  public static function homeRoom()
  {
    global $conn, $hotel;
    $stmt = $conn->prepare("UPDATE users SET home_room = :homeroom WHERE id = :id");
    $stmt->bindParam(':homeroom', $hotel['homeRoom']);
    $stmt->bindParam(':id', $_SESSION['id']);
    $stmt->execute();
  }
}
?>
