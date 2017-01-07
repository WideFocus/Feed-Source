<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Condition;

use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Condition\SourceConditionCombination;
use WideFocus\Feed\Source\Condition\SourceConditionInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Condition\SourceConditionCombination
 */
class SourceConditionCombinationTest extends PHPUnit_Framework_TestCase
{
    use CommonSourceConditionMocksTrait;

    /**
     * @return SourceConditionCombination
     *
     * @covers ::__construct
     */
    public function testConstructor(): SourceConditionCombination
    {
        return new SourceConditionCombination(
            $this->createValidatorContainerMock()
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

        $conditions = [
            $this->createConditionMock(),
            $this->createConditionMock()
        ];

        /** @var PHPUnit_Framework_MockObject_MockObject $child */
        foreach ($conditions as $child) {
            $child->expects($this->once())
                ->method('prepare')
                ->with($entityIds);
        }

        $condition = new SourceConditionCombination(
            $this->createValidatorContainerMock()
        );

        $condition->setConditions($conditions);
        $condition->prepare($entityIds);
    }

    /**
     * @return void
     *
     * @covers ::isValid
     */
    public function testIsValid()
    {
        $item = $this->createArrayAccessMock();

        $validator = $this->createValidatorMock();
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

        $validators = $this->createValidatorContainerMock();
        $validators->expects($this->once())
            ->method('getValidatorWithItem')
            ->with('logical_and', $item)
            ->willReturn($validator);

        $conditions = [
            $this->createConditionMock(),
            $this->createConditionMock()
        ];

        /** @var PHPUnit_Framework_MockObject_MockObject $child */
        foreach ($conditions as $child) {
            $child->expects($this->once())
                ->method('isValid')
                ->with($item)
                ->willReturn(true);
        }

        $condition = new SourceConditionCombination($validators);

        $condition->setConditions($conditions);
        $condition->setOperator('logical_and');
        $this->assertTrue($condition->isValid($item));
    }
}
