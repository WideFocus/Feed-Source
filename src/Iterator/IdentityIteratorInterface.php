<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Iterator;

use Iterator;

interface IdentityIteratorInterface extends Iterator
{
    /**
     * Get the current item.
     *
     * @return string
     */
    public function current(): string;
}
