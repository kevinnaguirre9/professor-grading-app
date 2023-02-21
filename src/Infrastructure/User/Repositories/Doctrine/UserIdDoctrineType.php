<?php

namespace ProfessorGradingApp\Infrastructure\User\Repositories\Doctrine;

use ProfessorGradingApp\Domain\User\ValueObjects\UserId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class UserIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\User\Repositories\Doctrine
 */
final class UserIdDoctrineType extends UuidType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'user_id';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return UserId::class;
    }
}
