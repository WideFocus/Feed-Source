<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Field\TestDouble;

use WideFocus\Feed\Source\Field\SourceFieldCombinationInterface;
use WideFocus\Feed\Source\Field\SourceFieldCombinationTrait;
use WideFocus\Feed\Source\Field\SourceFieldInterface;
use WideFocus\Feed\Source\Field\SourceFieldTrait;

class SourceFieldCombinationDouble implements SourceFieldCombinationInterface
{
    use SourceFieldTrait;
    use SourceFieldCombinationTrait;

    /**
     * Get the field value for an entity.
     *
     * @param string $entityId
     *
     * @return mixed
     */
    public function getValue(string $entityId): array
    {
        return ['Foo'];
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
     * @return SourceFieldInterface[]
     */
    public function peekFields(): array
    {
        return $this->getFields();
    }
}
