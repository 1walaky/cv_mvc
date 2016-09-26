<?php 
namespace App\Controllers;

use \Core\Controller;
use \Core\View;

/**
* 
*/
class Posts extends Controller
{
  public function indexAction()
  {
    View::render('Index/index.html');
  }
}