<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Condition\Validator;

use ArrayAccess;

/**
 * Contains a list of named validators.
 */
interface ValidatorContainerInterface
{
    /**
     * Whether a validator exists.
     *
     * @param string $name
     *
     * @return bool
     */
    public function hasValidator(string $name): bool;

    /**
     * Get a validator.
     *
     * @param string $name
     *
     * @return callable
     *
     * @throws InvalidValidatorException When the validator does not exist.
     */
    public function getValidator(string $name): callable;

    /**
     * Get a validator with a context item.
     *
     * @param string      $name
     * @param ArrayAccess $item
     *
     * @return callable
     *
     * @throws InvalidValidatorException When the validator does not exist.
     */
    public function getValidatorWithItem(
        string $name,
        ArrayAccess $item
    ): callable;

    /**
     * Add a validator.
     *
     * @param callable $validator
     * @param string   $name
     *
     * @return ValidatorContainerInterface
     */
    public function addValidator(
        callable $validator,
        string $name
    ): ValidatorContainerInterface;
}
