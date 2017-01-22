<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Condition;

use WideFocus\Feed\Source\Condition\Validator\ValidatorManagerInterface;

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
     * @param ValidatorManagerInterface $validators
     */
    public function __construct(ValidatorManagerInterface $validators)
    {
        $this->setValidators($validators);
    }

    /**
     * Check whether an entity matches the condition.
     *
     * @param string $entityId
     *
     * @return bool
     */
    public function isValid(string $entityId): bool
    {
        $closures = array_map(
            function (SourceConditionInterface $condition) use ($entityId) : callable {
                return function () use ($condition, $entityId) {
                    return $condition->isValid($entityId);
                };
            },
            $this->getConditions()
        );

        return call_user_func($this->getOperatorValidator(), $closures);
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
