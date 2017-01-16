<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Iterator;

use ArrayIterator;
use Iterator;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Iterator\ChunkCallbackIterator;
use WideFocus\Feed\Source\Tests\Iterator\TestDouble\InvokableDouble;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Iterator\ChunkCallbackIterator
 */
class ChunkCallbackIteratorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return ChunkCallbackIterator
     *
     * @covers ::__construct
     */
    public function testConstruct(): ChunkCallbackIterator
    {
        /** @var Iterator|PHPUnit_Framework_MockObject_MockObject $iterator */
        $iterator = $this->createMock(Iterator::class);

        return new ChunkCallbackIterator(
            $iterator,
            function () {},
            10
        );
    }

    /**
     * @param array $input
     * @param int   $chunkSize
     * @param array $expectedCalls
     *
     * @dataProvider dataProvider
     *
     * @covers ::rewind
     * @covers ::next
     * @covers ::valid
     * @covers ::current
     * @covers ::key
     * @covers ::loadChunk
     */
    public function testIteration(array $input, int $chunkSize, array $expectedCalls)
    {
        /** @var callable|PHPUnit_Framework_MockObject_MockObject $callback */
        $callback = $this->createMock(InvokableDouble::class);
        $callback->expects($this->exactly(count($expectedCalls)))
            ->method('__invoke')
            ->withConsecutive(...$expectedCalls);

        $iterator = new ChunkCallbackIterator(
            new ArrayIterator($input),
            $callback,
            $chunkSize
        );

        $result = [];
        foreach ($iterator as $key => $value) {
            $result[$key] = $value;
        }
        $this->assertEquals($input, $result);
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                range(1000, 1025),
                5,
                array_map(
                    function ($value) {
                        return [$value];
                    },
                    array_chunk(range(1000, 1025), 5, true)
                )
            ],
            [
                [],
                5,
                []
            ]
        ];
    }
}
