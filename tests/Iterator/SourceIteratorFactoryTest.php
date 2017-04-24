<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Iterator;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Feed\Source\Field\SourceFieldCombinationInterface;
use WideFocus\Feed\Source\IdentitySource\IdentitySourceInterface;
use WideFocus\Feed\Source\Iterator\SourceIteratorFactory;
use WideFocus\Feed\Source\Iterator\SourceIteratorInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Iterator\SourceIteratorFactory
 */
class SourceIteratorFactoryTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(
            SourceIteratorFactory::class,
            new SourceIteratorFactory(5)
        );
    }

    /**
     * @return void
     *
     * @covers ::create
     */
    public function testCreate()
    {
        $factory = new SourceIteratorFactory(5);

        $this->assertInstanceOf(
            SourceIteratorInterface::class,
            $factory->create(
                $this->createMock(IdentitySourceInterface::class),
                $this->createMock(SourceConditionInterface::class),
                $this->createMock(SourceFieldCombinationInterface::class)
            )
        );
    }
}
