<?php
namespace CjDennis\HiddenValue;

use stdClass;

trait HiddenValue {
  protected function hidden_value($name = null, $value = null) {
    static $data = [];

    $keys = array_map(function ($item) {
      return $item->key;
    }, $data);
    $key = array_search($this, $keys, true);
    if ($key === false) {
      $item = new stdClass();
      $item->key = $this;
      $item->value = null;
      $item->named_value = new stdClass();
      if (func_num_args() >= 2) {
        $data[] = $item;
      }
    }
    else {
      $item = $data[$key];
    }

    if (func_num_args() < 2) {
      if ($name === null) {
        $value = $item->value;
      }
      else {
        $value = $item->named_value->$name;
      }
    }
    else {
      if ($name === null) {
        $item->value = $value;
      }
      else {
        $item->named_value->$name = $value;
      }
    }

    return $value;
  }
}
