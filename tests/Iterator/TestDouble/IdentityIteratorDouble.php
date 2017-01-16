<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Iterator\TestDouble;

use ArrayIterator;
use WideFocus\Feed\Source\Iterator\IdentityIteratorInterface;

class IdentityIteratorDouble extends ArrayIterator implements IdentityIteratorInterface
{
    /**
     * Get the current item.
     *
     * @return string
     */
    public function current(): string
    {
        return parent::current();
    }
}