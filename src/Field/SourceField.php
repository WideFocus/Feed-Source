<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Field;

use WideFocus\Feed\Source\ValueList;
use WideFocus\Feed\Source\ValueListInterface;
use WideFocus\Feed\Source\ValueSourceInterface;

/**
 * Default source field implementation.
 */
class SourceField implements SourceFieldInterface
{
    /**
     * @var ValueSourceInterface
     */
    private $valueSource;

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
     * @param string                  $attributeCode
     * @param ValueListInterface|null $valueList
     */
    public function __construct(
        ValueSourceInterface $valueSource,
        string $attributeCode,
        ValueListInterface $valueList = null
    ) {
        $this->valueSource   = $valueSource;
        $this->attributeCode = $attributeCode;
        $this->valueList     = $valueList ?: new ValueList();
    }

    /**
     * Get the field value for an entity.
     *
     * @param string $entityId
     *
     * @return mixed
     */
    public function getValue(string $entityId)
    {
        return $this->valueList
            ->get($entityId);
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
