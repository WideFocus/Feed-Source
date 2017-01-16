<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Iterator;

use PHPUnit_Framework_MockObject_MockObject;
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

        /** @var IdentitySourceInterface|PHPUnit_Framework_MockObject_MockObject $source */
        $source = $this->createMock(IdentitySourceInterface::class);

        /** @var SourceConditionCombinationInterface|PHPUnit_Framework_MockObject_MockObject $conditions */
        $conditions = $this->createMock(SourceConditionCombinationInterface::class);

        /** @var SourceFieldCombinationInterface|PHPUnit_Framework_MockObject_MockObject $fields */
        $fields = $this->createMock(SourceFieldCombinationInterface::class);

        return $factory->createIterator($source, $conditions, $fields);
    }
}
