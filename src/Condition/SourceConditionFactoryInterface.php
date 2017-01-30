<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Condition;

use WideFocus\Parameters\ParameterBagInterface;

/**
 * Creates source conditions.
 */
interface SourceConditionFactoryInterface
{
    /**
     * Create a source condition.
     *
     * @param ParameterBagInterface $parameters
     *
     * @return SourceConditionInterface
     */
    public function createCondition(
        ParameterBagInterface $parameters
    ): SourceConditionInterface;
}
