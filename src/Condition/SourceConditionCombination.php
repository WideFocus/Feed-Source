<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Condition;

use ArrayAccess;
use WideFocus\Validator\ValidatorContainerInterface;

/**
 * Contains a combination of conditions.
 */
class SourceConditionCombination extends AbstractSourceCondition implements SourceConditionCombinationInterface
{
    /**
     * @var SourceConditionInterface[]
     */
    private $conditions;

    /**
     * @var ValidatorContainerInterface
     */
    private $validators;

    /**
     * Constructor.
     *
     * @param ValidatorContainerInterface $validators
     */
    public function __construct(ValidatorContainerInterface $validators)
    {
        $this->validators = $validators;
    }

    /**
     * Check whether an item matches the condition.
     *
     * @param ArrayAccess $item
     *
     * @return bool
     */
    public function isValid(ArrayAccess $item): bool
    {
        $closures[] = array_map(
            function (SourceConditionInterface $condition) use ($item): callable {
                return function () use ($condition, $item) {
                    return $condition->isValid($item);
                };
            },
            $this->getConditions()
        );

        return call_user_func($this->getOperatorValidator($item), $closures);
    }

    /**
     * Prepare for a set of entities.
     *
     * @param string[] $entityIds
     *
     * @return SourceConditionInterface
     */
    public function prepare(array $entityIds): SourceConditionInterface
    {
        array_walk(
            $this->conditions,
            function (SourceConditionInterface $condition) use ($entityIds) {
                $condition->prepare($entityIds);
            }
        );

        return $this;
    }

    /**
     * Set the conditions.
     *
     * @param SourceConditionInterface[] $conditions
     *
     * @return SourceConditionCombinationInterface
     */
    public function setConditions(array $conditions): SourceConditionCombinationInterface
    {
        $this->conditions = $conditions;
        return $this;
    }

    /**
     * Get the conditions.
     *
     * @return SourceConditionInterface[]
     */
    protected function getConditions(): array
    {
        return $this->conditions;
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
     * @param ArrayAccess $item
     *
     * @return callable
     */
    protected function getOperatorValidator(ArrayAccess $item): callable
    {
        return $this->getValidators()
            ->getValidator($this->getOperator(), $item);
    }
}
