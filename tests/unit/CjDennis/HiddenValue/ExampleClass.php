<?php
namespace CjDennis\HiddenValue;

class ExampleClass {
  use HiddenValue;

  public function save(string $name, $value) {
    $this->hidden_value($name, $value);
  }

  public function load(string $name) {
    $value = $this->hidden_value($name);
    return $value;
  }
}
