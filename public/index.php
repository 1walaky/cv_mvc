<?php 
require_once dirname(__DIR__).'/vendor/autoload.php';


use Core\Router;
use Core\Session;

Session::sessionStart();

Twig_Autoloader::register();

error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


$router = new Router();

$router->addRoute('{controller}');
$router->addRoute('{controller}/{action}');
$router->addRoute('{controller}/{id:\d+}/{action}');

//Aloldal routolása, jelenleg nincsen admin oldal, ez csak szemléltetés.
/*$router->addRoute('admin/{controller}', ['namespace' => 'Admin']);
$router->addRoute('admin/{controller}/{action}', ['namespace' => 'Admin']);
$router->addRoute('admin/{controller}/{id:\d+}/{action}', ['namespace' => 'Admin']);*/

$url = filter_input(INPUT_SERVER, 'QUERY_STRING', FILTER_SANITIZE_URL);

$router->dispatch($url);