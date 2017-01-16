<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source;

interface EntityValueSourceInterface
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
