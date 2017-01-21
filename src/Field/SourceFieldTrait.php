<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Field;

/**
 * Implements SourceFieldInterface.
 */
trait SourceFieldTrait
{
    /**
     * @var string
     */
    private $attributeCode;

    /**
     * Set the code of the attribute.
     *
     * @param string $attributeCode
     *
     * @return void
     */
    public function setAttributeCode(string $attributeCode)
    {
        $this->attributeCode = $attributeCode;
    }

    /**
     * Get the code of the attribute.
     *
     * @return string
     */
    protected function getAttributeCode(): string
    {
        return $this->attributeCode;
    }
}
