<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Condition\Validator;

use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Condition\Validator\ValidatorContainer;
use WideFocus\Feed\Source\Tests\Condition\CommonSourceConditionMocksTrait;
use WideFocus\Validator\ContextAwareValidatorInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Condition\Validator\ValidatorContainer
 */
class ValidatorContainerTest extends PHPUnit_Framework_TestCase
{
    use CommonSourceConditionMocksTrait;

    /**
     * @param array $validators
     *
     * @return void
     *
     * @dataProvider validatorsProvider
     *
     * @covers ::addValidator
     * @covers ::hasValidator
     * @covers ::getValidator
     */
    public function testGettersSetters(array $validators)
    {
        $container = new ValidatorContainer();
        foreach ($validators as $name => $validator) {
            $container->addValidator($validator, $name);
        }

        foreach (array_keys($validators) as $name) {
            $this->assertTrue($container->hasValidator($name));
            $this->assertEquals($validators[$name], $container->getValidator($name));
        }

        $this->assertFalse($container->hasValidator('invalid'));
    }

    /**
     * @return void
     *
     * @expectedException \WideFocus\Feed\Source\Condition\Validator\InvalidValidatorException
     *
     * @covers ::getValidator
     */
    public function testGetValidatorException()
    {
        $container = new ValidatorContainer();
        $container->getValidator('invalid');
    }

    /**
     * @param array $validators
     *
     * @return void
     *
     * @dataProvider validatorsProvider
     *
     * @covers ::getValidatorWithItem
     */
    public function testGetValidatorWithItem(array $validators)
    {
        $container = new ValidatorContainer();
        $item      = $this->createArrayAccessMock();

        foreach ($validators as $name => $validator) {
            $container->addValidator($validator, $name);
            if ($validator instanceof ContextAwareValidatorInterface
                && $validator instanceof PHPUnit_Framework_MockObject_MockObject
            ) {
                $validator->expects($this->once())
                    ->method('setContext')
                    ->with($item);
            }
        }

        foreach (array_keys($validators) as $name) {
            $this->assertEquals(
                $validators[$name],
                $container->getValidatorWithItem($name, $item)
            );
        }
    }

    /**
     * @return array
     */
    public function validatorsProvider(): array
    {
        return [
            [
                [
                    'foo' => $this->createValidatorMock(),
                    'bar' => $this->createContextAwareValidatorMock(),
                    'quu' => function () {
                    }
                ]
            ]
        ];
    }
}
