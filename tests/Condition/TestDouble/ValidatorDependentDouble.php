<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Condition\TestDouble;

use WideFocus\Feed\Source\Condition\Validator\ValidatorManagerInterface;
use WideFocus\Feed\Source\Condition\ValidatorDependentTrait;

class ValidatorDependentDouble
{
    use ValidatorDependentTrait;

    /**
     * Constructor.
     *
     * @param ValidatorManagerInterface $validators
     */
    public function __construct(ValidatorManagerInterface $validators)
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
     * @return ValidatorManagerInterface
     */
    public function peekValidators(): ValidatorManagerInterface
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
