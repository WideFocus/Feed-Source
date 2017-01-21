<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Field;

/**
 * Implements SourceFieldCombinationInterface.
 */
trait SourceFieldCombinationTrait
{
    /**
     * @var SourceFieldInterface[]
     */
    private $fields = [];

    /**
     * Add a field.
     *
     * @param SourceFieldInterface $field
     * @param string               $name
     *
     * @return void
     */
    public function addField(SourceFieldInterface $field, string $name)
    {
        $this->fields[$name] = $field;
    }

    /**
     * Get the fields.
     *
     * @return SourceFieldInterface[]
     */
    protected function getFields(): array
    {
        return $this->fields;
    }
}
