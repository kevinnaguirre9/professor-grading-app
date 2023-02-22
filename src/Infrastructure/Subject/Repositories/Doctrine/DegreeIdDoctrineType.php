<?php

namespace ProfessorGradingApp\Infrastructure\Subject\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Subject\ValueObjects\DegreeId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class DegreeIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Subject\Repositories\Doctrine
 */
final class DegreeIdDoctrineType extends UuidType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'subject_degree_id';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return DegreeId::class;
    }
}
