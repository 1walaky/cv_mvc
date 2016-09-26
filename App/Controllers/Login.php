<?php 
namespace App\Controllers;

use \Core\Controller;
use \Core\View;
use \Core\Session;
use \App\Models\LoginModel;

class Login extends Controller
{

  public function __call($name, $args)
  {
    $method = $name.'Action';

    if(method_exists($this, $method)){
      if(Session::checkUserSession() !== true){
        call_user_func_array([$this, $method], $args);
      }else{
        header('location: /index');
        exit;
      }
    }else{
      throw new Exception('The action: '.$method.' is not exists in this class: '.get_class($this), 404);
    }
  }

  public function indexAction()
  {
    $errors = array();

    if(filter_input(INPUT_POST, 'submit', FILTER_DEFAULT)){
      $username = trim(filter_input(INPUT_POST, 'username', FILTER_DEFAULT));
      $password = trim(filter_input(INPUT_POST, 'password', FILTER_DEFAULT));

      if(mb_strlen($username) < 1){
        $errors['empty_user'] = 'Nem adtál meg felhasználónevet!';
      }
      if(mb_strlen($password) < 1){
        $errors['empty_passw'] = 'Nem adtál meg jelszót!';
      }

      if(empty($errors)){
        $user_data = LoginModel::checkLogin($username, $password);
        if($user_data !== false){
          Session::startUserSession($user_data);
          header('location: /index');
          exit;
        }else{
          $errors['invalid_user'] = 'Nem megfelelő felhasználónév-jelszó páros!';
        }
      }
    }
    View::renderTemplate('Login/index.html', ['errors' => $errors]);
  }
}