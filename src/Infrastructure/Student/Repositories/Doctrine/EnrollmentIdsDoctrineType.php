<?php

namespace ProfessorGradingApp\Infrastructure\Student\Repositories\Doctrine;

use Doctrine\ODM\MongoDB\MongoDBException;
use Doctrine\ODM\MongoDB\Types\CollectionType;
use ProfessorGradingApp\Domain\Student\ValueObjects\EnrollmentId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Contracts\DoctrineCustomType;

/**
 * Class EnrollmentIdsDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Student\Repositories\Doctrine
 */
final class EnrollmentIdsDoctrineType extends CollectionType implements DoctrineCustomType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'student_enrollment_ids';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return EnrollmentId::class;
    }

    /**
     * @inheritDoc
     */
    public function convertToPHPValue($value)
    {
        $scalars = parent::convertToPHPValue($value);

        $classname = $this->customTypeClassName();

        return array_map(fn(string $enrollmentId) => new $classname($enrollmentId), $scalars);
    }

    /**
     * @inheritDoc
     * @throws MongoDBException
     */
    public function convertToDatabaseValue($value)
    {
        return parent::convertToDatabaseValue(
            array_map(fn(EnrollmentId $enrollmentId) => $enrollmentId->value(), $value)
        );
    }
}
