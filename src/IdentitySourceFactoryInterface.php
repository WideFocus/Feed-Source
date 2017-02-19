<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source;

/**
 * Creates identity sources.
 */
interface IdentitySourceFactoryInterface
{
    /**
     * Create a source.
     *
     * @param SourceParametersInterface $parameters
     *
     * @return IdentitySourceInterface
     */
    public function createSource(
        SourceParametersInterface $parameters
    ): IdentitySourceInterface;
}