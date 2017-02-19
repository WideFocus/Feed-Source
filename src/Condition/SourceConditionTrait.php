<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Condition;

/**
 * Trait to implement SourceConditionInterface.
 */
trait SourceConditionTrait
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
     * @return void
     */
    public function setAttributeCode(string $attributeCode)
    {
        $this->attributeCode = $attributeCode;
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
     * @return void
     */
    public function setOperator(string $operator)
    {
        $this->operator = $operator;
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
     * @return void
     */
    public function setValue($value)
    {
        $this->value = $value;
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
