<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Condition;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Condition\Validator\ValidatorContainerInterface;
use WideFocus\Feed\Source\Tests\Condition\TestDouble\ValidatorDependentDouble;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Condition\ValidatorDependentTrait
 */
class ValidatorDependentTraitTest extends PHPUnit_Framework_TestCase
{
    use CommonSourceConditionMocksTrait;

    /**
     * @param ValidatorContainerInterface $validators
     *
     * @return void
     *
     * @dataProvider dataProvider
     *
     * @covers ::setValidators
     * @covers ::getValidators
     */
    public function testSetterGetter(ValidatorContainerInterface $validators)
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
        $item       = $this->createArrayAccessMock();
        $validator  = $this->createValidatorMock();
        $validators = $this->createValidatorContainerMock();

        $validators->expects($this->once())
            ->method('getValidatorWithItem')
            ->with('the_operator', $item)
            ->willReturn($validator);

        $condition = new ValidatorDependentDouble($validators);
        $this->assertEquals($validator, $condition->peekOperatorValidator($item));
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                $this->createValidatorContainerMock()
            ]
        ];
    }
}
