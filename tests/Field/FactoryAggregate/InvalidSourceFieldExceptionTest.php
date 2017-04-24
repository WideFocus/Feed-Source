<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Field\FactoryAggregate;

use WideFocus\Feed\Source\Field\FactoryAggregate\InvalidSourceFieldException;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Field\FactoryAggregate\InvalidSourceFieldException
 */
class InvalidSourceFieldExceptionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Field\FactoryAggregate\InvalidSourceFieldException
     * @expectedExceptionMessage A source field with name foo has not been registered
     *
     * @throws InvalidSourceFieldException Always.
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        throw new InvalidSourceFieldException('foo');
    }
}
