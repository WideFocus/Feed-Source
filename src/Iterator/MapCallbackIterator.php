<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Iterator;

use IteratorIterator;
use Traversable;

class MapCallbackIterator extends IteratorIterator
{
    /**
     * @var callable
     */
    private $callback;

    /**
     * Constructor.
     *
     * @param Traversable $iterator
     * @param callable    $callback
     */
    public function __construct(Traversable $iterator, callable $callback)
    {
        parent::__construct($iterator);
        $this->callback = $callback;
    }

    /**
     * Apply the callback on the value.
     *
     * @return mixed
     */
    public function current()
    {
        return call_user_func($this->callback, parent::current());
    }
}