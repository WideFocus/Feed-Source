<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Field;

use WideFocus\Parameters\ParameterBagInterface;

/**
 * Creates source fields.
 */
interface SourceFieldFactoryInterface
{
    /**
     * Create a source field.
     *
     * @param ParameterBagInterface $parameters
     *
     * @return SourceFieldInterface
     */
    public function createField(
        ParameterBagInterface $parameters
    ): SourceFieldInterface;
}
