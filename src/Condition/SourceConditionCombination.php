<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Condition;

use ArrayAccess;
use WideFocus\Feed\Source\Condition\Validator\ValidatorContainerInterface;

/**
 * Contains a combination of conditions.
 */
class SourceConditionCombination implements SourceConditionCombinationInterface
{
    use SourceConditionTrait;
    use SourceConditionCombinationTrait;
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
     * Check whether an item matches the condition.
     *
     * @param ArrayAccess $item
     *
     * @return bool
     */
    public function isValid(ArrayAccess $item): bool
    {
        $closures = array_map(
            function (SourceConditionInterface $condition) use ($item) : callable {
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
     * @return void
     */
    public function prepare(array $entityIds)
    {
        $conditions = $this->getConditions();
        array_walk(
            $conditions,
            function (SourceConditionInterface $condition) use ($entityIds) {
                $condition->prepare($entityIds);
            }
        );
    }
}
