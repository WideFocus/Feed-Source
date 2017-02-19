<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Field;

/**
 * Contains a combination of fields.
 */
interface SourceFieldCombinationInterface extends SourceFieldInterface
{
    /**
     * Get the field values for an entity.
     *
     * @param string $entityId
     *
     * @return array
     */
    public function getValue(string $entityId): array;

    /**
     * Add a field.
     *
     * @param SourceFieldInterface $field
     * @param string               $name
     *
     * @return void
     */
    public function addField(SourceFieldInterface $field, string $name);
}