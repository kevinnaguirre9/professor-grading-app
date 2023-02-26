<?php

namespace ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes;

use Doctrine\ODM\MongoDB\Types\{ClosureToPHP, Type};
use ProfessorGradingApp\Domain\Common\Exceptions\InvalidWeekdayValue;
use ProfessorGradingApp\Domain\Common\ValueObjects\Weekday;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Contracts\DoctrineCustomType;

/**
 * Class WeekdayDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes
 */
final class WeekdayDoctrineType extends Type implements DoctrineCustomType
{
    use ClosureToPHP;

    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'weekday';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return Weekday::class;
    }

    /**
     * @inheritDoc
     * @throws InvalidWeekdayValue
     */
    public function convertToPHPValue($value): Weekday
    {
        return Weekday::fromValue($value);
    }

    /**
     * @inheritDoc
     */
    public function convertToDatabaseValue($value)
    {
        return $value instanceof Weekday ? $value->value() : $value;
    }
}
