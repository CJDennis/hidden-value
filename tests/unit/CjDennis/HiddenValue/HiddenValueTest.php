<?php
namespace CjDennis\HiddenValue;

use Codeception\Test\Unit;
use UnitTester;

class HiddenValueTest extends Unit {
  /**
   * @var UnitTester
   */
  protected $tester;

  protected function _before() {
  }

  protected function _after() {
  }

  // tests
  public function testShouldUseTheHiddenValueTraitInTheExampleClass() {
    self::assertContains(HiddenValue::class, class_uses(ExampleClass::class));
  }
}
