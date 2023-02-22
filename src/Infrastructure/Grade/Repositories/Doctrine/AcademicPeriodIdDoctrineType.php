<?php

namespace ProfessorGradingApp\Infrastructure\Grade\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Grade\ValueObjects\AcademicPeriodId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class AcademicPeriodIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Grade\Repositories\Doctrine
 */
final class AcademicPeriodIdDoctrineType extends UuidType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'grade_academic_period_id';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return AcademicPeriodId::class;
    }
}
