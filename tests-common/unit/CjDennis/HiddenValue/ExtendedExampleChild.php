<?php
namespace CjDennis\HiddenValue;

class ExtendedExampleChild extends ExampleChild {
  public function __construct() {
    /** @noinspection PhpUnhandledExceptionInspection */
    $this->adopt_parent(...func_get_args());
  }
}
