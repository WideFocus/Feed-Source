<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\IdentitySource\FactoryAggregate;


use WideFocus\Feed\Source\IdentitySource\FactoryAggregate\InvalidIdentitySourceException;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\IdentitySource\FactoryAggregate\InvalidIdentitySourceException
 */
class InvalidIdentitySourceExceptionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\IdentitySource\FactoryAggregate\InvalidIdentitySourceException
     * @expectedExceptionMessage An identity source with name foo has not been registered
     *
     * @throws InvalidIdentitySourceException Always.
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        throw new InvalidIdentitySourceException('foo');
    }
}
