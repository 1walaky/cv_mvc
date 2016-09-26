<?php 
namespace Core;

use \App\Models\LoginModel;

class Session
{
  public static function sessionStart()
  {
    if(session_id() == ''){
      session_start();
    }
  }

  public static function sessionStop()
  {
    if(session_status() != ''){
      session_destroy();
    }
  }

  public static function startUserSession($user_data)
  {
    if(!is_array($user_data) || empty($user_data)){
      throw new Exception('Session problem.', 500);
    }
    self::sessionStart();
    $_SESSION['user']['logged_in'] = true;
    $_SESSION['user']['name'] = $user_data['name'];
    $_SESSION['user']['id'] = $user_data['id'];
    //Privilégium és egyéb adatok betöltése, ha kell.
    return true;
  }

  public static function stopUserSession()
  {
    if(isset($_SESSION['user'])){
      unset($_SESSION['user']);
      LoginModel::deleteLoggedIn();
    }
  }

  public static function checkUserSession()
  {
    if(isset($_SESSION['user']['logged_in'])){
      if($_SESSION['user']['logged_in'] === true){
        if(LoginModel::identifyLoggedIn()){
          return true;
        }
      }
    }
    return false;
  }

  public static function setSessPass()
  {
    self::sessionStart();
    $sess_pass = md5(session_id().'S3cr3t_K3y!');
    return $sess_pass;
  } 
}