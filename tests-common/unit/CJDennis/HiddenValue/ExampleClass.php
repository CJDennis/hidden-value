<?php
namespace CJDennis\HiddenValue;

class ExampleClass {
  use HiddenValue;

  public function save(string $name, $value) {
    $this->hidden_value($name, $value);
  }

  public function load(string $name) {
    $value = $this->hidden_value($name);
    return $value;
  }

  public function save_nameless($value) {
    $this->hidden_value(null, $value);
  }

  public function load_nameless() {
    $value = $this->hidden_value(null);
    return $value;
  }
}
