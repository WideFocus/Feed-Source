<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source;

use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Source\Field\SourceFieldCombinationInterface;

interface FieldCombinationFactoryInterface
{
    /**
     * Create a field combination for a feed.
     *
     * @param FeedInterface $feed
     *
     * @return SourceFieldCombinationInterface
     */
    public function create(FeedInterface $feed): SourceFieldCombinationInterface;
}
