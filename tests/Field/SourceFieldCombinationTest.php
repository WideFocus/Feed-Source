<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Field;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Source\Field\SourceFieldCombination;
use WideFocus\Feed\Source\Field\SourceFieldInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Field\SourceFieldCombination
 */
class SourceFieldCombinationTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(
            SourceFieldCombination::class,
            new SourceFieldCombination([])
        );
    }

    /**
     * @return void
     *
     * @covers ::getValue
     */
    public function testGetValue()
    {
        $entityId = 41;

        $children = [
            'foo' => $this->createMock(SourceFieldInterface::class),
            'bar' => $this->createMock(SourceFieldInterface::class)
        ];

        foreach ($children as $name => $child) {
            $child->expects($this->once())
                ->method('getValue')
                ->with($entityId)
                ->willReturn($name . 'Value');
        }

        $field = new SourceFieldCombination($children);
        $this->assertEquals(
            ['foo' => 'fooValue', 'bar' => 'barValue'],
            $field->getValue($entityId)
        );
    }

    /**
     * @return void
     *
     * @covers ::prepare
     */
    public function testPrepare()
    {
        $entityIds = [41, 42, 43];

        $children = [
            'foo' => $this->createMock(SourceFieldInterface::class),
            'bar' => $this->createMock(SourceFieldInterface::class)
        ];

        foreach ($children as $child) {
            $child->expects($this->once())
                ->method('prepare')
                ->with($entityIds);
        }

        $field = new SourceFieldCombination($children);
        $field->prepare($entityIds);
    }
}
