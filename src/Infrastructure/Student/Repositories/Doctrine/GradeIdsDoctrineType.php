<?php

namespace ProfessorGradingApp\Infrastructure\Student\Repositories\Doctrine;

use Doctrine\ODM\MongoDB\MongoDBException;
use Doctrine\ODM\MongoDB\Types\{ClosureToPHP, CollectionType};
use ProfessorGradingApp\Domain\Student\ValueObjects\GradeId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Contracts\DoctrineCustomType;

/**
 * Class GradeIdsDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Student\Repositories\Doctrine
 */
final class GradeIdsDoctrineType extends CollectionType implements DoctrineCustomType
{
    use ClosureToPHP;

    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'student_grade_ids';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return GradeId::class;
    }

    /**
     * @inheritDoc
     */
    public function convertToPHPValue($value)
    {
        $scalars = parent::convertToPHPValue($value);

        $classname = $this->customTypeClassName();

        return array_map(fn(string $gradeId) => new $classname($gradeId), $scalars);
    }

    /**
     * @inheritDoc
     * @throws MongoDBException
     */
    public function convertToDatabaseValue($value)
    {
        return parent::convertToDatabaseValue(
            array_map(fn(GradeId $gradeId) => $gradeId->value(), $value)
        );
    }
}
