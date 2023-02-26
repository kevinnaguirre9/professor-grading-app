<?php

namespace ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\AcademicPeriod;

use ProfessorGradingApp\Domain\Common\ValueObjects\AcademicPeriod\AcademicPeriodId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class AcademicPeriodIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\AcademicPeriod
 */
final class AcademicPeriodIdDoctrineType extends UuidType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'academic_period_id';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return AcademicPeriodId::class;
    }
}
