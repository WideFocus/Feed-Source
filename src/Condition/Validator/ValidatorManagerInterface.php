<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Condition\Validator;

/**
 * Contains a list of named validators.
 */
interface ValidatorManagerInterface
{
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
     * Add a validator.
     *
     * @param callable $validator
     * @param string   $name
     *
     * @return void
     */
    public function addValidator(callable $validator, string $name);
}
