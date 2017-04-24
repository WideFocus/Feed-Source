<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Iterator;

use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Feed\Source\Field\SourceFieldCombinationInterface;
use WideFocus\Feed\Source\IdentitySource\IdentitySourceInterface;

class SourceIteratorFactory implements SourceIteratorFactoryInterface
{
    /**
     * @var int
     */
    private $chunkSize;

    /**
     * Constructor.
     *
     * @param int $chunkSize
     */
    public function __construct(int $chunkSize)
    {
        $this->chunkSize = $chunkSize;
    }

    /**
     * Create an iterator to iterate over source.
     *
     * @param IdentitySourceInterface         $source
     * @param SourceConditionInterface        $conditions
     * @param SourceFieldCombinationInterface $fields
     *
     * @return SourceIteratorInterface
     */
    public function create(
        IdentitySourceInterface $source,
        SourceConditionInterface $conditions,
        SourceFieldCombinationInterface $fields
    ): SourceIteratorInterface {
        return new IdentityToItemIterator(
            new ValidatedIdentityIterator(
                new IdentitySourceIterator($source),
                $conditions,
                $this->chunkSize
            ),
            $fields,
            $this->chunkSize
        );
    }
}
