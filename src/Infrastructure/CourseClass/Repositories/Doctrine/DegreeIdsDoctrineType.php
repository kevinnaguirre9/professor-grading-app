<?php

namespace ProfessorGradingApp\Infrastructure\CourseClass\Repositories\Doctrine;

use ProfessorGradingApp\Domain\CourseClass\ValueObjects\DegreeId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidCollectionType;

/**
 * Class DegreeIdsDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\CourseClass\Repositories\Doctrine
 */
final class DegreeIdsDoctrineType extends UuidCollectionType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'class_degree_ids';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return DegreeId::class;
    }
}
