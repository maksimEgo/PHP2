<?php

namespace src;

/**
 * Trait ObjectProperties
 *
 * This trait provides a simple way to manage object properties dynamically.
 *
 * @package src
 */
trait ObjectProperties
{
    /**
     * @var array An associative array to store object properties.
     */
    private array $data = [];

    /**
     * Magic set method to set a property's value.
     *
     * @param string $name The name of the property.
     * @param mixed $value The value of the property.
     *
     * @return void
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * Magic get method to retrieve a property's value.
     *
     * @param string $name The name of the property.
     *
     * @return mixed The value of the property if set, or null if not set.
     */
    public function __get($name)
    {
        return $this->data[$name];
    }

    /**
     * Magic isset method to check if a property is set.
     *
     * @param string $name The name of the property.
     *
     * @return bool True if the property is set, false otherwise.
     */
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    /**
     * Magic unset method to unset a property.
     *
     * @param string $name The name of the property.
     *
     * @return void
     */
    public function __unset(string $name)
    {
        unset($this->data[$name]);
    }
}