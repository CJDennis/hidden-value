<?php
namespace CjDennis\HiddenValue;

use stdClass;

trait HiddenValue {
  protected function hidden_value($name = null, $value = null) {
    static $keys = [];
    static $values = [];
    static $named_values = [];

    $key = array_search($this, $keys, true);
    if (func_num_args() < 2) {
      if ($key !== false) {
        if ($name === null) {
          $value = $values[$key];
        }
        else {
          $value = $named_values[$key]->$name;
        }
      }
    }
    else {
      if ($key !== false) {
        if ($name === null) {
          $values[$key] = $value;
        }
        else {
          $named_values[$key]->$name = $value;
        }
      }
      else {
        $keys[] = $this;
        if ($name === null) {
          $values[] = $value;
          $named_values[] = new stdClass();
        }
        else {
          $values[] = null;
          $std_class = new stdClass();
          $std_class->$name = $value;
          $named_values[] = $std_class;
        }
      }
    }
    return $value;
  }
}
