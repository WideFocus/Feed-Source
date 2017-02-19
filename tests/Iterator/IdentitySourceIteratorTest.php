<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Iterator;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\IdentitySourceInterface;
use WideFocus\Feed\Source\Iterator\IdentitySourceIterator;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Iterator\IdentitySourceIterator
 */
class IdentitySourceIteratorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return IdentitySourceIterator
     */
    public function testConstruct(): IdentitySourceIterator
    {
        return new IdentitySourceIterator(
            $this->createMock(IdentitySourceInterface::class)
        );
    }

    /**
     * @param array $entityIds
     *
     * @dataProvider dataProvider
     *
     * @covers ::current
     */
    public function testIteration(array $entityIds)
    {
        $identitySource = $this->createMock(IdentitySourceInterface::class);
        $identitySource->expects($this->once())
            ->method('getEntityIds')
            ->willReturn($entityIds);

        $iterator = new IdentitySourceIterator($identitySource);

        $result = [];
        foreach ($iterator as $key => $value) {
            $result[$key] = $value;
        }
        $this->assertEquals($entityIds, $result);
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                range(1000, 1025)
            ]
        ];
    }
}
