<?php
namespace Core;

use \Exception;

class View
{
  public static function render($file, $args = array())
  {
    $full_file = dirname(__DIR__).'/App/Views/'.$file;
    if(is_readable($full_file)){
      if(!empty($args)){
        extract($args);
      }
      require_once $full_file;
    }else{
      throw new Exception('The view file is not readable: '.$full_file, 500);
    }
  }

  public static function renderTemplate($file, $args = [])
  {
    $twig = null;
    if($twig === null){
      $loader = new \Twig_Loader_Filesystem(dirname(__DIR__).'/App/Views/');
      $twig = new \Twig_Environment($loader);
    }
    echo $twig->render($file, $args);
  }
}