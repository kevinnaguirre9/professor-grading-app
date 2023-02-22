<?php

namespace ProfessorGradingApp\Infrastructure\Grade\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Grade\ValueObjects\StudentId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class StudentIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Grade\Repositories\Doctrine
 */
final class StudentIdDoctrineType extends UuidType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'grade_student_id';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return StudentId::class;
    }
}
