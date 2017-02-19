<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Iterator;

use CallbackFilterIterator;
use Iterator;
use IteratorIterator;
use WideFocus\Feed\Source\Condition\SourceConditionInterface;

/**
 * Validates the iterated identities.
 */
class ValidatedIdentityIterator extends IteratorIterator implements IdentityIteratorInterface
{
    /**
     * @var SourceConditionInterface
     */
    private $conditions;

    /**
     * Constructor.
     *
     * @param IdentityIteratorInterface $identityIterator
     * @param SourceConditionInterface  $conditions
     * @param int                       $chunkSize
     */
    public function __construct(
        IdentityIteratorInterface $identityIterator,
        SourceConditionInterface $conditions,
        int $chunkSize
    ) {
        $this->conditions = $conditions;
        return parent::__construct(
            $this->createValidatingIterator(
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
     * @return string
     */
    public function current(): string
    {
        return parent::current();
    }

    /**
     * Creates an iterator which prepares the conditions before a chunk.
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
                $this->conditions->prepare($entityIds);
            },
            $chunkSize
        );
    }

    /**
     * Creates an iterator which filters the identities that do not validate.
     *
     * @param Iterator $iterator
     *
     * @return CallbackFilterIterator
     */
    private function createValidatingIterator(
        Iterator $iterator
    ): CallbackFilterIterator {
        return new CallbackFilterIterator(
            $iterator,
            function (string $entityId) : bool {
                return $this->conditions->matches($entityId);
            }
        );
    }
}
