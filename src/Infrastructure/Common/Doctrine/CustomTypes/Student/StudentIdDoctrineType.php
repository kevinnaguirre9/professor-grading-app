<?php

namespace ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\Student;

use ProfessorGradingApp\Domain\Common\ValueObjects\Student\StudentId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class StudentIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\Student
 */
final class StudentIdDoctrineType extends UuidType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'student_id';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return StudentId::class;
    }
}
