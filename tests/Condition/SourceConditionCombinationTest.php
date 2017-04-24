<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Condition;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Source\Condition\SourceConditionCombination;
use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Validator\ValidatorInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Condition\SourceConditionCombination
 */
class SourceConditionCombinationTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        $validator = function () : bool {
            return true;
        };

        $this->assertInstanceOf(
            SourceConditionCombination::class,
            new SourceConditionCombination(
                $validator
            )
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

        foreach ($children as $child) {
            $child->expects($this->once())
                ->method('prepare')
                ->with($entityIds);
        }

        $condition = new SourceConditionCombination(
            $this->createMock(ValidatorInterface::class),
            ...$children
        );

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

        $children = [
            $this->createMock(SourceConditionInterface::class),
            $this->createMock(SourceConditionInterface::class)
        ];

        foreach ($children as $child) {
            $child->expects($this->once())
                ->method('matches')
                ->with($entityId)
                ->willReturn(true);
        }

        $condition = new SourceConditionCombination($validator, ...$children);
        $this->assertTrue($condition->matches($entityId));
    }
}
