<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
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
     * @return void
     */
    public function setEntityValue(string $entityId, $value);

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
     * @return void
     */
    public function setValues(array $values);

    /**
     * Get values for all entities.
     *
     * @return mixed[]
     */
    public function getValues(): array;
}
