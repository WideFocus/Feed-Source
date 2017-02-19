<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Condition;

/**
 * Trait to implement SourceConditionCombinationInterface.
 */
trait SourceConditionCombinationTrait
{
    /**
     * @var SourceConditionInterface[]
     */
    private $conditions = [];

    /**
     * Add a condition.
     *
     * @param SourceConditionInterface $condition
     *
     * @return void
     */
    public function addCondition(SourceConditionInterface $condition)
    {
        $this->conditions[] = $condition;
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
}
