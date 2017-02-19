<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Condition\Validator;

use PHPUnit_Framework_TestCase;
use WideFocus\Feed\Source\Condition\Validator\ValidatorManager;
use WideFocus\Validator\ContextAwareValidatorInterface;
use WideFocus\Validator\ValidatorInterface;

/**
 * @coversDefaultClass \WideFocus\Feed\Source\Condition\Validator\ValidatorManager
 */
class ValidatorManagerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param array $validators
     *
     * @return void
     *
     * @dataProvider validatorsProvider
     *
     * @covers ::addValidator
     * @covers ::getValidator
     */
    public function testGettersSetters(array $validators)
    {
        $container = new ValidatorManager();
        foreach ($validators as $name => $validator) {
            $container->addValidator($validator, $name);
        }

        foreach (array_keys($validators) as $name) {
            $this->assertEquals($validators[$name], $container->getValidator($name));
        }
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
        $container = new ValidatorManager();
        $container->getValidator('invalid');
    }

    /**
     * @return array
     */
    public function validatorsProvider(): array
    {
        return [
            [
                [
                    'foo' => $this->createMock(ValidatorInterface::class),
                    'bar' => $this->createMock(ContextAwareValidatorInterface::class),
                    'baz' => function () {
                    }
                ]
            ]
        ];
    }
}
