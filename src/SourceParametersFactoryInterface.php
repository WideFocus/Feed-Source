<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source;

/**
 * Creates parameters objects.
 */
interface SourceParametersFactoryInterface
{
    /**
     * Create a parameters object.
     *
     * @param array $data
     *
     * @return SourceParametersInterface
     */
    public function createParameters(array $data = []): SourceParametersInterface;
}