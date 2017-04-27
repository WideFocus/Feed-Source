<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Source\SourceItem;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\SourceItem
 */
class SourceItemTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(
            SourceItem::class,
            new SourceItem()
        );
    }

    /**
     * @param array $values
     *
     * @return void
     *
     * @dataProvider valueProvider
     *
     * @covers ::__construct
     */
    public function testConstructorValues(array $values)
    {
        $item = new SourceItem($values);
        foreach ($values as $key => $value) {
            $this->assertEquals($value, $item[$key]);
        }
    }

    /**
     * @param array $values
     *
     * @return void
     *
     * @dataProvider valueProvider
     *
     * @covers ::offsetExists
     * @covers ::offsetSet
     * @covers ::offsetGet
     * @covers ::offsetUnset
     */
    public function testArrayAccess(array $values)
    {
        $item = new SourceItem();
        foreach ($values as $key => $value) {
            $this->assertFalse($item->offsetExists($key));
            $item[$key] = $value;
            $this->assertTrue($item->offsetExists($key));
            $this->assertEquals($value, $item[$key]);
            unset($item[$key]);
            $this->assertFalse($item->offsetExists($key));
        }
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
