<?php
namespace Core;

use \Exception;

abstract class Controller
{
  protected $_route_params;

  public function __construct($route_params = array())
  { 
    $this->_route_params = $route_params;
  }

  public function __call($name, $args)
  {
    $method = $name.'Action';
    if(method_exists($this, $method)){
      if(Session::checkUserSession() !== false){
        call_user_func_array(array($this, $method), $args);
      }else{
        header('location: /login');
        exit;
      }
    }else{
      throw new Exception('The action: '.$method.' is not exists in this class: '.get_class($this), 404);
    }
  }
}