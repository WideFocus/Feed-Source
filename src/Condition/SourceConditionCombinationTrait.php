<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
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
     * Set the conditions.
     *
     * @param SourceConditionInterface[] $conditions
     *
     * @return void
     */
    public function setConditions(array $conditions)
    {
        $this->conditions = $conditions;
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
