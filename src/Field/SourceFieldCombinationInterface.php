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
     * Get the field value for an entity.
     *
     * @param string $entityId
     *
     * @return array
     */
    public function getValue(string $entityId): array;
}
