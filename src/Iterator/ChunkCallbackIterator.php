<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Iterator;

use ArrayIterator;
use Iterator;

/**
 * Iterates over an array and executes a callback before each chunk.
 */
class ChunkCallbackIterator implements Iterator
{
    /**
     * @var Iterator
     */
    private $innerIterator;

    /**
     * @var Iterator
     */
    private $chunkIterator;

    /**
     * @var callable
     */
    private $callback;

    /**
     * @var int
     */
    private $chunkSize;

    /**
     * Constructor.
     *
     * @param Iterator $iterator
     * @param callable $callback
     * @param int      $chunkSize
     */
    public function __construct(Iterator $iterator, callable $callback, int $chunkSize)
    {
        $this->innerIterator = $iterator;
        $this->callback      = $callback;
        $this->chunkSize     = $chunkSize;
        $this->chunkIterator = new ArrayIterator([]);
        $this->chunkIterator->rewind();
    }

    /**
     * Return the current element.
     *
     * @return mixed
     */
    public function current()
    {
        return $this->chunkIterator->current();
    }

    /**
     * Move forward to next element.
     *
     * @return void
     */
    public function next()
    {
        $this->chunkIterator->next();

        if (!$this->chunkIterator->valid()) {
            $this->loadChunk();
        }
    }

    /**
     * Return the key of the current element.
     *
     * @return mixed
     */
    public function key()
    {
        return $this->chunkIterator->key();
    }

    /**
     * Checks if current position is valid.
     *
     * @return bool
     */
    public function valid(): bool
    {
        return $this->chunkIterator->valid();
    }

    /**
     * Rewind the to the first element.
     *
     * @return void
     */
    public function rewind()
    {
        $this->innerIterator->rewind();
        $this->loadChunk();
    }

    /**
     * Load a chunk from the inner iterator.
     *
     * @return void
     */
    protected function loadChunk()
    {
        $items = [];
        while ($this->innerIterator->valid()
            && count($items) < $this->chunkSize
        ) {
            $items[$this->innerIterator->key()] = $this->innerIterator->current();
            $this->innerIterator->next();
        }

        if (count($items)) {
            call_user_func($this->callback, $items);
            $this->chunkIterator = new ArrayIterator($items);
            $this->chunkIterator->rewind();
        }
    }
}
