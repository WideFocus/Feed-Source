<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Condition;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Condition\Validator\ValidatorContainerInterface;
use WideFocus\Feed\Source\Tests\Condition\TestDouble\ValidatorDependentDouble;
use WideFocus\Validator\ValidatorInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Condition\ValidatorDependentTrait
 */
class ValidatorDependentTraitTest extends PHPUnit_Framework_TestCase
{
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
        $validator  = $this->createMock(ValidatorInterface::class);

        $validators = $this->createMock(ValidatorContainerInterface::class);
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
                $this->createMock(ValidatorContainerInterface::class)
            ]
        ];
    }
}
