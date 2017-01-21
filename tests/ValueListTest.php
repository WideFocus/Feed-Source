<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests;

use WideFocus\Feed\Source\ValueList;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\ValueList
 */
class ValueListTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param array $values
     *
     * @return void
     *
     * @dataProvider valueProvider
     *
     * @covers ::hasEntityValue
     * @covers ::setEntityValue
     * @covers ::getEntityValue
     */
    public function testAccess(array $values)
    {
        $list = new ValueList();
        foreach ($values as $entityId => $value) {
            $this->assertFalse($list->hasEntityValue($entityId));
            $list->setEntityValue($entityId, $value);
            $this->assertTrue($list->hasEntityValue($entityId));
            $this->assertEquals($value, $list->getEntityValue($entityId));
        }
    }

    /**
     * @return void
     *
     * @covers ::getEntityValue
     */
    public function testNullAccess()
    {
        $list = new ValueList();
        $this->assertEquals('Foo', $list->getEntityValue(41, 'Foo'));
    }

    /**
     * @param array $values
     *
     * @return void
     *
     * @dataProvider valueProvider
     *
     * @covers ::setValues
     * @covers ::getValues
     */
    public function testValuesGetSet(array $values)
    {
        $list = new ValueList();
        $list->setValues($values);
        $this->assertEquals($values, $list->getValues());
    }

    /**
     * @return array
     */
    public function valueProvider(): array
    {
        return [
            [
                [
                    'foo' => 'Foo',
                    1000  => 'Bar',
                    'baz' => null
                ]
            ]
        ];
    }
}
