<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests;

use WideFocus\Feed\Entity\FeedConditionInterface;
use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Source\Condition\FactoryAggregate\SourceConditionFactoryAggregateInterface;
use WideFocus\Feed\Source\Condition\SourceConditionCombination;
use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Feed\Source\ConditionCombinationFactory;
use WideFocus\Parameters\ParameterBagInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\ConditionCombinationFactory
 */
class ConditionCombinationFactoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @return void
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(
            ConditionCombinationFactory::class,
            new ConditionCombinationFactory(
                $this->createMock(SourceConditionFactoryAggregateInterface::class)
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

        $feedConditions = [
            $this->createMock(FeedConditionInterface::class),
            $this->createMock(FeedConditionInterface::class)
        ];

        $conditions = [
            $this->createMock(SourceConditionInterface::class),
            $this->createMock(SourceConditionInterface::class)
        ];

        $feed = $this->createConfiguredMock(
            FeedInterface::class,
            [
                'getConditions' => $feedConditions,
                'getSourceParameters' => $sourceParameters
            ]
        );

        $conditionFactory = $this->createMock(
            SourceConditionFactoryAggregateInterface::class
        );

        foreach ($feedConditions as $key => $feedCondition) {
            $conditionFactory
                ->expects($this->at($key))
                ->method('create')
                ->with($feedCondition, $sourceParameters)
                ->willReturn($conditions[$key]);
        }

        $factory = new ConditionCombinationFactory($conditionFactory);
        $this->assertInstanceOf(
            SourceConditionCombination::class,
            $factory->create($feed)
        );
    }
}
