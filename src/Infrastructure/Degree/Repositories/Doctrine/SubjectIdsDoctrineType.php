<?php

namespace ProfessorGradingApp\Infrastructure\Degree\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Common\ValueObjects\Subject\SubjectId;
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
        return 'subject_ids';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return SubjectId::class;
    }
}
