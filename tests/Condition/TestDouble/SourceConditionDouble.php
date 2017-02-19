<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Tests\Condition\TestDouble;

use WideFocus\Feed\Source\Condition\SourceConditionInterface;
use WideFocus\Feed\Source\Condition\SourceConditionTrait;

class SourceConditionDouble implements SourceConditionInterface
{
    use SourceConditionTrait;

    /**
     * Check whether an entity matches the condition.
     *
     * @param string $entityId
     *
     * @return bool
     */
    public function matches(string $entityId): bool
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
