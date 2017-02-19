<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source;

/**
 * Contains a list of values for entities.
 */
class ValueList implements ValueListInterface
{
    /**
     * @var array
     */
    private $values = [];

    /**
     * Set the value for an entity.
     *
     * @param string $entityId
     * @param mixed  $value
     *
     * @return void
     */
    public function setEntityValue(string $entityId, $value)
    {
        $this->values[$entityId] = $value;
    }

    /**
     * Get the value for an entity.
     *
     * @param string $entityId
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getEntityValue(string $entityId, $default = null)
    {
        return array_key_exists($entityId, $this->values)
            ? $this->values[$entityId]
            : $default;
    }

    /**
     * Check if an value is set for an entity.
     *
     * @param string $entityId
     *
     * @return bool
     */
    public function hasEntityValue(string $entityId): bool
    {
        return array_key_exists($entityId, $this->values);
    }

    /**
     * Set values for all entities.
     *
     * @param mixed[] $values
     *
     * @return void
     */
    public function setValues(array $values)
    {
        $this->values = $values;
    }

    /**
     * Get values for all entities.
     *
     * @return mixed[]
     */
    public function getValues(): array
    {
        return $this->values;
    }
}
