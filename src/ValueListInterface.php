<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source;

/**
 * Contains attributes values for a set of entities.
 */
interface ValueListInterface
{
    /**
     * Set the value for an entity.
     *
     * @param string $entityId
     * @param mixed  $value
     *
     * @return ValueListInterface
     */
    public function setEntityValue(string $entityId, $value): ValueListInterface;

    /**
     * Get the value for an entity.
     *
     * @param string $entityId
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getEntityValue(string $entityId, $default = null);

    /**
     * Check if an value is set for an entity.
     *
     * @param string $entityId
     *
     * @return bool
     */
    public function hasEntityValue(string $entityId): bool;

    /**
     * Set values for all entities.
     *
     * @param mixed[] $values
     *
     * @return ValueListInterface
     */
    public function setValues(array $values): ValueListInterface;

    /**
     * Get values for all entities.
     *
     * @return mixed[]
     */
    public function getValues(): array;
}
