<?php
namespace App\Models;

use \Core\Model;
use \PDO;

/**
* 
*/
class CvModel extends Model
{
  public static function getLetter()
  {
    $user_id = $_SESSION['user']['id'];
    $db = self::_getConnection();
    $stmt = $db->query("SELECT letter FROM cv_letter WHERE user_id = $user_id LIMIT 1");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result[0]['letter'];
  }

  public static function getData()
  {
    $user_id = $_SESSION['user']['id'];
    $data = array();
    $db = self::_getConnection();

    $stmt = $db->query("SELECT title, year, details FROM cv_education");
    $data['Tanulmányok'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $db->query("SELECT title, year, details FROM cv_employment");
    $data['Tapasztalat'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $stmt = $db->query("SELECT title, year, details FROM cv_courses");
    $data['Tanfolyamok'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $db->query("SELECT title, year, details FROM cv_language");
    $data['Nyelv'] =  $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $data;
  }
}