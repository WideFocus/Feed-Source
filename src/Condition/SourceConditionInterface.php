<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Condition;

/**
 * Validates a feed item.
 */
interface SourceConditionInterface
{
    /**
     * Check whether an entity matches the condition.
     *
     * @param string $entityId
     *
     * @return bool
     */
    public function matches(string $entityId): bool;

    /**
     * Prepare for a set of entities.
     *
     * @param string[] $entityIds
     *
     * @return void
     */
    public function prepare(array $entityIds);
}
