<?php 
namespace App\Models;

use \Core\Model;
use \Core\Session;
use \PDO;
/**
* 
*/
class LoginModel extends Model
{
  public static function checkLogin($username, $password)
  {
    $db   = self::_getConnection();
    $stmt  = $db-> prepare(
            "SELECT id, username, password 
            FROM users where username = :username LIMIT 1"
            );
    $stmt->execute([
              ':username' => $username
              ]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(!empty($result)){
      if(password_verify($password, $result[0]['password'])){
        $user_data          = array();
        $user_data['name']  = $result[0]['username'];
        $user_data['id']    = $result [0]['id'];

        $sid    = session_id();
        $spass  = Session::setSessPass();
        $stime  = time();
        $stmt   = null;
        $stmt   = $db->prepare("INSERT INTO sessions (sid, spass, stime) VALUES (:sid, :spass, :stime)");
        $stmt->execute([
          ':sid'    => $sid, 
          ':spass'  => $spass, 
          ':stime'  => $stime]
          );

        return $user_data;
      }
    }
    Session::sessionStop();
    return false;
  }

  public static function deleteLoggedIn()
  {
    $db = self::_getConnection();
    $stmt = $db->prepare("DELETE FROM sessions WHERE sid=:sid");
    $stmt->execute([
      ':sid' => session_id()
      ]);
  }

  public static function identifyLoggedIn()
  {
    $db = self::_getConnection();
    $expired_time = time() - (20*60);
    $time = time();

    $stmt = $db->exec("DELETE FROM sessions WHERE stime < $expired_time");

    $stmt = $db->prepare("SELECT spass FROM sessions WHERE sid = :sid");
    $stmt->execute([
      ':sid' => session_id()
      ]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $spass = Session::setSessPass();

    if(!empty($result)){
      if($result[0]['spass'] == $spass){
        $stmt = $db->prepare("UPDATE sessions SET stime = $time WHERE sid = :sid LIMIT 1");
        $stmt->execute([
          ':sid' => session_id()
          ]);
        return true;
      }
    }
    return false;
  }
}