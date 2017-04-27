<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Iterator;

use ArrayIterator;
use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Source\Iterator\MapCallbackIterator;
use WideFocus\Feed\Source\Tests\TestDouble\InvokableDouble;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Iterator\MapCallbackIterator
 */
class MapCallbackIteratorTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(
            MapCallbackIterator::class,
            new MapCallbackIterator(
                new ArrayIterator(),
                function () {
                }
            )
        );
    }

    /**
     * @param array $input
     * @param array $output
     *
     * @return void
     *
     * @dataProvider dataProvider
     *
     * @covers ::current
     */
    public function testIteration(array $input, array $output)
    {
        $mapping = array_combine($input, $output);

        $callback = $this->createMock(InvokableDouble::class);
        $callback->expects($this->exactly(count($input)))
            ->method('__invoke')
            ->willReturnCallback(
                function ($value) use ($mapping) {
                    return $mapping[$value];
                }
            );

        $iterator = new MapCallbackIterator(
            new ArrayIterator($input),
            $callback
        );

        $result = [];
        foreach ($iterator as $key => $value) {
            $result[$key] = $value;
        }
        $this->assertEquals($output, $result);
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                range(1000, 1025),
                array_map(
                    function (int $value) : array {
                        return ['id' => $value];
                    },
                    range(1000, 1025)
                )
            ]
        ];
    }
}
