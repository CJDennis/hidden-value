<?php
namespace CjDennis\HiddenValue;

trait HiddenValue {
  protected function hidden_value($name = null, $value = null) {
    static $keys = [];
    static $values = [];

    $key = array_search($this, $keys, true);
    if (func_num_args() < 2) {
      if ($key !== false) {
        $value = $values[$key];
      }
    }
    else {
      if ($key !== false) {
        $values[$key] = $value;
      }
      else {
        $keys[] = $this;
        $values[] = $value;
      }
    }
    return $value;
  }
}
