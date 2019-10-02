<?php
namespace CJDennis\HiddenValue;

use ReflectionClass;
use ReflectionException;
use stdClass;

trait HiddenValue {
  /**
   * @param null $func_get_args Call `$this->adopt_parent(...func_get_args());` from __construct().
   * @throws ReflectionException
   */
  protected function adopt_parent($func_get_args = null) {
    $parent = new parent(...func_get_args());
    $this->hidden_value(null, $parent);

    foreach ($parent as $name => $value) {
      $this->$name = $value;
    }

    $reflection_class = new ReflectionClass($parent);
    $reflection_properties = $reflection_class->getProperties();
    foreach ($reflection_properties as $reflection_property) {
      $reflection_property->setAccessible(true);
      $name = $reflection_property->getName();
      $value = $reflection_property->getValue($parent);
      $this->$name = $value;
    }
  }

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
