<?php

namespace ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\Degree;

use ProfessorGradingApp\Domain\Common\ValueObjects\Degree\DegreeId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class DegreeIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\Degree
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
