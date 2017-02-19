<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Condition;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Tests\Condition\TestDouble\SourceConditionDouble;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Condition\SourceConditionTrait
 */
class SourceConditionTraitTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param string $attributeCode
     * @param string $operator
     * @param mixed  $value
     *
     * @return void
     *
     * @dataProvider dataProvider
     *
     * @covers ::setAttributeCode
     * @covers ::getAttributeCode
     * @covers ::setOperator
     * @covers ::getOperator
     * @covers ::setValue
     * @covers ::getValue
     */
    public function testSettersGetters(string $attributeCode, string $operator, $value)
    {
        $condition = new SourceConditionDouble();

        $condition->setAttributeCode($attributeCode);
        $condition->setOperator($operator);
        $condition->setValue($value);

        $this->assertEquals($attributeCode, $condition->peekAttributeCode());
        $this->assertEquals($operator, $condition->peekOperator());
        $this->assertEquals($value, $condition->peekValue());
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                'the_attribute_code',
                'the_operator',
                'some_value'
            ]
        ];
    }
}
