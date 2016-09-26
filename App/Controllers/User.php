<?php
namespace App\Controllers;

use \Core\Controller;
use \Core\Session;

/**
* 
*/
class User extends Controller
{
  public function logoutAction()
  {
    Session::stopUserSession();
    header('location: /index');
    exit;
  }
}