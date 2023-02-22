<?php

namespace ProfessorGradingApp\Infrastructure\Student\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Student\ValueObjects\DegreeId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidCollectionType;

/**
 * Class DegreeIdsDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Student\Repositories\Doctrine
 */
final class DegreeIdsDoctrineType extends UuidCollectionType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'student_degree_ids';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return DegreeId::class;
    }
}
