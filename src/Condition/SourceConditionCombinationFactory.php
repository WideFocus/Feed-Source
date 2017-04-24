<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Condition;

use WideFocus\Feed\Entity\FeedConditionInterface;
use WideFocus\Feed\Source\Condition\FactoryAggregate\SourceConditionFactoryAggregateInterface;
use WideFocus\Parameters\ParameterBagInterface;
use WideFocus\Validator\FactoryAggregate\ValidatorFactoryAggregateInterface;

class SourceConditionCombinationFactory implements SourceConditionFactoryInterface
{
    /**
     * @var SourceConditionFactoryAggregateInterface
     */
    private $conditionFactory;

    /**
     * @var ValidatorFactoryAggregateInterface
     */
    private $validatorFactory;

    /**
     * Constructor.
     *
     * @param SourceConditionFactoryAggregateInterface $conditionFactory
     * @param ValidatorFactoryAggregateInterface       $validatorFactory
     */
    public function __construct(
        SourceConditionFactoryAggregateInterface $conditionFactory,
        ValidatorFactoryAggregateInterface $validatorFactory
    ) {
        $this->conditionFactory = $conditionFactory;
        $this->validatorFactory = $validatorFactory;
    }

    /**
     * Create a source condition.
     *
     * @param FeedConditionInterface $feedCondition
     * @param ParameterBagInterface  $sourceParameters
     *
     * @return SourceConditionInterface
     */
    public function create(
        FeedConditionInterface $feedCondition,
        ParameterBagInterface $sourceParameters
    ): SourceConditionInterface {
        $children = array_map(
            function (FeedConditionInterface $condition) use ($sourceParameters) {
                return $this->conditionFactory
                    ->create(
                        $condition,
                        $sourceParameters
                    );
            },
            $feedCondition->getChildren()
        );

        return new SourceConditionCombination(
            $this->validatorFactory->create(
                $feedCondition->getOperator(),
                $feedCondition->getConstraints()
            ),
            ...$children
        );
    }
}
