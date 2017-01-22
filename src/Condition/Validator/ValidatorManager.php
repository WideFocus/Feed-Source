<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Condition\Validator;

/**
 * Contains a list of named validators.
 */
class ValidatorManager implements ValidatorManagerInterface
{
    /**
     * @var callable[]
     */
    private $validators = [];

    /**
     * Whether a validator exists.
     *
     * @param string $name
     *
     * @return bool
     */
    public function hasValidator(string $name): bool
    {
        return array_key_exists($name, $this->validators);
    }

    /**
     * Get a validator.
     *
     * @param string $name
     *
     * @return callable
     *
     * @throws InvalidValidatorException When the validator does not exist.
     */
    public function getValidator(string $name): callable
    {
        if (!array_key_exists($name, $this->validators)) {
            throw new InvalidValidatorException(
                sprintf('The validator with name "%s" is not registered', $name)
            );
        }

        return clone $this->validators[$name];
    }

    /**
     * Add a validator.
     *
     * @param callable $validator
     * @param string   $name
     *
     * @return ValidatorManagerInterface
     */
    public function addValidator(
        callable $validator,
        string $name
    ): ValidatorManagerInterface {
        $this->validators[$name] = $validator;
        return $this;
    }
}