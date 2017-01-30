<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Condition;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Condition\SourceConditionCombination;
use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Feed\Source\Condition\Validator\ValidatorManagerInterface;
use WideFocus\Validator\ValidatorInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Condition\SourceConditionCombination
 */
class SourceConditionCombinationTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return SourceConditionCombination
     *
     * @covers ::__construct
     */
    public function testConstructor(): SourceConditionCombination
    {
        return new SourceConditionCombination(
            $this->createMock(ValidatorManagerInterface::class)
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
            $this->createMock(SourceConditionInterface::class),
            $this->createMock(SourceConditionInterface::class)
        ];

        $validators = $this->createMock(ValidatorManagerInterface::class);
        $condition  = new SourceConditionCombination($validators);

        foreach ($children as $child) {
            $child->expects($this->once())
                ->method('prepare')
                ->with($entityIds);

            $condition->addCondition($child);
        }

        $condition->prepare($entityIds);
    }

    /**
     * @return void
     *
     * @covers ::matches
     */
    public function testMatches()
    {
        $entityId = 41;

        $validator = $this->createMock(ValidatorInterface::class);
        $validator->expects($this->once())
            ->method('__invoke')
            ->willReturnCallback(
                function (array $conditionCallbacks) {
                    $result = true;
                    foreach ($conditionCallbacks as $callback) {
                        $result &= call_user_func($callback);
                    }
                    return $result;
                }
            );

        $validators = $this->createMock(ValidatorManagerInterface::class);
        $validators->expects($this->once())
            ->method('getValidator')
            ->with('logical_and')
            ->willReturn($validator);

        $condition = new SourceConditionCombination($validators);

        $children = [
            $this->createMock(SourceConditionInterface::class),
            $this->createMock(SourceConditionInterface::class)
        ];
        foreach ($children as $child) {
            $child->expects($this->once())
                ->method('matches')
                ->with($entityId)
                ->willReturn(true);

            $condition->addCondition($child);
        }

        $condition->setOperator('logical_and');
        $this->assertTrue($condition->matches($entityId));
    }
}
