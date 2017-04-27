<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Iterator;

use ArrayAccess;
use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Source\Field\SourceFieldCombinationInterface;
use WideFocus\Feed\Source\Iterator\IdentityIteratorInterface;
use WideFocus\Feed\Source\Iterator\IdentityToItemIterator;
use WideFocus\Feed\Source\Tests\Iterator\TestDouble\IdentityIteratorDouble;
use WideFocus\Feed\Source\SourceItem;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Iterator\IdentityToItemIterator
 */
class IdentityToItemIteratorTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::__construct
     * @covers ::createPreparingIterator
     * @covers ::createMappingIterator
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(
            IdentityToItemIterator::class,
            new IdentityToItemIterator(
                $this->createMock(IdentityIteratorInterface::class),
                $this->createMock(SourceFieldCombinationInterface::class),
                10
            )
        );
    }

    /**
     * @param array $entityIds
     * @param array $fieldValues
     * @param array $expectedResult
     *
     * @return void
     *
     * @dataProvider dataProvider
     *
     * @covers ::createPreparingIterator
     * @covers ::createMappingIterator
     * @covers ::current
     */
    public function testIteration(array $entityIds, array $fieldValues, array $expectedResult)
    {
        $identityIterator = new IdentityIteratorDouble($entityIds);

        $fields = $this->createMock(SourceFieldCombinationInterface::class);
        $fields->expects($this->exactly((int) ceil(count($entityIds) / 5)))
            ->method('prepare');

        $fields->expects($this->exactly(count($entityIds)))
            ->method('getValue')
            ->willReturnOnConsecutiveCalls(...$fieldValues);

        $iterator = new IdentityToItemIterator($identityIterator, $fields, 5);

        $result = [];
        foreach ($iterator as $key => $value) {
            $result[$key] = $value;
        }
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        $entityIds = range(1000, 1025);

        $fieldValues = array_map(
            function (string $entityId) : array {
                return [
                    'id' => $entityId,
                    'some_key' => 'some_value'
                ];
            },
            $entityIds
        );

        $expectedResult = array_map(
            function (array $values) : ArrayAccess {
                return new SourceItem($values);
            },
            $fieldValues
        );


        return [
            [
                $entityIds,
                $fieldValues,
                $expectedResult
            ]
        ];
    }
}
