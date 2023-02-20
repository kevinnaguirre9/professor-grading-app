<?php

namespace ProfessorGradingApp\Infrastructure\AcademicPeriod\Repositories\Doctrine;

use ProfessorGradingApp\Domain\AcademicPeriod\ValueObjects\AcademicPeriodId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class AcademicPeriodIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\AcademicPeriod\Repositories\Doctrine
 */
final class AcademicPeriodIdDoctrineType extends UuidType
{
    /**
     * @return string
     */
    public static function customTypeName(): string
    {
        return 'academic_period_id';
    }

    /**
     * @return string
     */
    public function customTypeClassName(): string
    {
        return AcademicPeriodId::class;
    }
}
