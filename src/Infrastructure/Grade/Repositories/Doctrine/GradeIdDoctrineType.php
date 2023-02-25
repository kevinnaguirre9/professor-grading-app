<?php

namespace ProfessorGradingApp\Infrastructure\Grade\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Common\ValueObjects\Grade\GradeId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class GradeIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Grade\Repositories\Doctrine
 */
final class GradeIdDoctrineType extends UuidType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'grade_id';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return GradeId::class;
    }
}
