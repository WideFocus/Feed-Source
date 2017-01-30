<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Condition\TestDouble;

use WideFocus\Feed\Source\Condition\SourceConditionCombinationInterface;
use WideFocus\Feed\Source\Condition\SourceConditionCombinationTrait;
use WideFocus\Feed\Source\Condition\SourceConditionTrait;

class SourceConditionCombinationDouble implements SourceConditionCombinationInterface
{
    use SourceConditionTrait;
    use SourceConditionCombinationTrait;

    /**
     * Check whether an entity matches the condition.
     *
     * @param string $entityId
     *
     * @return bool
     */
    public function matches(string $entityId): bool
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
