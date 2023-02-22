<?php

namespace ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes;

use Doctrine\ODM\MongoDB\Types\{ClosureToPHP, Type};
use ProfessorGradingApp\Domain\Common\ValueObjects\Time;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Contracts\DoctrineCustomType;

/**
 * Class TimeDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes
 */
final class TimeDoctrineType extends Type implements DoctrineCustomType
{
    use ClosureToPHP;

    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'time';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return Time::class;
    }

    /**
     * @inheritDoc
     */
    public function convertToPHPValue($value)
    {
        $classname = $this->customTypeClassName();

        return new $classname($value);
    }

    /**
     * @inheritDoc
     */
    public function convertToDatabaseValue($value)
    {
        return $value instanceof Time ? $value->value() : $value;
    }
}
