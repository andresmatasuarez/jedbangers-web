<?php

require_once '../../../../vendor/autoload.php';
use Underscore\Types\Arrays;
use Underscore\Types\Object;

class Form {

  protected $fields;
  protected $values = array();
  protected $error_messages = array(
    'illegal'   => '"%key%" es un campo no permitido en el formulario',
    'required'  => '"%field%" es un campo requerido',
    'invalid'   => 'El campo "%field%" es inválido',
    'maxlength' => 'El campo "%field%" es demasiado largo (máximo: %maxlength% caracteres)',
    'minvalue'  => 'El campo "%field%" es menor al mínimo valor permitido (%minvalue%)',
    'maxvalue'  => 'El campo "%field%" es mayor al máximo valor permitido (%maxvalue%)',
    'range'     => 'El campo "%field%" está fuera del rango de valores permitidos (mínimo: %minvalue%, máximo: %maxvalue%)',
    'select'    => 'El campo "%field%" no está incluído dentro de la lista de valores permitidos (valores permitidos: %select%)'
  );

  function __construct($fields){
    $this->fields = $fields;
  }

  function __destruct(){

  }

  protected function build_error($key, $placeholders = NULL){
    if (is_null($placeholders)){
      return $this->error_messages[$key];
    }
    return str_replace(array_keys($placeholders), array_values($placeholders), $this->error_messages[$key]);
  }

  function get_fields(){
    return $this->fields;
  }

  function values(){
    return $this->values;
  }

  function value($key){
    return isset($this->values()[$key]) ? $this->values()[$key] : '';
  }

  function validate_whitelist(){
    return Object::values(Arrays::clean(Arrays::each(Object::keys($_POST), function($key){
      if (!Arrays::has($this->get_fields(), $key)) {
        return $this->build_error('illegal', array( '%key%' => $key ));
      }
    })));
  }

  function validate_required(){
    $required = Arrays::filter($this->get_fields(), function($field){
      return isset($field['required']) && $field['required'];
    });

    return Object::values(Arrays::clean(Arrays::each($required, function($field, $key){
      if (!isset($_POST[$key]) || empty(trim($_POST[$key]))){
        return $this->build_error('required', array( '%field%' => $field['label'] ));
      }
    })));
  }

  function fill_values(){
    Arrays::each($this->get_fields(), function($field, $key){
      if (isset($_POST[$key])){
        $value = $_POST[$key];
        switch($field['type']){
          case 'string':
            $this->values[$key] = filter_var(trim($value), FILTER_SANITIZE_STRING);
            break;
          case 'email':
            $this->values[$key] = filter_var(trim($value), FILTER_SANITIZE_EMAIL);
            break;
          case 'number':
            $this->values[$key] = preg_replace('/\D/', '', trim($value));
            break;
        }
      }
    });
  }

  function validate_format(){
    return Object::values(Arrays::clean(Arrays::each($this->values(), function($value, $key){
      $field = $this->get_fields()[$key];
      if (empty($value)){
        if (isset($field['required']) && $field['required']){
          return $this->build_error('invalid', array( '%field%' => $field['label']));
        }
      } else {
        switch ($field['type']){
        case 'string':
          if (isset($field['maxlength'])){
            $maxlength = $field['maxlength'];
            if (strlen($value) > $maxlength){
              return $this->build_error('invalid', array(
                '%field%'   => $field['label'],
                '%maxlength%' => $maxlength
              ));
            }
          }
          break;
        case 'email':
          if (!filter_var($value, FILTER_VALIDATE_EMAIL)){
            return $this->build_error('invalid', array(
              '%field%' => $field['label']
            ));
          }
          break;
        case 'number':
          if (!is_numeric($value)){
            return $this->build_error('invalid', array( '%field%' => $field['label']));
          } else {
            $value = intval($value);
            if (isset($field['minvalue']) && isset($field['maxvalue'])){
              $min = $field['minvalue'];
              $max = $field['maxvalue'];
              if ($value < $min || $max < $value){
                return $this->build_error('range', array(
                  '%field%' => $field['label'],
                  '%minvalue%' => $min,
                  '%maxvalue%' => $max
                ));
              }

            } else if (isset($field['minvalue'])){
              $min = $field['minvalue'];
              if ($value < $min){
                return $this->build_error('minvalue', array(
                  '%field%' => $field['label'],
                  '%minvalue%' => $min
                ));
              }

            } else if (isset($field['maxvalue'])){
              $max = $field['maxvalue'];
              if ($max < $value){
                return $this->build_error('maxvalue', array(
                  '%field%' => $field['label'],
                  '%maxvalue%' => $max
                ));
              }

            } else if (isset($field['select'])){
              if (!Arrays::contains($field['select'], $value)){
                return $this->build_error('select', array(
                  '%field%' => $field['label'],
                  '%select%' => implode(', ', $field['select'])
                ));
              }
            }
          }
          break;
        }
      }
    })));
  }

}

?>
