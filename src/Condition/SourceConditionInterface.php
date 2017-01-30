<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
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

    /**
     * Set the attribute code.
     *
     * @param string $attributeCode
     *
     * @return void
     */
    public function setAttributeCode(string $attributeCode);

    /**
     * Set the operator.
     *
     * @param string $operator
     *
     * @return void
     */
    public function setOperator(string $operator);

    /**
     * Set the value.
     *
     * @param mixed $value
     *
     * @return void
     */
    public function setValue($value);
}
