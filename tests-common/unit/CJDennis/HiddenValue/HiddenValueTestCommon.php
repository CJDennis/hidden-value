<?php
/** @noinspection PhpUnused */
namespace CJDennis\HiddenValue;

use DateTime;
use stdClass;

trait HiddenValueTestCommon {
  protected function _before() {
  }

  protected function _after() {
  }

  // tests
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

  public function testShouldStoreDifferentValuesForExtendedClasses() {
    $example_class = new ExampleClass();
    $extended_example_class = new ExtendedExampleClass();
    $value_1a = new stdClass();
    $value_1b = new stdClass();
    $value_2a = new stdClass();
    $value_2b = new stdClass();
    $example_class->save_nameless($value_1a);
    $example_class->save('foo', $value_1b);
    $extended_example_class->extended_save('foo', $value_2a);
    $extended_example_class->extended_save_nameless($value_2b);
    $this->assertSame($value_1a, $example_class->load_nameless(), 'The correct nameless value for example 1 was not retrieved');
    $this->assertSame($value_1b, $example_class->load('foo'), 'The correct value of $foo for example 1 was not retrieved');
    $this->assertSame($value_2a, $extended_example_class->extended_load('foo'), 'The correct value of $bar for example 2 was not retrieved');
    $this->assertSame($value_2b, $extended_example_class->extended_load_nameless(), 'The correct nameless value for example 2 was not retrieved');
  }

  public function testShouldCopyThePropertiesOfAParentIntoItsChildClass() {
    $extended_class = ExtendedExampleChild::class;
    $extended_length = strlen($extended_class);
    $child_class = get_parent_class($extended_class);
    $child_property = "\x00{$child_class}\x00c";
    $child_length = strlen($child_property);
    $parent_class = get_parent_class($child_class);
    $parent_property = "\x00{$parent_class}\x00c";
    $parent_length = strlen($parent_property);

    $extended_example_child = new $extended_class();
    $this->assertSame(
      "O:{$extended_length}:\"{$extended_class}\":4:{s:1:\"a\";i:1;s:4:\"\x00*\x00b\";i:2;s:{$child_length}:\"{$child_property}\";i:3;s:{$parent_length}:\"{$parent_property}\";i:3;}",
      serialize($extended_example_child)
    );
  }

  public function testShouldCopyThePseudoPropertiesOfAStandardClassIntoItsChildClass() {
    $extended_class = ExtendedDateTime::class;
    $extended_length = strlen($extended_class);

    date_default_timezone_set('UTC');
    $extended_date_time = new $extended_class('1999-12-31 23:59:59');
    $this->assertSame(
      "O:{$extended_length}:\"{$extended_class}\":3:{s:4:\"date\";s:26:\"1999-12-31 23:59:59.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}",
      serialize($extended_date_time)
    );
  }

  public function testShouldGetTheHiddenParentValue() {
    $extended_date_time = new ExtendedDateTime('1999-12-31 23:59:59');
    $this->assertInstanceOf(DateTime::class,
      $extended_date_time->load()
    );
  }
}
