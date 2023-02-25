<?php

namespace ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\Grade;

use ProfessorGradingApp\Domain\Common\ValueObjects\Grade\GradeId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidCollectionType;

/**
 * Class GradeIdsDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\Grade
 */
final class GradeIdsDoctrineType extends UuidCollectionType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'grade_ids';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return GradeId::class;
    }
}
