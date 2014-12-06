<?php

class Response {

  public static function allow_method($method){
    if ($_SERVER['REQUEST_METHOD'] !== $method){
      self::JSON(405, 'Método no soportado', array('Allow' => array('value' => $method, 'replace' => true)));
    }
  }

  public static function json($code, $message, $headers = NULL){
    http_response_code($code);
    header('Content-Type: application/json', true);

    if (!is_null($headers)){
      foreach ($headers as $key => $value){
        header($key . ': ' . $value['value'], $value['replace']);
      }
    }

    if (!is_null($message) && !empty($message)){
      echo json_encode(array(
        'message' => $message
      ));
    }
    die;
  }

}

?>