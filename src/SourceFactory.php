<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source;

use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Source\IdentitySource\FactoryAggregate\IdentitySourceFactoryAggregateInterface;
use WideFocus\Feed\Source\Iterator\SourceIteratorFactoryInterface;
use WideFocus\Feed\Source\Iterator\SourceIteratorInterface;

class SourceFactory implements SourceFactoryInterface
{
    /**
     * @var SourceIteratorFactoryInterface
     */
    private $iteratorFactory;

    /**
     * @var IdentitySourceFactoryAggregateInterface
     */
    private $idSourceFactory;

    /**
     * @var ConditionCombinationFactoryInterface
     */
    private $conditionFactory;

    /**
     * @var FieldCombinationFactoryInterface
     */
    private $fieldFactory;

    /**
     * Constructor.
     *
     * @param SourceIteratorFactoryInterface          $iteratorFactory
     * @param IdentitySourceFactoryAggregateInterface $idSourceFactory
     * @param ConditionCombinationFactoryInterface    $conditionFactory
     * @param FieldCombinationFactoryInterface        $fieldFactory
     */
    public function __construct(
        SourceIteratorFactoryInterface $iteratorFactory,
        IdentitySourceFactoryAggregateInterface $idSourceFactory,
        ConditionCombinationFactoryInterface $conditionFactory,
        FieldCombinationFactoryInterface $fieldFactory
    ) {
        $this->iteratorFactory  = $iteratorFactory;
        $this->idSourceFactory  = $idSourceFactory;
        $this->conditionFactory = $conditionFactory;
        $this->fieldFactory     = $fieldFactory;
    }

    /**
     * Create an iterator to iterate over a source.
     *
     * @param FeedInterface $feed
     *
     * @return SourceIteratorInterface
     */
    public function create(
        FeedInterface $feed
    ): SourceIteratorInterface {
        return $this->iteratorFactory->create(
            $this->idSourceFactory->create(
                $feed->getSourceType(),
                $feed->getSourceParameters()
            ),
            $this->conditionFactory->create($feed),
            $this->fieldFactory->create($feed)
        );
    }
}
