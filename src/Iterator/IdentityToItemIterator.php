<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Iterator;

use ArrayAccess;
use ArrayObject;
use Iterator;
use IteratorIterator;
use WideFocus\Feed\Source\Field\SourceFieldCombinationInterface;


/**
 * Maps entity ids to value objects.
 */
class IdentityToItemIterator extends IteratorIterator implements SourceIteratorInterface
{
    /**
     * @var SourceFieldCombinationInterface
     */
    private $fields;

    /**
     * Constructor.
     *
     * @param IdentityIteratorInterface       $identityIterator
     * @param SourceFieldCombinationInterface $fields
     * @param int                             $chunkSize
     */
    public function __construct(
        IdentityIteratorInterface $identityIterator,
        SourceFieldCombinationInterface $fields,
        int $chunkSize
    ) {
        $this->fields = $fields;
        return parent::__construct(
            $this->createMappingIterator(
                $this->createPreparingIterator(
                    $identityIterator,
                    $chunkSize
                )
            )
        );
    }

    /**
     * Get the current item.
     *
     * @return ArrayAccess
     */
    public function current(): ArrayAccess
    {
        return parent::current();
    }

    /**
     * Creates an iterator which prepares the fields before a chunk.
     *
     * @param Iterator $iterator
     * @param int      $chunkSize
     *
     * @return ChunkCallbackIterator
     */
    private function createPreparingIterator(
        Iterator $iterator,
        int $chunkSize
    ): ChunkCallbackIterator {
        return new ChunkCallbackIterator(
            $iterator,
            function (array $entityIds) {
                $this->fields->prepare($entityIds);
            },
            $chunkSize
        );
    }

    /**
     * Creates an iterator which maps entity ids to value objects.
     *
     * @param Iterator $iterator
     *
     * @return MapCallbackIterator
     */
    private function createMappingIterator(
        Iterator $iterator
    ): MapCallbackIterator {
        return new MapCallbackIterator(
            $iterator,
            function (string $entityId) {
                return new ArrayObject(
                    $this->fields->getValue($entityId)
                );
            }
        );
    }
}
