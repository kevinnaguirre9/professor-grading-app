<?php

namespace ProfessorGradingApp\Infrastructure\Professor\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Professor\ValueObjects\DegreeId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidCollectionType;

/**
 * Class DegreeIdsDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Professor\Repositories\Doctrine
 */
final class DegreeIdsDoctrineType extends UuidCollectionType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'professor_degree_ids';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return DegreeId::class;
    }
}
