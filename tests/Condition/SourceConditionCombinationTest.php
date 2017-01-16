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
use WideFocus\Feed\Source\Condition\Validator\ValidatorContainerInterface;
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
        /** @var ValidatorContainerInterface|PHPUnit_Framework_MockObject_MockObject $validators */
        $validators = $this->createMock(ValidatorContainerInterface::class);
        return new SourceConditionCombination($validators);
    }

    /**
     * @return void
     *
     * @covers ::prepare
     */
    public function testPrepare()
    {
        $entityIds = [41, 42, 43];

        /** @var SourceConditionInterface[]|PHPUnit_Framework_MockObject_MockObject[] $children */
        $children = [
            $this->createMock(SourceConditionInterface::class),
            $this->createMock(SourceConditionInterface::class)
        ];

        /** @var ValidatorContainerInterface|PHPUnit_Framework_MockObject_MockObject $validators */
        $validators = $this->createMock(ValidatorContainerInterface::class);
        $condition  = new SourceConditionCombination($validators);

        /** @var PHPUnit_Framework_MockObject_MockObject|SourceConditionInterface $child */
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
     * @covers ::isValid
     */
    public function testIsValid()
    {
        $entityId = 41;

        /** @var ValidatorInterface|PHPUnit_Framework_MockObject_MockObject $validator */
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

        /** @var ValidatorContainerInterface|PHPUnit_Framework_MockObject_MockObject $validators */
        $validators = $this->createMock(ValidatorContainerInterface::class);
        $validators->expects($this->once())
            ->method('getValidator')
            ->with('logical_and')
            ->willReturn($validator);

        $condition = new SourceConditionCombination($validators);

        /** @var SourceConditionInterface[]|PHPUnit_Framework_MockObject_MockObject[] $children */
        $children = [
            $this->createMock(SourceConditionInterface::class),
            $this->createMock(SourceConditionInterface::class)
        ];
        foreach ($children as $child) {
            $child->expects($this->once())
                ->method('isValid')
                ->with($entityId)
                ->willReturn(true);

            $condition->addCondition($child);
        }

        $condition->setOperator('logical_and');
        $this->assertTrue($condition->isValid($entityId));
    }
}
