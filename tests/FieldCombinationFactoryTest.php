<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests;

use WideFocus\Feed\Entity\FeedFieldInterface;
use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Source\Field\FactoryAggregate\SourceFieldFactoryAggregateInterface;
use WideFocus\Feed\Source\Field\SourceFieldCombination;
use WideFocus\Feed\Source\Field\SourceFieldInterface;
use WideFocus\Feed\Source\FieldCombinationFactory;
use WideFocus\Parameters\ParameterBagInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\FieldCombinationFactory
 */
class FieldCombinationFactoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @return void
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(
            FieldCombinationFactory::class,
            new FieldCombinationFactory(
                $this->createMock(SourceFieldFactoryAggregateInterface::class)
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

        $feedFields = [
            $this->createMock(FeedFieldInterface::class),
            $this->createMock(FeedFieldInterface::class)
        ];

        $fields = [
            $this->createMock(SourceFieldInterface::class),
            $this->createMock(SourceFieldInterface::class)
        ];

        $feed = $this->createConfiguredMock(
            FeedInterface::class,
            [
                'getFields' => $feedFields,
                'getSourceParameters' => $sourceParameters
            ]
        );

        $fieldFactory = $this->createMock(
            SourceFieldFactoryAggregateInterface::class
        );

        foreach ($feedFields as $key => $feedField) {
            $fieldFactory
                ->expects($this->at($key))
                ->method('create')
                ->with($feedField, $sourceParameters)
                ->willReturn($fields[$key]);
        }

        $factory = new FieldCombinationFactory($fieldFactory);
        $this->assertInstanceOf(
            SourceFieldCombination::class,
            $factory->create($feed)
        );
    }
}
