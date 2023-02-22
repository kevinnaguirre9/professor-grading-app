<?php

namespace ProfessorGradingApp\Infrastructure\Enrollment\Repositories\Doctrine;

use Doctrine\ODM\MongoDB\MongoDBException;
use Doctrine\ODM\MongoDB\Types\ClosureToPHP;
use Doctrine\ODM\MongoDB\Types\CollectionType;
use ProfessorGradingApp\Domain\Enrollment\ValueObjects\ClassId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Contracts\DoctrineCustomType;

/**
 * Class ClassIdsDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Enrollment\Repositories\Doctrine
 */
final class ClassIdsDoctrineType extends CollectionType implements DoctrineCustomType
{
    use ClosureToPHP;

    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'enrollment_class_ids';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return ClassId::class;
    }

    /**
     * @inheritDoc
     */
    public function convertToPHPValue($value)
    {
        $scalars = parent::convertToPHPValue($value);

        $classname = $this->customTypeClassName();

        return array_map(fn(string $classId) => new $classname($classId), $scalars);
    }

    /**
     * @inheritDoc
     * @throws MongoDBException
     */
    public function convertToDatabaseValue($value)
    {
        return parent::convertToDatabaseValue(
            array_map(fn(ClassId $classId) => $classId->value(), $value)
        );
    }
}
