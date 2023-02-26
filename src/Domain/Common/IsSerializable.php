<?php

namespace ProfessorGradingApp\Domain\Common;

use ReflectionClass;
use ReflectionProperty;

/**
 * Trait IsSerializable
 *
 * @package ProfessorGradingApp\Domain\Common
 */
trait IsSerializable
{
    /**
     * Return an array representation of the entity
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = [];

        $properties = $this->getObjectProperties($this);

        foreach ($properties as $property)
        {
            $value = $this->getPropertyValue($property, $this);

            $propertyName = $property->getName();

            if (!$value) continue;

            if (is_iterable($value) && $this->containsOnlyObjects($value)) {

                $data[$this->camelToSnake($propertyName)] = array_map(
                    fn($object) => $object->toArray(),
                    $value
                );

            } else if($value instanceof \DateTime) {

                $data[$this->camelToSnake($propertyName)] = $value->format('Y-m-d H:i:s');

            } else if(is_object($value)) {

                $variableProperties = $this->getObjectProperties($value);

                if(count($variableProperties) > 1) {

                    $data[$this->camelToSnake($propertyName)] = $value->toArray();

                } else {

                    $singleProperty = array_pop($variableProperties);

                    $data[$this->camelToSnake($propertyName)] = $singleProperty
                        ? $this->getPropertyValue($singleProperty, $value)
                        : $singleProperty;
                }

            } else {

                $data[$this->camelToSnake($propertyName)] = $value;
            }
        }

        return $data;
    }

    /**
     * Gets object properties/attributes based on classname
     *
     * @return ReflectionProperty[]
     */
    protected function getObjectProperties($object): array
    {
        $reflectionClass = new ReflectionClass(get_class($object));

        return $reflectionClass->getProperties();
    }

    /**
     * Gets the value of given class property/attribute
     * based on given object instance
     *
     * @param ReflectionProperty $property
     * @param $object
     * @return mixed
     */
    protected function getPropertyValue(ReflectionProperty $property, $object): mixed
    {
        return $property->isInitialized($object)
            ? $property->getValue($object)
            : false;
    }

    /**
     *
     * @param string $key
     * @return string
     */
    protected function camelToSnake(string $key): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $key));
    }

    /**
     * Checks if all array elements are objects
     *
     * @param iterable $elements
     * @return bool
     */
    protected function containsOnlyObjects(iterable $elements): bool
    {
        foreach ($elements as $element)
            if (!is_object($element)) return false;

        return true;
    }
}
