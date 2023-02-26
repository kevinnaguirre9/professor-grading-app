<?php

namespace ProfessorGradingApp\Infrastructure\ClassInspectionRequest\Repositories\Doctrine;

use Doctrine\ODM\MongoDB\Types\ClosureToPHP;
use Doctrine\ODM\MongoDB\Types\Type;
use ProfessorGradingApp\Domain\ClassInspectionRequest\Exceptions\InvalidClassInspectionRequestStatus;
use ProfessorGradingApp\Domain\ClassInspectionRequest\ValueObjects\ClassInspectionRequestStatus;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Contracts\DoctrineCustomType;

/**
 * Class ClassInspectionRequestStatusDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\ClassInspectionRequest\Repositories\Doctrine
 */
final class ClassInspectionRequestStatusDoctrineType extends Type implements DoctrineCustomType
{
    use ClosureToPHP;

    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'class_inspection_request_status';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return ClassInspectionRequestStatus::class;
    }

    /**
     * @inheritDoc
     * @throws InvalidClassInspectionRequestStatus
     */
    public function convertToPHPValue($value)
    {
        return ClassInspectionRequestStatus::fromValue($value);
    }

    /**
     * @inheritDoc
     */
    public function convertToDatabaseValue($value)
    {
        return $value instanceof ClassInspectionRequestStatus ? $value->value() : $value;
    }
}
