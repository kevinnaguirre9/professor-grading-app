<?php

namespace ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes;

use Doctrine\ODM\MongoDB\Types\{ClosureToPHP, Type};
use ProfessorGradingApp\Domain\Common\ValueObjects\Uuid;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Contracts\DoctrineCustomType;

/**
 * Class UuidType
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes
 */
abstract class UuidType extends Type implements DoctrineCustomType
{
    use ClosureToPHP;

    /**
     * The custom type name to be used in the mapping.
     *
     * @return string
     */
    abstract public function customTypeClassName() : string;

    /**
     * @param $value
     * @return mixed
     */
    public function convertToPHPValue($value): mixed
    {
        if (null === $value)
            return $value;

        $classname = $this->customTypeClassName();

        return new $classname($value);
    }

    /**
     * @param $value
     * @return mixed|string
     */
    public function convertToDatabaseValue($value): mixed
    {
        if(null === $value) return $value;

        return $value instanceof Uuid ? $value->value() : $value;
    }
}
