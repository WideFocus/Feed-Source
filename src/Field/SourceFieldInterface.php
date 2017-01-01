<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Field;

use ArrayAccess;

/**
 * Applies values on a feed item.
 */
interface SourceFieldInterface
{
    /**
     * Apply the field value to a data object.
     *
     * @param ArrayAccess $item
     *
     * @return SourceFieldInterface
     */
    public function applyValue(ArrayAccess $item): SourceFieldInterface;

    /**
     * Prepare for a set of entities.
     *
     * @param string[] $entityIds
     *
     * @return SourceFieldInterface
     */
    public function prepare(array $entityIds): SourceFieldInterface;

    /**
     * Set the code of the attribute.
     *
     * @param string $attributeCode
     *
     * @return SourceFieldInterface
     */
    public function setAttributeCode(string $attributeCode): SourceFieldInterface;
}
