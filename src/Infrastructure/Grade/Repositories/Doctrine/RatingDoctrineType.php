<?php

namespace ProfessorGradingApp\Infrastructure\Grade\Repositories\Doctrine;

use Doctrine\ODM\MongoDB\Types\{ClosureToPHP, Type};
use ProfessorGradingApp\Domain\Grade\Exceptions\InvalidRating;
use ProfessorGradingApp\Domain\Grade\ValueObjects\Rating;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Contracts\DoctrineCustomType;

/**
 * Class RatingDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Grade\Repositories\Doctrine
 */
final class RatingDoctrineType extends Type implements DoctrineCustomType
{
    use ClosureToPHP;

    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'grade_rating';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return Rating::class;
    }

    /**
     * @inheritDoc
     * @throws InvalidRating
     */
    public function convertToPHPValue($value)
    {
        return Rating::fromValue($value);
    }

    /**
     * @inheritDoc
     */
    public function convertToDatabaseValue($value)
    {
        return $value instanceof Rating ? $value->value() : $value;
    }
}
