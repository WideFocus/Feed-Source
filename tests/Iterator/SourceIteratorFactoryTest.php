<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Iterator;

use WideFocus\Feed\Source\Condition\SourceConditionCombinationInterface;
use WideFocus\Feed\Source\Field\SourceFieldCombinationInterface;
use WideFocus\Feed\Source\IdentitySourceInterface;
use WideFocus\Feed\Source\Iterator\SourceIteratorFactory;
use WideFocus\Feed\Source\Iterator\SourceIteratorInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Iterator\SourceIteratorFactory
 */
class SourceIteratorFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return SourceIteratorFactory
     *
     * @covers ::__construct
     */
    public function testConstruct(): SourceIteratorFactory
    {
        return new SourceIteratorFactory(5);
    }

    /**
     * @return SourceIteratorInterface
     *
     * @covers ::createIterator
     */
    public function testCreateIterator(): SourceIteratorInterface
    {
        $factory = new SourceIteratorFactory(5);
        return $factory->createIterator(
            $this->createMock(IdentitySourceInterface::class),
            $this->createMock(SourceConditionCombinationInterface::class),
            $this->createMock(SourceFieldCombinationInterface::class)
        );
    }
}
