<?php

namespace ProfessorGradingApp\Infrastructure\Student\Repositories\Doctrine;

use Doctrine\ODM\MongoDB\Types\{ClosureToPHP, Type};
use ProfessorGradingApp\Domain\Student\ValueObjects\NationalIdentificationNumber;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Contracts\DoctrineCustomType;

/**
 * Class NationalIdentificationNumberDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Student\Repositories\Doctrine
 */
final class NationalIdentificationNumberDoctrineType extends Type implements DoctrineCustomType
{
    use ClosureToPHP;

    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'student_national_identification_number';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return NationalIdentificationNumber::class;
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
        return $value instanceof NationalIdentificationNumber ? $value->value() : $value;
    }
}
