<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Iterator;

use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Feed\Source\Iterator\IdentityIteratorInterface;
use WideFocus\Feed\Source\Iterator\ValidatedIdentityIterator;
use WideFocus\Feed\Source\Tests\Iterator\TestDouble\IdentityIteratorDouble;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Iterator\ValidatedIdentityIterator
 */
class ValidatedIdentityIteratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return ValidatedIdentityIterator
     *
     * @covers ::__construct
     * @covers ::createPreparingIterator
     * @covers ::createValidatingIterator
     */
    public function testConstructor(): ValidatedIdentityIterator
    {
        return new ValidatedIdentityIterator(
            $this->createMock(IdentityIteratorInterface::class),
            $this->createMock(SourceConditionInterface::class),
            10
        );
    }

    /**
     * @param array $entityIds
     * @param array $expectedResult
     *
     * @return void
     *
     * @dataProvider dataProvider
     *
     * @covers ::createPreparingIterator
     * @covers ::createValidatingIterator
     * @covers ::current
     */
    public function testIteration(array $entityIds, array $expectedResult)
    {
        $identityIterator = new IdentityIteratorDouble($entityIds);

        $conditions = $this->createMock(SourceConditionInterface::class);
        $conditions->expects($this->exactly((int) ceil(count($entityIds) / 5)))
            ->method('prepare');

        $conditions->expects($this->exactly(count($entityIds)))
            ->method('matches')
            ->willReturnCallback(
                function (int $value) : bool {
                    return $value % 2 == 0;
                }
            );

        $iterator = new ValidatedIdentityIterator($identityIterator, $conditions, 5);

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
        $expectedResult = array_filter(
            $entityIds,
            function (int $value) : bool {
                return $value % 2 == 0;
            }
        );
        
        return [
            [
                $entityIds,
                $expectedResult
            ]
        ];
    }

}
