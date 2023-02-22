<?php

namespace ProfessorGradingApp\Infrastructure\CourseClass\Repositories\Doctrine;

use ProfessorGradingApp\Domain\CourseClass\ValueObjects\GradeId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidCollectionType;

/**
 * Class GradeIdsDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\CourseClass\Repositories\Doctrine
 */
final class GradeIdsDoctrineType extends UuidCollectionType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'class_grade_ids';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return GradeId::class;
    }
}
