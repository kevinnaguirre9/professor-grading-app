<?php

namespace ProfessorGradingApp\Infrastructure\Student\Repositories\Doctrine;

use Doctrine\ODM\MongoDB\MongoDBException;
use Doctrine\ODM\MongoDB\Types\{ClosureToPHP, CollectionType};
use ProfessorGradingApp\Domain\Student\ValueObjects\DegreeId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Contracts\DoctrineCustomType;

/**
 * Class DegreeIdsDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Student\Repositories\Doctrine
 */
final class DegreeIdsDoctrineType extends CollectionType implements DoctrineCustomType
{
    use ClosureToPHP;

    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'student_degree_ids';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return DegreeId::class;
    }

    /**
     * @inheritDoc
     */
    public function convertToPHPValue($value)
    {
        $scalars = parent::convertToPHPValue($value);

        $classname = $this->customTypeClassName();

        return array_map(fn(string $degreeId) => new $classname($degreeId), $scalars);
    }

    /**
     * @inheritDoc
     * @throws MongoDBException
     */
    public function convertToDatabaseValue($value)
    {
        return parent::convertToDatabaseValue(
            array_map(fn(DegreeId $degreeId) => $degreeId->value(), $value)
        );
    }
}
