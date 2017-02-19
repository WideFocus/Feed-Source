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
    use SourceFieldTrait;
    use SourceFieldCombinationTrait;

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
            $this->getFields()
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
        $fields = $this->getFields();
        array_walk(
            $fields,
            function (SourceFieldInterface $field) use ($entityIds) {
                $field->prepare($entityIds);
            }
        );
    }
}
