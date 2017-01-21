<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Field;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Tests\Field\TestDouble\SourceFieldDouble;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Field\SourceFieldTrait
 */
class SourceFieldTraitTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param string $value
     *
     * @return void
     *
     * @dataProvider dataProvider
     *
     * @covers ::setAttributeCode
     * @covers ::getAttributeCode
     */
    public function testGetSetAttributeCode(string $value)
    {
        $field = new SourceFieldDouble();
        $field->setAttributeCode($value);
        $this->assertEquals($value, $field->peekAttributeCode());
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            ['Foo']
        ];
    }
}
