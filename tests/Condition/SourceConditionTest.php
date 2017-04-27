<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Condition;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Source\Condition\SourceCondition;
use WideFocus\Feed\Source\Tests\TestDouble\InvokableDouble;
use WideFocus\Feed\Source\ValueListInterface;
use WideFocus\Feed\Source\ValueSourceInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Condition\SourceCondition
 */
class SourceConditionTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        $validator = function () : bool {
            return true;
        };

        $this->assertInstanceOf(
            SourceCondition::class,
            new SourceCondition(
                $this->createMock(ValueSourceInterface::class),
                $validator,
                'foo'
            )
        );
    }

    /**
     * @param bool $result
     *
     * @return void
     *
     * @dataProvider booleanProvider
     *
     * @covers ::matches
     */
    public function testMatches(bool $result)
    {
        $valueList = $this->createMock(ValueListInterface::class);
        $valueList
            ->expects($this->once())
            ->method('get')
            ->with(42)
            ->willReturn('The answer');

        $validator = $this->createMock(InvokableDouble::class);
        $validator
            ->expects($this->once())
            ->method('__invoke')
            ->with('The answer')
            ->willReturn($result);

        $condition = new SourceCondition(
            $this->createMock(ValueSourceInterface::class),
            $validator,
            'foo',
            $valueList
        );

        $this->assertEquals($result, $condition->matches(42));
    }



    /**
     * @return array
     */
    public function booleanProvider(): array
    {
        return [
            [true],
            [false]
        ];
    }

    /**
     * @param array $values
     *
     * @return void
     *
     * @dataProvider valuesProvider
     *
     * @covers ::prepare
     */
    public function testPrepare(array $values)
    {
        $resultList = $this->createMock(ValueListInterface::class);
        $resultList
            ->expects($this->once())
            ->method('all')
            ->willReturn($values);

        $valueList = $this->createMock(ValueListInterface::class);
        $valueList
            ->expects($this->once())
            ->method('load')
            ->with($values);

        $valueSource = $this->createMock(ValueSourceInterface::class);
        $valueSource
            ->expects($this->once())
            ->method('getEntityValues')
            ->with(array_keys($values), 'foo')
            ->willReturn($resultList);

        $condition = new SourceCondition(
            $valueSource,
            $this->createMock(InvokableDouble::class),
            'foo',
            $valueList
        );
        $condition->prepare(array_keys($values));
    }

    /**
     * @return array
     */
    public function valuesProvider(): array
    {
        return [
            [
                ['41' => 'No answer', '42' => 'The answer']
            ]
        ];
    }
}
