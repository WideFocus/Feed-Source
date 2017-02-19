<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source;

/**
 * Provides access to a data source to get entity ids.
 */
interface IdentitySourceInterface
{
    /**
     * Get entity ids that are available.
     *
     * @return string[]
     */
    public function getEntityIds(): array;
}
