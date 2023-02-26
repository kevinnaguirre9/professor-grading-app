<?php

namespace ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\User;

use ProfessorGradingApp\Domain\Common\ValueObjects\User\UserId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class UserIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\User
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
