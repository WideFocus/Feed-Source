<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Field;

/**
 * Gets values for a feed item.
 */
interface SourceFieldInterface
{
    /**
     * Get the field value for an entity.
     *
     * @param string $entityId
     *
     * @return mixed
     */
    public function getValue(string $entityId);

    /**
     * Prepare for a set of entities.
     *
     * @param string[] $entityIds
     *
     * @return void
     */
    public function prepare(array $entityIds);

    /**
     * Set the code of the attribute.
     *
     * @param string $attributeCode
     *
     * @return void
     */
    public function setAttributeCode(string $attributeCode);
}
