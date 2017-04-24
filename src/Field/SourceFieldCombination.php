<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Field;

/**
 * Contains a combination of fields.
 */
class SourceFieldCombination implements SourceFieldCombinationInterface
{
    /**
     * @var SourceFieldInterface[]
     */
    private $fields;

    /**
     * Constructor.
     *
     * @param SourceFieldInterface[] $fields
     */
    public function __construct(array $fields)
    {
        $this->fields = $fields;
    }

    /**
     * Get the field values for an entity.
     *
     * @param string $entityId
     *
     * @return array
     */
    public function getValue(string $entityId): array
    {
        return array_map(
            function (SourceFieldInterface $field) use ($entityId) {
                return $field->getValue($entityId);
            },
            $this->fields
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
        array_walk(
            $this->fields,
            function (SourceFieldInterface $field) use ($entityIds) {
                $field->prepare($entityIds);
            }
        );
    }
}
