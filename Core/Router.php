<?php
namespace Core;

use \App\Controllers\Index;
use \Exception;
use \ErrorException;

class Router
{
  protected $_routes = array();
  protected $_params = array();

  public function addRoute($route, $params = array())
  {
    $route = preg_replace('/\//', '\\/', $route);
    $route = preg_replace('/\{([a-z-]+)\}/', '(?P<\1>[a-z-]+)', $route);
    $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
    $route = '/^'.$route.'$/i';
    $this->_routes[$route] = $params;
  }  

  protected function _matchRoute($url)
  {
    foreach($this->_routes as $route => $params){
      if(preg_match($route, $url, $matches)){
        foreach($matches as $key => $match){
          if(is_string($key)){
            $params[$key] = $match;
          }
        }
        $this->_params = $params;
        if(key_exists('namespace', $params)){
          return true;
        }
      }
    }
    if(key_exists('controller', $this->_params)){
      return true;
    }
    return false;
  }

  public function dispatch($url)
  { 
    $url = $this->_removeQueryStringVariables($url);

    if($this->_matchRoute($url)){
      $controller = $this->_params['controller'];
      $controller = $this->_convertToStudyCaps($controller);
      $controller = $this->_getNamespace().$controller;
      if(class_exists($controller)){
        $controller_object = new $controller($this->_params);
        $action = isset($this->_params['action']) ? $this->_params['action'] : 'index';
        $action = $this->_convertToCamelCase($action);
        $controller_object->$action(); 
      }else{
        throw new Exception('The controller class is not exists: '.$controller, 404);
      }
    }else{
      if($url == ''){
        $controller_object = new Index($this->_params);
        $controller_object->index();
      }else{
        throw new Exception('This url is not match any route: '.$url, 404);
      }
    }
  }

  protected function _removeQueryStringVariables($url)
  {
    if($url != ''){
      $parts = explode('&', $url, 2);
      if(strpos($parts[0], '=') === false){
        $url = $parts[0];
      }else{
        $url = '';
      }
    }
    $url = preg_replace('/\/$/', '', $url);
    return $url;
  }

  protected function _convertToStudyCaps($string)
  {
    return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
  }

  protected function _convertToCamelCase($string)
  {
    return lcfirst($this->_convertToStudyCaps($string));
  }

  protected function _getNamespace()
  { 
    $namespace = 'App\Controllers\\';

    if(key_exists('namespace', $this->_params)){
      $namespace .= $this->_params['namespace'].'\\';
    }
    return $namespace;
  }
}
