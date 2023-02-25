<?php

namespace ProfessorGradingApp\Infrastructure\CourseClass\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Common\ValueObjects\Student\StudentId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidCollectionType;

/**
 * Class StudentIdsDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\CourseClass\Repositories\Doctrine
 */
final class StudentIdsDoctrineType extends UuidCollectionType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'student_ids';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return StudentId::class;
    }
}
