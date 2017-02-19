<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Condition;

use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * Creates source conditions.
 */
interface SourceConditionFactoryInterface
{
    /**
     * Create a source condition.
     *
     * @param SourceParametersInterface $parameters
     *
     * @return SourceConditionInterface
     */
    public function createCondition(
        SourceParametersInterface $parameters
    ): SourceConditionInterface;
}
