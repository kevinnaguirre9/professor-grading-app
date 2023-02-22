<?php

namespace ProfessorGradingApp\Infrastructure\Degree\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Degree\ValueObjects\DegreeId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class DegreeIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Degree\Repositories\Doctrine
 */
final class DegreeIdDoctrineType extends UuidType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'degree_id';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return DegreeId::class;
    }
}
