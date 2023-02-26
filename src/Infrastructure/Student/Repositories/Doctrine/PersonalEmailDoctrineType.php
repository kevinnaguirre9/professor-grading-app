<?php

namespace ProfessorGradingApp\Infrastructure\Student\Repositories\Doctrine;

use Doctrine\ODM\MongoDB\Types\{ClosureToPHP, Type};
use ProfessorGradingApp\Domain\Student\ValueObjects\PersonalEmail;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Contracts\DoctrineCustomType;

/**
 * Class PersonalEmailDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Student\Repositories\Doctrine
 */
final class PersonalEmailDoctrineType extends Type implements DoctrineCustomType
{
    use ClosureToPHP;

    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'student_personal_email';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return PersonalEmail::class;
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
        return $value instanceof PersonalEmail ? $value->value() : $value;
    }

}
