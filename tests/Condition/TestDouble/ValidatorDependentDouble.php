<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Condition\TestDouble;

use ArrayAccess;
use WideFocus\Feed\Source\Condition\Validator\ValidatorContainerInterface;
use WideFocus\Feed\Source\Condition\ValidatorDependentTrait;

class ValidatorDependentDouble
{
    use ValidatorDependentTrait;

    /**
     * Constructor.
     *
     * @param ValidatorContainerInterface $validators
     */
    public function __construct(ValidatorContainerInterface $validators)
    {
        $this->setValidators($validators);
    }

    /**
     * Get the operator.
     *
     * @return string
     */
    protected function getOperator(): string
    {
        return 'the_operator';
    }

    /**
     * @return ValidatorContainerInterface
     */
    public function peekValidators(): ValidatorContainerInterface
    {
        return $this->getValidators();
    }

    /**
     * @return callable
     */
    public function peekOperatorValidator(): callable
    {
        return $this->getOperatorValidator();
    }
}
