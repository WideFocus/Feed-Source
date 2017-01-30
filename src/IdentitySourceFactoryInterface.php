<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source;

use WideFocus\Parameters\ParameterBagInterface;

/**
 * Creates identity sources.
 */
interface IdentitySourceFactoryInterface
{
    /**
     * Create a source.
     *
     * @param ParameterBagInterface $parameters
     *
     * @return IdentitySourceInterface
     */
    public function createSource(
        ParameterBagInterface $parameters
    ): IdentitySourceInterface;
}