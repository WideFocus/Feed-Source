<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Field;

use WideFocus\Feed\Entity\FeedFieldInterface;
use WideFocus\Feed\Source\ValueSource\ValueSourceFactoryInterface;
use WideFocus\Parameters\ParameterBagInterface;

class SourceFieldFactory implements SourceFieldFactoryInterface
{
    /**
     * @var ValueSourceFactoryInterface
     */
    private $valueSourceFactory;

    /**
     * Constructor.
     *
     * @param ValueSourceFactoryInterface $valueSourceFactory
     */
    public function __construct(
        ValueSourceFactoryInterface $valueSourceFactory
    ) {
        $this->valueSourceFactory = $valueSourceFactory;
    }

    /**
     * Create a source field.
     *
     * @param FeedFieldInterface    $feedField
     * @param ParameterBagInterface $sourceParameters
     *
     * @return SourceFieldInterface
     */
    public function create(
        FeedFieldInterface $feedField,
        ParameterBagInterface $sourceParameters
    ): SourceFieldInterface {
        return new SourceField(
            $this->valueSourceFactory->create($sourceParameters),
            $feedField->getName()
        );
    }
}
