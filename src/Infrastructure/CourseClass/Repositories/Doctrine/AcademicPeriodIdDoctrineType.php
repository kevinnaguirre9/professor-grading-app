<?php

namespace ProfessorGradingApp\Infrastructure\CourseClass\Repositories\Doctrine;

use ProfessorGradingApp\Domain\CourseClass\ValueObjects\AcademicPeriodId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class AcademicPeriodIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\CourseClass\Repositories\Doctrine
 */
final class AcademicPeriodIdDoctrineType extends UuidType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'class_academic_period_id';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return AcademicPeriodId::class;
    }
}
