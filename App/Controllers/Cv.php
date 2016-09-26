<?php
namespace App\Controllers;

use \Core\Controller;
use \Core\View;
use \App\Models\CvModel;

/**
* 
*/
class Cv extends Controller
{
  public function indexAction()
  {
    $letter = CvModel::getLetter();
    $data = CvModel::getData();

    View::renderTemplate('Cv/index.html', array(
      'letter'    => $letter, 
      'data'      => $data
      ));
  }
}