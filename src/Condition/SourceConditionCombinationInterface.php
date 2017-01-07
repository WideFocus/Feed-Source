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
     * Set the conditions.
     *
     * @param SourceConditionInterface[] $conditions
     *
     * @return void
     */
    public function setConditions(array $conditions);
}
