<?php
namespace CJDennis\HiddenValue;

class ExtendedExampleChild extends ExampleChild {
  /** @noinspection PhpMissingParentConstructorInspection */
  public function __construct() {
    /** @noinspection PhpUnhandledExceptionInspection */
    $this->adopt_parent(...func_get_args());
  }
}
