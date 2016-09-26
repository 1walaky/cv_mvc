<?php 
namespace App\Controllers;

use \Core\Controller;
use \Core\View;
use \App\Models\IndexModel;

/**
* 
*/
class Index extends Controller
{
  public function indexAction()
  {
    $intro = IndexModel::getIntro();
    View::renderTemplate('Index/index.html', array('intro' => $intro));
  }
}