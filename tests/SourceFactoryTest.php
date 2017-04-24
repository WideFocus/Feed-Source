<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests;

use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Feed\Source\ConditionCombinationFactoryInterface;
use WideFocus\Feed\Source\Field\SourceFieldCombinationInterface;
use WideFocus\Feed\Source\FieldCombinationFactoryInterface;
use WideFocus\Feed\Source\IdentitySource\FactoryAggregate\IdentitySourceFactoryAggregateInterface;
use WideFocus\Feed\Source\IdentitySource\IdentitySourceInterface;
use WideFocus\Feed\Source\Iterator\SourceIteratorFactoryInterface;
use WideFocus\Feed\Source\Iterator\SourceIteratorInterface;
use WideFocus\Feed\Source\SourceFactory;
use WideFocus\Parameters\ParameterBagInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\SourceFactory
 */
class SourceFactoryTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @return void
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(
            SourceFactory::class,
            new SourceFactory(
                $this->createMock(SourceIteratorFactoryInterface::class),
                $this->createMock(IdentitySourceFactoryAggregateInterface::class),
                $this->createMock(ConditionCombinationFactoryInterface::class),
                $this->createMock(FieldCombinationFactoryInterface::class)
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

        $feed = $this->createConfiguredMock(
            FeedInterface::class,
            [
                'getSourceType' => 'foo',
                'getSourceParameters' => $sourceParameters
            ]
        );

        $source          = $this->createMock(IdentitySourceInterface::class);
        $idSourceFactory = $this->createMock(IdentitySourceFactoryAggregateInterface::class);
        $idSourceFactory
            ->expects($this->once())
            ->method('create')
            ->with('foo', $sourceParameters)
            ->willReturn($source);

        $condition        = $this->createMock(SourceConditionInterface::class);
        $conditionFactory = $this->createMock(ConditionCombinationFactoryInterface::class);
        $conditionFactory
            ->expects($this->once())
            ->method('create')
            ->with($feed)
            ->willReturn($condition);

        $field        = $this->createMock(SourceFieldCombinationInterface::class);
        $fieldFactory = $this->createMock(FieldCombinationFactoryInterface::class);
        $fieldFactory
            ->expects($this->once())
            ->method('create')
            ->with($feed)
            ->willReturn($field);

        $iterator        = $this->createMock(SourceIteratorInterface::class);
        $iteratorFactory = $this->createMock(SourceIteratorFactoryInterface::class);
        $iteratorFactory
            ->expects($this->once())
            ->method('create')
            ->with($source, $condition, $field)
            ->willReturn($iterator);

        $factory = new SourceFactory(
            $iteratorFactory,
            $idSourceFactory,
            $conditionFactory,
            $fieldFactory
        );

        $this->assertSame($iterator, $factory->create($feed));
    }
}
