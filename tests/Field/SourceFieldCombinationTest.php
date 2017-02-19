<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Field;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Field\SourceFieldCombination;
use WideFocus\Feed\Source\Field\SourceFieldInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Field\SourceFieldCombination
 */
class SourceFieldCombinationTest extends PHPUnit_Framework_TestCase
{
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

        $field  = new SourceFieldCombination();

        foreach ($children as $name => $child) {
            $child->expects($this->once())
                ->method('prepare')
                ->with($entityIds);

            $field->addField($child, $name);
        }

        $field->prepare($entityIds);
    }

    /**
     * @return void
     *
     * @covers ::getValue
     */
    public function testGetValue()
    {
        $entityId = 41;

        $field = new SourceFieldCombination();

        $children = [
            'foo' => $this->createMock(SourceFieldInterface::class),
            'bar' => $this->createMock(SourceFieldInterface::class)
        ];

        foreach ($children as $name => $child) {
            $child->expects($this->once())
                ->method('getValue')
                ->with($entityId)
                ->willReturn($name . 'Value');

            $field->addField($child, $name);
        }

        $this->assertEquals(
            ['foo' => 'fooValue', 'bar' => 'barValue'],
            $field->getValue($entityId)
        );
    }
}
