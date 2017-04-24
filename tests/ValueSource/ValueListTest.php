<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\ValueSource;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Source\ValueSource\ValueList;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\ValueSource\ValueList
 */
class ValueListTest extends TestCase
{
    /**
     * @param array $values
     *
     * @return void
     *
     * @dataProvider valueProvider
     *
     * @covers ::has
     * @covers ::set
     * @covers ::get
     */
    public function testAccess(array $values)
    {
        $list = new ValueList();
        foreach ($values as $entityId => $value) {
            $this->assertFalse($list->has($entityId));
            $list->set($entityId, $value);
            $this->assertTrue($list->has($entityId));
            $this->assertEquals($value, $list->get($entityId));
        }
    }

    /**
     * @return void
     *
     * @covers ::get
     */
    public function testNullAccess()
    {
        $list = new ValueList();
        $this->assertEquals('Foo', $list->get(41, 'Foo'));
    }

    /**
     * @param array $values
     *
     * @return void
     *
     * @dataProvider valueProvider
     *
     * @covers ::load
     * @covers ::all
     */
    public function testLoadAll(array $values)
    {
        $list = new ValueList();
        $list->load($values);
        $this->assertEquals($values, $list->all());
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
