<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Iterator;

use ArrayIterator;
use Iterator;
use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Source\Iterator\ChunkCallbackIterator;
use WideFocus\Feed\Source\Tests\Iterator\TestDouble\InvokableDouble;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Iterator\ChunkCallbackIterator
 */
class ChunkCallbackIteratorTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(
            ChunkCallbackIterator::class,
            new ChunkCallbackIterator(
                $this->createMock(Iterator::class),
                function () {
                },
                10
            )
        );
    }

    /**
     * @param array $input
     * @param int   $chunkSize
     * @param array $expectedCalls
     *
     * @return void
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
