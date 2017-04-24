<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Condition;

/**
 * Contains a combination of conditions.
 */
class SourceConditionCombination implements SourceConditionInterface
{
    /**
     * @var callable
     */
    private $validator;

    /**
     * @var SourceConditionInterface[]
     */
    private $conditions;

    /**
     * Constructor.
     *
     * @param callable                   $validator
     * @param SourceConditionInterface[] ...$conditions
     */
    public function __construct(
        callable $validator,
        SourceConditionInterface ...$conditions
    ) {
        $this->validator  = $validator;
        $this->conditions = $conditions;
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
        $closures = array_map(
            function (SourceConditionInterface $condition) use ($entityId) : callable {
                return function () use ($condition, $entityId) {
                    return $condition->matches($entityId);
                };
            },
            $this->conditions
        );

        return call_user_func($this->validator, $closures);
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
            $this->conditions,
            function (SourceConditionInterface $condition) use ($entityIds) {
                $condition->prepare($entityIds);
            }
        );
    }
}
