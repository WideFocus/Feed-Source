<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Field;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Field\SourceFieldInterface;
use WideFocus\Feed\Source\Tests\Field\TestDouble\SourceFieldCombinationDouble;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Field\SourceFieldCombinationTrait
 */
class SourceFieldCombinationTraitTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param array $fields
     *
     * @return void
     *
     * @dataProvider dataProvider
     *
     * @covers ::addField
     * @covers ::getFields
     */
    public function testGetAddFields(array $fields)
    {
        $combination = new SourceFieldCombinationDouble();
        foreach ($fields as $name => $field) {
            $combination->addField($field, $name);
        }
        $this->assertEquals($fields, $combination->peekFields());
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                [
                    'foo' => $this->createMock(SourceFieldInterface::class),
                    'bar' => $this->createMock(SourceFieldInterface::class)
                ]
            ]
        ];
    }
}
