<?php
/**
 * Copyright WideFocus. All rights reserved.
 * http://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Condition\Validator;

use ArrayAccess;
use WideFocus\Validator\ContextAwareValidatorInterface;

/**
 * Contains a list of named validators.
 */
class ValidatorContainer implements ValidatorContainerInterface
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
    ): callable {
        $validator = $this->getValidator($name);
        if ($validator instanceof ContextAwareValidatorInterface) {
            $validator->setContext($item);
        }

        return $validator;
    }

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
    ): ValidatorContainerInterface {
        $this->validators[$name] = $validator;
        return $this;
    }
}
