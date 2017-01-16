<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Iterator;

use ArrayIterator;
use PHPUnit_Framework_MockObject_MockObject;
use WideFocus\Feed\Source\Iterator\MapCallbackIterator;
use WideFocus\Feed\Source\Tests\Iterator\TestDouble\InvokableDouble;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Iterator\MapCallbackIterator
 */
class MapCallbackIteratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return MapCallbackIterator
     *
     * @covers ::__construct
     */
    public function testConstruct(): MapCallbackIterator
    {
        return new MapCallbackIterator(
            new ArrayIterator(),
            function () {}
        );
    }

    /**
     * @param array $input
     * @param array $output
     *
     * @dataProvider dataProvider
     *
     * @covers ::current
     */
    public function testIteration(array $input, array $output)
    {
        $mapping  = array_combine($input, $output);

        /** @var InvokableDouble|PHPUnit_Framework_MockObject_MockObject $callback */
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
                    function (int $value): array {
                        return ['id' => $value];
                    },
                    range(1000, 1025)
                )
            ]
        ];
    }
}
