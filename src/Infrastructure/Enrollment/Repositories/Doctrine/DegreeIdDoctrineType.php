<?php

namespace ProfessorGradingApp\Infrastructure\Enrollment\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Enrollment\ValueObjects\DegreeId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class DegreeIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Enrollment\Repositories\Doctrine
 */
final class DegreeIdDoctrineType extends UuidType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'enrollment_degree_id';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return DegreeId::class;
    }
}
