<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\IdentitySource\FactoryAggregate;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Source\IdentitySource\FactoryAggregate\IdentitySourceFactoryAggregate;
use WideFocus\Feed\Source\IdentitySource\IdentitySourceFactoryInterface;
use WideFocus\Feed\Source\IdentitySource\IdentitySourceInterface;
use WideFocus\Parameters\ParameterBagInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\IdentitySource\FactoryAggregate\IdentitySourceFactoryAggregate
 */
class IdentitySourceFactoryAggregateTest extends TestCase
{
    /**
     * @return IdentitySourceInterface
     *
     * @covers ::create
     * @covers ::addFactory
     */
    public function testCreateSource(): IdentitySourceInterface
    {
        $source     = $this->createMock(IdentitySourceInterface::class);
        $parameters = $this->createMock(ParameterBagInterface::class);

        $factory = $this->createMock(IdentitySourceFactoryInterface::class);
        $factory->expects($this->once())
            ->method('create')
            ->with($parameters)
            ->willReturn($source);

        $factoryAggregate = new IdentitySourceFactoryAggregate();
        $factoryAggregate->addFactory('foo', $factory);

        return $factoryAggregate->create('foo', $parameters);
    }

    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\IdentitySource\FactoryAggregate\InvalidIdentitySourceException
     *
     * @covers ::create
     */
    public function testCreateSourceException()
    {
        $parameters = $this->createMock(ParameterBagInterface::class);

        $factoryAggregate = new IdentitySourceFactoryAggregate();
        $factoryAggregate->create('not_existing', $parameters);
    }
}
