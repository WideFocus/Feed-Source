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
    const OPERATOR_AND = 'and';
    const OPERATOR_OR  = 'or';

    /**
     * Add a condition.
     *
     * @param SourceConditionInterface $condition
     *
     * @return void
     */
    public function addCondition(SourceConditionInterface $condition);
}
