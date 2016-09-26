<?php 
namespace App\Models;

use \Core\Model;
use \PDO;

/**
* 
*/
class IndexModel extends Model
{
  public static function getIntro()
  {
    $user_id = $_SESSION['user']['id'];
    $db = self::_getConnection();
    $stmt = $db->query("SELECT intro FROM cv_index WHERE user_id = $user_id");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result[0]['intro'];
  }
}