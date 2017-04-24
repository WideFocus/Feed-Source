<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Condition;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Entity\FeedConditionInterface;
use WideFocus\Feed\Source\Condition\SourceCondition;
use WideFocus\Feed\Source\Condition\SourceConditionFactory;
use WideFocus\Feed\Source\ValueSource\ValueSourceFactoryInterface;
use WideFocus\Feed\Source\ValueSource\ValueSourceInterface;
use WideFocus\Parameters\ParameterBagInterface;
use WideFocus\Validator\FactoryAggregate\ValidatorFactoryAggregateInterface;
use WideFocus\Validator\ValidatorInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Condition\SourceConditionFactory
 */
class SourceConditionFactoryTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(
            SourceConditionFactory::class,
            new SourceConditionFactory(
                $this->createMock(ValidatorFactoryAggregateInterface::class),
                $this->createMock(ValueSourceFactoryInterface::class)
            )
        );
    }

    /**
     * @return void
     *
     * @covers ::create
     */
    public function testCreate()
    {
        $sourceParameters = $this->createMock(ParameterBagInterface::class);
        $constraints      = $this->createMock(ParameterBagInterface::class);

        $feedCondition = $this->createMock(FeedConditionInterface::class);
        $feedCondition
            ->expects($this->once())
            ->method('getOperator')
            ->willReturn('foo_operator');

        $feedCondition
            ->expects($this->once())
            ->method('getOperator')
            ->willReturn('foo_operator');

        $feedCondition
            ->expects($this->once())
            ->method('getConstraints')
            ->willReturn($constraints);

        $valueSource        = $this->createMock(ValueSourceInterface::class);
        $valueSourceFactory = $this->createMock(ValueSourceFactoryInterface::class);
        $valueSourceFactory
            ->expects($this->once())
            ->method('create')
            ->with($sourceParameters)
            ->willReturn($valueSource);

        $validator        = $this->createMock(ValidatorInterface::class);
        $validatorFactory = $this->createMock(ValidatorFactoryAggregateInterface::class);
        $validatorFactory
            ->expects($this->once())
            ->method('create')
            ->with('foo_operator', $constraints)
            ->willReturn($validator);

        $factory = new SourceConditionFactory(
            $validatorFactory,
            $valueSourceFactory
        );

        $this->assertInstanceOf(
            SourceCondition::class,
            $factory->create($feedCondition, $sourceParameters)
        );
    }
}
