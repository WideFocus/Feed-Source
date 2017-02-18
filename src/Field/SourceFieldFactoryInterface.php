<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Field;

use WideFocus\Feed\Source\SourceParametersInterface;

/**
 * Creates source fields.
 */
interface SourceFieldFactoryInterface
{
    /**
     * Create a source field.
     *
     * @param SourceParametersInterface $parameters
     *
     * @return SourceFieldInterface
     */
    public function createField(
        SourceParametersInterface $parameters
    ): SourceFieldInterface;
}
