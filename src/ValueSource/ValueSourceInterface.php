<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\ValueSource;

interface ValueSourceInterface
{
    /**
     * Get entity values.
     *
     * @param array  $entityIds
     * @param string $attributeCode
     *
     * @return ValueListInterface
     */
    public function getEntityValues(
        array $entityIds,
        string $attributeCode
    ): ValueListInterface;
}
