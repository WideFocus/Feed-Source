<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Condition\TestDouble;

use ArrayAccess;
use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Feed\Source\Condition\SourceConditionTrait;

class SourceConditionDouble implements SourceConditionInterface
{
    use SourceConditionTrait;

    /**
     * Check whether an item matches the condition.
     *
     * @param ArrayAccess $item
     *
     * @return bool
     */
    public function isValid(ArrayAccess $item): bool
    {
        return true;
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

    /**
     * @return string
     */
    public function peekOperator(): string
    {
        return $this->getOperator();
    }

    /**
     * @return mixed
     */
    public function peekValue()
    {
        return $this->getValue();
    }
}
