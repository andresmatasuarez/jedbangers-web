<?php

class Session {

  public static function generate_token($name){
    // Generate a token from an unique value, took from microtime, you can also use salt-values, other crypting methods...
    $token = md5(uniqid(microtime(), true));

    // Write the generated token to the session variable to check it against the hidden field when the form is sent
    $_SESSION[$name] = $token;

    return $token;
  }

  public static function verify_token($name, $token){
    // Check if a session is started and a token is transmitted, if not return an error
    if(!isset($_SESSION[$name])) {
      return false;
    }

    // Compare the tokens against each other if they are still the same
    if ($_SESSION[$name] !== $token) {
      return false;
    }

    return true;
  }

}

?>