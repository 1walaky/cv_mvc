<?php
namespace Core;

use \App\Config;
use \ErrorException;
use \Exception;

class Error
{
  public static function errorHandler($label, $message, $file, $line)
  {
    if(error_reporting() != 0){
      throw new ErrorException($message, 0, $label, $file, $line);
    }
  }  

  public static function exceptionHandler($exception)
  {
    $code = $exception->getCode();
    if($code != 404){
      $code = 500;
    }
    http_response_code($code);

    $err_class = 'Thrown by: '.get_class($exception);
    $err_message = 'With message: '.$exception->getMessage();
    $err_trace = 'Stack trace: '.$exception->getTraceAsString();
    $err_file = 'In file: '.$exception->getFile();
    $err_line = 'On line: '.$exception->getLine();

    if(Config::SHOW_ERRORS){
      $output = '<h1>FATAL ERROR</h1>';
      $output .= '<p>'.$err_class.'</p>';
      $output .= '<p>'.$err_message.'</p>';
      $output .= '<p><strong>'.$err_file.'</strong></p>';
      $output .= '<p><strong>'.$err_line.'</strong></p>';
      $output .= '<p>'.$err_trace.'</p>';
      echo $output;
    }else{
      $log = dirname(__DIR__).'/logs/'.date('Y-m-d').'.txt';
      ini_set('error_log', $log);

      $message = $err_class;
      $message .= "\n".$err_message;
      $message .= "\n".$err_trace;
      $message .= "\n".$err_file; 
      $message .= "\n".$err_line;  

      error_log($message);

      View::renderTemplate('Error/'.$code.'.html');
    }
  }
}