<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Condition;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Condition\Validator\ValidatorManagerInterface;
use WideFocus\Feed\Source\Tests\Condition\TestDouble\ValidatorDependentDouble;
use WideFocus\Validator\ValidatorInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Condition\ValidatorDependentTrait
 */
class ValidatorDependentTraitTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param ValidatorManagerInterface $validators
     *
     * @return void
     *
     * @dataProvider dataProvider
     *
     * @covers ::setValidators
     * @covers ::getValidators
     */
    public function testSetterGetter(ValidatorManagerInterface $validators)
    {
        $condition = new ValidatorDependentDouble($validators);
        $this->assertEquals($validators, $condition->peekValidators());
    }

    /**
     * @return void
     *
     * @covers ::getOperatorValidator
     */
    public function testGetOperatorValidator()
    {
        $validator  = $this->createMock(ValidatorInterface::class);

        $validators = $this->createMock(ValidatorManagerInterface::class);
        $validators->expects($this->once())
            ->method('getValidator')
            ->with('the_operator')
            ->willReturn($validator);

        $condition = new ValidatorDependentDouble($validators);
        $this->assertEquals($validator, $condition->peekOperatorValidator());
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                $this->createMock(ValidatorManagerInterface::class)
            ]
        ];
    }
}
