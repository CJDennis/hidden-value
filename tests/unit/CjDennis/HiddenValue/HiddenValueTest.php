<?php
namespace CjDennis\HiddenValue;

use Codeception\Test\Unit;
use stdClass;
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

  public function testShouldRetrieveASavedValue() {
    $example_class = new ExampleClass();
    $value = new stdClass();
    $example_class->save('foobar', $value);
    self::assertSame($value, $example_class->load('foobar'));
  }

  public function testShouldRetrieveAnUnnamedSavedValue() {
    $example_class = new ExampleClass();
    $value = new stdClass();
    $example_class->save_nameless($value);
    self::assertSame($value, $example_class->load_nameless());
  }
}
