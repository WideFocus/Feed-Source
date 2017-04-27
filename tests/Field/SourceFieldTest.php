<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Field;

use PHPUnit\Framework\TestCase;
use WideFocus\Feed\Source\Field\SourceField;
use WideFocus\Feed\Source\ValueListInterface;
use WideFocus\Feed\Source\ValueSourceInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Field\SourceField
 */
class SourceFieldTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::__construct
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(
            SourceField::class,
            new SourceField(
                $this->createMock(ValueSourceInterface::class),
                'foo'
            )
        );
    }

    /**
     * @return void
     *
     * @covers ::getValue
     */
    public function testGetValue()
    {
        $valueList = $this->createMock(ValueListInterface::class);
        $valueList
            ->expects($this->once())
            ->method('get')
            ->with(42)
            ->willReturn('The answer');

        $field = new SourceField(
            $this->createMock(ValueSourceInterface::class),
            'foo',
            $valueList
        );
        $this->assertEquals('The answer', $field->getValue(42));
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

        $field = new SourceField(
            $valueSource,
            'foo',
            $valueList
        );
        $field->prepare(array_keys($values));
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
