<?php

namespace ProfessorGradingApp\Infrastructure\Enrollment\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Enrollment\ValueObjects\AcademicPeriodId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class AcademicPeriodIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Enrollment\Repositories\Doctrine
 */
final class AcademicPeriodIdDoctrineType extends UuidType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'enrollment_academic_period_id';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return AcademicPeriodId::class;
    }
}
