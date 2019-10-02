<?php
namespace CjDennis\HiddenValue;

use PHPUnit\Framework\TestCase;

/** @covers \CjDennis\HiddenValue\HiddenValue */
class HiddenValueTest extends TestCase {
  protected function setUp(): void {
    $this->_before();
  }

  protected function tearDown(): void {
    $this->_after();
  }

  use HiddenValueTestCommon;
}
