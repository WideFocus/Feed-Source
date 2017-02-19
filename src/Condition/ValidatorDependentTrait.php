<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Condition;

use WideFocus\Feed\Source\Condition\Validator\ValidatorManagerInterface;

trait ValidatorDependentTrait
{
    /**
     * @var ValidatorManagerInterface
     */
    private $validators;

    /**
     * Set the validators container.
     *
     * @param ValidatorManagerInterface $validators
     *
     * @return void
     */
    protected function setValidators(ValidatorManagerInterface $validators)
    {
        $this->validators = $validators;
    }

    /**
     * Get the validators container.
     *
     * @return ValidatorManagerInterface
     */
    protected function getValidators(): ValidatorManagerInterface
    {
        return $this->validators;
    }

    /**
     * Get the validator for the operator.
     *
     * @return callable
     */
    protected function getOperatorValidator(): callable
    {
        return $this->getValidators()
            ->getValidator($this->getOperator());
    }

    /**
     * Get the operator.
     *
     * @return string
     */
    abstract protected function getOperator(): string;
}