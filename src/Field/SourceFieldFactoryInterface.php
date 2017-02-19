<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
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
