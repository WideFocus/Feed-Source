<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Iterator;

use ArrayAccess;
use Iterator;

/**
 * Iterates over the items of a source.
 */
interface SourceIteratorInterface extends Iterator
{
    /**
     * Get the current item.
     *
     * @return ArrayAccess
     */
    public function current(): ArrayAccess;
}