<?php

namespace ProfessorGradingApp\Infrastructure\Student\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Student\ValueObjects\StudentId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class StudentIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Student\Repositories\Doctrine
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
