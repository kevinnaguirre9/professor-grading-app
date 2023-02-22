<?php

namespace ProfessorGradingApp\Infrastructure\Degree\Repositories\Doctrine;

use Doctrine\ODM\MongoDB\MongoDBException;
use Doctrine\ODM\MongoDB\Types\{ClosureToPHP, CollectionType};
use ProfessorGradingApp\Domain\Degree\ValueObjects\SubjectId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Contracts\DoctrineCustomType;

/**
 * Class SubjectIdsDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Degree\Repositories\Doctrine
 */
final class SubjectIdsDoctrineType extends CollectionType implements DoctrineCustomType
{
    use ClosureToPHP;

    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'degree_subject_ids';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return SubjectId::class;
    }

    /**
     * @inheritDoc
     */
    public function convertToPHPValue($value)
    {
        $scalars = parent::convertToPHPValue($value);

        $classname = $this->customTypeClassName();

        return array_map(fn(string $subjectId) => new $classname($subjectId), $scalars);
    }

    /**
     * @inheritDoc
     * @throws MongoDBException
     */
    public function convertToDatabaseValue($value)
    {
        return parent::convertToDatabaseValue(
            array_map(fn(SubjectId $subjectId) => $subjectId->value(), $value)
        );
    }
}
