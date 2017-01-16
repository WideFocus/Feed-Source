<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Iterator;

use ArrayIterator;
use WideFocus\Feed\Source\IdentitySourceInterface;

/**
 * Iterates over an identity source.
 */
class IdentitySourceIterator extends ArrayIterator implements IdentityIteratorInterface
{
    /**
     * Constructor.
     *
     * @param IdentitySourceInterface $source
     */
    public function __construct(IdentitySourceInterface $source)
    {
        parent::__construct($source->getEntityIds());
    }

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
