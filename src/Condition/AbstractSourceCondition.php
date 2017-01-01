<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Condition;

abstract class AbstractSourceCondition implements SourceConditionInterface
{
    /**
     * @var string
     */
    private $attributeCode;

    /**
     * @var string
     */
    private $operator;

    /**
     * @var mixed
     */
    private $value;

    /**
     * Set the attribute code.
     *
     * @param string $attributeCode
     *
     * @return SourceConditionInterface
     */
    public function setAttributeCode(string $attributeCode): SourceConditionInterface
    {
        $this->attributeCode = $attributeCode;
        return $this;
    }

    /**
     * Get the attribute code.
     *
     * @return string
     */
    protected function getAttributeCode(): string
    {
        return $this->attributeCode;
    }

    /**
     * Set the operator.
     *
     * @param string $operator
     *
     * @return SourceConditionInterface
     */
    public function setOperator(string $operator): SourceConditionInterface
    {
        $this->operator = $operator;
        return $this;
    }

    /**
     * Get the operator.
     *
     * @return string
     */
    protected function getOperator(): string
    {
        return $this->operator;
    }

    /**
     * Set the value.
     *
     * @param mixed $value
     *
     * @return SourceConditionInterface
     */
    public function setValue($value): SourceConditionInterface
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get the value.
     *
     * @return mixed
     */
    protected function getValue()
    {
        return $this->value;
    }
}
