<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
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
    use CommonSourceConditionMocksTrait;

    /**
     * @param SourceConditionInterface[] $conditions
     *
     * @return void
     *
     * @dataProvider dataProvider
     *
     * @covers ::setConditions
     * @covers ::getConditions
     */
    public function testSettersGetters(array $conditions)
    {
        $condition = new SourceConditionCombinationDouble();

        $condition->setConditions($conditions);

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
                    $this->createConditionMock(),
                    $this->createConditionMock()
                ]
            ]
        ];
    }
}
