<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Iterator;

use ArrayAccess;
use ArrayObject;
use PHPUnit_Framework_MockObject_MockObject;
use WideFocus\Feed\Source\Field\SourceFieldCombinationInterface;
use WideFocus\Feed\Source\Iterator\IdentityIteratorInterface;
use WideFocus\Feed\Source\Iterator\IdentityToItemIterator;
use WideFocus\Feed\Source\Tests\Iterator\TestDouble\IdentityIteratorDouble;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Iterator\IdentityToItemIterator
 */
class IdentityToItemIteratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return IdentityToItemIterator
     *
     * @covers ::__construct
     * @covers ::createPreparingIterator
     * @covers ::createMappingIterator
     */
    public function testConstructor(): IdentityToItemIterator
    {
        /** @var IdentityIteratorInterface|PHPUnit_Framework_MockObject_MockObject $identityIterator */
        $identityIterator = $this->createMock(IdentityIteratorInterface::class);

        /** @var SourceFieldCombinationInterface|PHPUnit_Framework_MockObject_MockObject $fields */
        $fields = $this->createMock(SourceFieldCombinationInterface::class);

        return new IdentityToItemIterator($identityIterator, $fields, 10);
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

        /** @var SourceFieldCombinationInterface|PHPUnit_Framework_MockObject_MockObject $fields */
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
                return new ArrayObject($values);
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
