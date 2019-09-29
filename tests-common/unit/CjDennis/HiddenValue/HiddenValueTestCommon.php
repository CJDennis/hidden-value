<?php
namespace CjDennis\HiddenValue;

use stdClass;

trait HiddenValueTestCommon {
  public function testShouldUseTheHiddenValueTraitInTheExampleClass() {
    $this->assertContains(HiddenValue::class, class_uses(ExampleClass::class));
  }

  public function testShouldRetrieveASavedValue() {
    $example_class = new ExampleClass();
    $value = new stdClass();
    $example_class->save('foobar', $value);
    $this->assertSame($value, $example_class->load('foobar'));
  }

  public function testShouldRetrieveAnUnnamedSavedValue() {
    $example_class = new ExampleClass();
    $value = new stdClass();
    $example_class->save_nameless($value);
    $this->assertSame($value, $example_class->load_nameless());
  }

  public function testShouldStoreMultipleDifferentValues() {
    $example_class = new ExampleClass();
    $value = new stdClass();
    $value_1 = new stdClass();
    $value_2 = new stdClass();
    $example_class->save('foo', $value_1);
    $example_class->save_nameless($value);
    $example_class->save('bar', $value_2);
    $this->assertSame($value_1, $example_class->load('foo'), 'The correct value of $foo was not retrieved');
    $this->assertSame($value, $example_class->load_nameless(), 'The correct nameless value was not retrieved');
    $this->assertSame($value_2, $example_class->load('bar'), 'The correct value of $bar was not retrieved');
  }

  public function testShouldStoreDifferentValuesForDifferentInstances() {
    $example_class_1 = new ExampleClass();
    $example_class_2 = new ExampleClass();
    $value_1a = new stdClass();
    $value_1b = new stdClass();
    $value_2a = new stdClass();
    $value_2b = new stdClass();
    $example_class_1->save_nameless($value_1a);
    $example_class_1->save('foo', $value_1b);
    $example_class_2->save('bar', $value_2a);
    $example_class_2->save_nameless($value_2b);
    $this->assertSame($value_1a, $example_class_1->load_nameless(), 'The correct nameless value for example 1 was not retrieved');
    $this->assertSame($value_1b, $example_class_1->load('foo'), 'The correct value of $foo for example 1 was not retrieved');
    $this->assertSame($value_2a, $example_class_2->load('bar'), 'The correct value of $bar for example 2 was not retrieved');
    $this->assertSame($value_2b, $example_class_2->load_nameless(), 'The correct nameless value for example 2 was not retrieved');
  }
}
