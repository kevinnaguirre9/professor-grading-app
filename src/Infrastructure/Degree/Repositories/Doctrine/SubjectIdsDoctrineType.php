<?php

namespace ProfessorGradingApp\Infrastructure\Degree\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Degree\ValueObjects\SubjectId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidCollectionType;

/**
 * Class SubjectIdsDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Degree\Repositories\Doctrine
 */
final class SubjectIdsDoctrineType extends UuidCollectionType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'degree_subject_ids';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return SubjectId::class;
    }
}
