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
     * @param string $key
     * @param mixed  $value
     *
     * @return void
     */
    public function set(string $key, $value)
    {
        $this->values[$key] = $value;
    }

    /**
     * Get the value for an entity.
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        return array_key_exists($key, $this->values)
            ? $this->values[$key]
            : $default;
    }

    /**
     * Check if an value is set for an entity.
     *
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->values);
    }

    /**
     * Set values for all entities.
     *
     * @param mixed[] $values
     *
     * @return void
     */
    public function load(array $values)
    {
        $this->values = $values;
    }

    /**
     * Get values for all entities.
     *
     * @return mixed[]
     */
    public function all(): array
    {
        return $this->values;
    }
}
