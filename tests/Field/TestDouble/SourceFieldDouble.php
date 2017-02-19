<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Field\TestDouble;

use WideFocus\Feed\Source\Field\SourceFieldInterface;
use WideFocus\Feed\Source\Field\SourceFieldTrait;

class SourceFieldDouble implements SourceFieldInterface
{
    use SourceFieldTrait;

    /**
     * Get the field value for an entity.
     *
     * @param string $entityId
     *
     * @return mixed
     */
    public function getValue(string $entityId)
    {
        return 'Foo';
    }

    /**
     * Prepare for a set of entities.
     *
     * @param string[] $entityIds
     *
     * @return void
     */
    public function prepare(array $entityIds)
    {
    }

    /**
     * @return string
     */
    public function peekAttributeCode(): string
    {
        return $this->getAttributeCode();
    }
}