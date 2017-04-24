<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Iterator;

use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Feed\Source\Field\SourceFieldCombinationInterface;
use WideFocus\Feed\Source\IdentitySource\IdentitySourceInterface;

interface SourceIteratorFactoryInterface
{
    /**
     * Create an iterator to iterate over a source.
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
    ): SourceIteratorInterface;
}
