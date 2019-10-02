<?php
namespace CJDennis\HiddenValue;

use DateTime;
use DateTimeZone;

class ExtendedDateTime extends DateTime {
  use HiddenValue;

  /** @noinspection PhpMissingParentConstructorInspection */
  public function __construct($time='now', DateTimeZone $timezone=null) {
    $this->adopt_parent(...func_get_args());
  }

  public function load() {
    return $this->hidden_value();
  }
}
