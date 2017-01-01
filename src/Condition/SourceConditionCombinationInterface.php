<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Condition;

/**
 * Contains a combination of conditions.
 */
interface SourceConditionCombinationInterface extends SourceConditionInterface
{
    /**
     * Get the conditions.
     *
     * @return SourceConditionInterface[]
     */
    public function getConditions(): array;

    /**
     * Set the conditions.
     *
     * @param SourceConditionInterface[] $conditions
     *
     * @return SourceConditionCombinationInterface
     */
    public function setConditions(array $conditions): SourceConditionCombinationInterface;
}
