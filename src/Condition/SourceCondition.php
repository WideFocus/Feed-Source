<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Condition;

use WideFocus\Feed\Source\ValueList;
use WideFocus\Feed\Source\ValueListInterface;
use WideFocus\Feed\Source\ValueSourceInterface;

/**
 * Default source condition implementation.
 */
class SourceCondition implements SourceConditionInterface
{
    /**
     * @var ValueSourceInterface
     */
    private $valueSource;

    /**
     * @var callable
     */
    private $validator;

    /**
     * @var ValueListInterface
     */
    private $valueList;

    /**
     * @var string
     */
    private $attributeCode;

    /**
     * Constructor.
     *
     * @param ValueSourceInterface    $valueSource
     * @param callable                $validator
     * @param string                  $attributeCode
     * @param ValueListInterface|null $valueList
     */
    public function __construct(
        ValueSourceInterface $valueSource,
        callable $validator,
        string $attributeCode,
        ValueListInterface $valueList = null
    ) {
        $this->valueSource   = $valueSource;
        $this->validator     = $validator;
        $this->attributeCode = $attributeCode;
        $this->valueList     = $valueList ?: new ValueList();
    }

    /**
     * Check whether an entity matches the condition.
     *
     * @param string $entityId
     *
     * @return bool
     */
    public function matches(string $entityId): bool
    {
        return call_user_func(
            $this->validator,
            $this->valueList->get($entityId)
        );
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
        $this->valueList->load(
            $this->valueSource
                ->getEntityValues($entityIds, $this->attributeCode)
                ->all()
        );
    }
}
