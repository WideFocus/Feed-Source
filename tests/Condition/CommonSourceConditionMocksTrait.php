<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Condition;

use ArrayAccess;
use PHPUnit_Framework_MockObject_MockObject;
use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Feed\Source\Condition\Validator\ValidatorContainerInterface;
use WideFocus\Validator\ContextAwareValidatorInterface;
use WideFocus\Validator\ValidatorInterface;

trait CommonSourceConditionMocksTrait
{
    /**
     * @return ArrayAccess|PHPUnit_Framework_MockObject_MockObject
     */
    protected function createArrayAccessMock(): ArrayAccess
    {
        return $this->createMock(ArrayAccess::class);
    }

    /**
     * @return SourceConditionInterface|PHPUnit_Framework_MockObject_MockObject
     */
    protected function createConditionMock(): SourceConditionInterface
    {
        return $this->createMock(SourceConditionInterface::class);
    }

    /**
     * @return ValidatorContainerInterface|PHPUnit_Framework_MockObject_MockObject
     */
    protected function createValidatorContainerMock(): ValidatorContainerInterface
    {
        return $this->createMock(ValidatorContainerInterface::class);
    }

    /**
     * @return ValidatorInterface|PHPUnit_Framework_MockObject_MockObject
     */
    protected function createValidatorMock(): ValidatorInterface
    {
        return $this->createMock(ValidatorInterface::class);
    }

    /**
     * @return ContextAwareValidatorInterface|PHPUnit_Framework_MockObject_MockObject
     */
    protected function createContextAwareValidatorMock(): ContextAwareValidatorInterface
    {
        return $this->createMock(ContextAwareValidatorInterface::class);
    }

    /**
     * @param string $originalClassName
     *
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    abstract protected function createMock($originalClassName);  // @codingStandardsIgnoreLine
}