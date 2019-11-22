<?php
namespace CJDennis\HiddenValue;

trait AdoptedParentTestCommon {
  protected function _before() {
  }

  protected function _after() {
  }

  // tests
  public function testShouldCopyThePropertiesOfAParentIntoItsChildClass() {
    $extended_example_child = new ExtendedExampleChild();
    $this->assertSame(
      "O:41:\"CJDennis\\HiddenValue\\ExtendedExampleChild\":4:{s:1:\"a\";i:1;s:4:\"\x00*\x00b\";i:2;s:36:\"\x00CJDennis\\HiddenValue\\ExampleChild\x00c\";i:3;s:37:\"\x00CJDennis\\HiddenValue\\ExampleParent\x00c\";i:3;}",
      serialize($extended_example_child)
    );
  }
}
