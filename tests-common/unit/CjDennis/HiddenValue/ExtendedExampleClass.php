<?php
namespace CjDennis\HiddenValue;

class ExtendedExampleClass extends ExampleClass {
  public function extended_save(string $name, $value) {
    $this->hidden_value($name, $value);
  }

  public function extended_load(string $name) {
    $value = $this->hidden_value($name);
    return $value;
  }

  public function extended_save_nameless($value) {
    $this->hidden_value(null, $value);
  }

  public function extended_load_nameless() {
    $value = $this->hidden_value(null);
    return $value;
  }
}
