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

  public function testShouldStoreMultipleDifferentValues() {
    $example_class = new ExampleClass();
    $value = new stdClass();
    $value_1 = new stdClass();
    $value_2 = new stdClass();
    $example_class->save('foo', $value_1);
    $example_class->save_nameless($value);
    $example_class->save('bar', $value_2);
    self::assertSame($value_1, $example_class->load('foo'), 'The correct value of $foo was not retrieved');
    self::assertSame($value, $example_class->load_nameless(), 'The correct nameless value was not retrieved');
    self::assertSame($value_2, $example_class->load('bar'), 'The correct value of $bar was not retrieved');
  }
}
