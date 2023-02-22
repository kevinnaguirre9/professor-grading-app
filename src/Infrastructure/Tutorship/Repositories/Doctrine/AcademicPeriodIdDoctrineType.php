<?php

namespace ProfessorGradingApp\Infrastructure\Tutorship\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Tutorship\ValueObjects\AcademicPeriodId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class AcademicPeriodIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Tutorship\Repositories\Doctrine
 */
final class AcademicPeriodIdDoctrineType extends UuidType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'tutorship_academic_period_id';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return AcademicPeriodId::class;
    }
}
