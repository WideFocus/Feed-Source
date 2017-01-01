<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source;

use ArrayAccess;

/**
 * Provides access to a data source to get entities and their values.
 */
interface SourceInterface
{
    /**
     * Get entity ids that are available.
     *
     * @return string[]
     */
    public function getEntityIds(): array;

    /**
     * Return a list of entities.
     *
     * @param string[] $entityIds
     *
     * @return ArrayAccess[]
     */
    public function getEntities(array $entityIds): array;
}
