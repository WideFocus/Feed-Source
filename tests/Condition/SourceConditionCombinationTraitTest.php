<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Condition;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Feed\Source\Tests\Condition\TestDouble\SourceConditionCombinationDouble;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Condition\SourceConditionCombinationTrait
 */
class SourceConditionCombinationTraitTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param SourceConditionInterface[] $conditions
     *
     * @return void
     *
     * @dataProvider dataProvider
     *
     * @covers ::addCondition
     * @covers ::getConditions
     */
    public function testSettersGetters(array $conditions)
    {
        $condition = new SourceConditionCombinationDouble();
        foreach ($conditions as $child) {
            $condition->addCondition($child);
        }

        $this->assertEquals($conditions, $condition->peekConditions());
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                [
                    $this->createMock(SourceConditionInterface::class),
                    $this->createMock(SourceConditionInterface::class)
                ]
            ]
        ];
    }
}
