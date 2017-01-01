<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Condition;

use ArrayAccess;

/**
 * Validates a feed item.
 */
interface SourceConditionInterface
{
    /**
     * Check whether an item matches the condition.
     *
     * @param ArrayAccess $item
     *
     * @return bool
     */
    public function isValid(ArrayAccess $item): bool;

    /**
     * Prepare for a set of entities.
     *
     * @param string[] $entityIds
     *
     * @return SourceConditionInterface
     */
    public function prepare(array $entityIds): SourceConditionInterface;

    /**
     * Set the attribute code.
     *
     * @param string $attributeCode
     *
     * @return SourceConditionInterface
     */
    public function setAttributeCode(string $attributeCode): SourceConditionInterface;

    /**
     * Set the operator.
     *
     * @param string $operator
     *
     * @return SourceConditionInterface
     */
    public function setOperator(string $operator): SourceConditionInterface;

    /**
     * Set the value.
     *
     * @param mixed $value
     *
     * @return SourceConditionInterface
     */
    public function setValue($value): SourceConditionInterface;
}
