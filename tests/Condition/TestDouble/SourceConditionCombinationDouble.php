<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Condition\TestDouble;

use ArrayAccess;
use WideFocus\Feed\Source\Condition\SourceConditionCombinationInterface;
use WideFocus\Feed\Source\Condition\SourceConditionCombinationTrait;
use WideFocus\Feed\Source\Condition\SourceConditionTrait;

class SourceConditionCombinationDouble implements SourceConditionCombinationInterface
{
    use SourceConditionTrait;
    use SourceConditionCombinationTrait;

    /**
     * Check whether an item matches the condition.
     *
     * @param ArrayAccess $item
     *
     * @return bool
     */
    public function isValid(ArrayAccess $item): bool
    {
        return true;
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
    }

    /**
     * @return array
     */
    public function peekConditions(): array
    {
        return $this->getConditions();
    }
}
