<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\ValueSource;

/**
 * Contains attributes values for a set of entities.
 */
interface ValueListInterface
{
    /**
     * Set the value for an entity.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return void
     */
    public function set(string $key, $value);

    /**
     * Get the value for an entity.
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get(string $key, $default = null);

    /**
     * Check if an value is set for an entity.
     *
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * Set values for all entities.
     *
     * @param mixed[] $values
     *
     * @return void
     */
    public function load(array $values);

    /**
     * Get values for all entities.
     *
     * @return mixed[]
     */
    public function all(): array;
}
