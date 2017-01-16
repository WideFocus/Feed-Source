<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Condition;

use WideFocus\Feed\Source\Condition\Validator\ValidatorContainerInterface;

trait ValidatorDependentTrait
{
    /**
     * @var ValidatorContainerInterface
     */
    private $validators;

    /**
     * Set the validators container.
     *
     * @param ValidatorContainerInterface $validators
     *
     * @return void
     */
    protected function setValidators(ValidatorContainerInterface $validators)
    {
        $this->validators = $validators;
    }

    /**
     * Get the validators container.
     *
     * @return ValidatorContainerInterface
     */
    protected function getValidators(): ValidatorContainerInterface
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