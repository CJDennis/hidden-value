<?php
namespace CJDennis\HiddenValue;

class ExampleChild extends ExampleParent {
  use HiddenValue;

  public $a;
  protected $b;
  private $c;

  public function __construct() {
    /** @noinspection PhpUnhandledExceptionInspection */
    $this->adopt_parent(...func_get_args());
  }
}
