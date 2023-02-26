<?php

namespace ProfessorGradingApp\Infrastructure\Supervisor\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Supervisor\ValueObjects\SupervisorId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class SupervisorIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Supervisor\Repositories\Doctrine
 */
final class SupervisorIdDoctrineType extends UuidType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'supervisor_id';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return SupervisorId::class;
    }
}
