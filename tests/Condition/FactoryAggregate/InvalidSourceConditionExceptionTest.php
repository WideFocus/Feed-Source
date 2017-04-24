<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Condition\FactoryAggregate;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Source\Condition\FactoryAggregate\InvalidSourceConditionException;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Condition\FactoryAggregate\InvalidSourceConditionException
 */
class InvalidSourceConditionExceptionTest extends TestCase
{
    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Condition\FactoryAggregate\InvalidSourceConditionException
     * @expectedExceptionMessage A source condition with name foo has not been registered
     *
     * @throws InvalidSourceConditionException Always.
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        throw new InvalidSourceConditionException('foo');
    }
}
