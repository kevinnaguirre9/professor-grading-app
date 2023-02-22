<?php

namespace ProfessorGradingApp\Infrastructure\Supervisor\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Supervisor\ValueObjects\UserId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class UserIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Supervisor\Repositories\Doctrine
 */
final class UserIdDoctrineType extends UuidType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'supervisor_user_id';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return UserId::class;
    }
}
