<?php
/*############################
// AmbientCMS By Laynester  //
############################*/
require("global.php");
if(loggedIn())
{
  header('Location: /me');
}
// Registration
if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['Register']))
{

  $day = $_POST['Day'];
  $month = $_POST['Month'];
  $year = $_POST['Year'];
  $date = $day.'-'.$month.'-'.$year;
  $user = filter($_POST['Username']);
  $bpass = ambientUser::hashed($_POST['Password']);
  $motto = 'i | '.hotelname;
  $sso = hotel::sso('register');
  $femail = filter($_POST['Email']);
  $gender = $_POST['Gender'];
  if ($gender == "m")
			{
				$avatar = 'hd-180-1.lg-270-82.ch-210-66.sh-290-81.hr-100-61';
			}
			else
			{
				$avatar = 'sh-725-1408.ch-645-64.lg-695-73.hd-600-1.hr-500-39';
			}
  $credits = startCredits;
  $userip = $_SERVER['REMOTE_ADDR'];


  if (!empty($_POST['Username']))
  {
    if (ambientUser::validName($_POST['Username']))
    {
      if (!empty($_POST['Password']))
      {
        if (!empty($_POST['Email']))
        {
          if (filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL))
          {
            if (!ambientUser::userTaken($_POST['Username']))
            {
              if (!ambientuser::emailTaken($_POST['Email']))
              {
                if (is_numeric($day) && is_numeric($year) && $day > 0 && $day < 31 && $year > 1900 && $year < 2010)
		            {
                  if($_POST['captcha'] == $_SESSION['digit']){
                    ambientUser::register($user,$bpass,$motto,$sso,$femail,$avatar,$credits,$userip,$date,$gender);
                  }
                  else
                  {
                    $error = true;
                    $emessage = '%invalid_captcha%';
                    $_SESSION[ 'error' ] = $error;
            				$_SESSION[ 'emessage' ] = $emessage;
                  }
                }
                else
                {
                  $error = true;
                  $emessage = '%invalid_bday%';
                  $_SESSION[ 'error' ] = $error;
          				$_SESSION[ 'emessage' ] = $emessage;
                }
              }
              else
              {
                $error = true;
                $emessage = '%taken_email%';
                $_SESSION[ 'error' ] = $error;
        				$_SESSION[ 'emessage' ] = $emessage;
              }
            }
            else
            {
              $error = true;
              $emessage = '%taken_name%';
              $_SESSION[ 'error' ] = $error;
      				$_SESSION[ 'emessage' ] = $emessage;
            }
          }
          else
          {
            $error = true;
            $emessage = '%invalid_email%';
            $_SESSION[ 'error' ] = $error;
    				$_SESSION[ 'emessage' ] = $emessage;
          }
        }
        else
        {
          $error = true;
          $emessage = '%empty_email%';
          $_SESSION[ 'error' ] = $error;
  				$_SESSION[ 'emessage' ] = $emessage;
        }
      }
      else
      {
        $error = true;
        $emessage = '%empty_pass%';
        $_SESSION[ 'error' ] = $error;
				$_SESSION[ 'emessage' ] = $emessage;
      }
    }
    else
    {
      $error = true;
      $emessage = '%empty_user%';
      $_SESSION[ 'error' ] = $error;
      $_SESSION[ 'emessage' ] = $emessage;
    }
  }
  else
  {
    $error = true;
    $emessage = '%empty_user%';
    $_SESSION[ 'error' ] = $error;
    $_SESSION[ 'emessage' ] = $emessage;

  }
}
else
{
  $error = false;
}


// Page Title
$tpl->setParam('title', '%hotelname% - '.$page['register']);

//Body
$tpl->AddGeneric("header-main");
$tpl->AddGeneric("header-processor");
$tpl->AddGeneric("page-register");
$tpl->AddGeneric("footer-processor");


//Template Output
$tpl->Output();


 ?>
