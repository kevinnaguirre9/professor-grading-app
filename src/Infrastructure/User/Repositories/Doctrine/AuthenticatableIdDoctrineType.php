<?php

namespace ProfessorGradingApp\Infrastructure\User\Repositories\Doctrine;

use ProfessorGradingApp\Domain\User\ValueObjects\AuthenticatableId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class AuthenticatableIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\User\Repositories\Doctrine
 */
final class AuthenticatableIdDoctrineType extends UuidType
{
    /**
     * @inheritdoc
     */
    public static function customTypeName(): string
    {
        return 'authenticatable_id';
    }

    /**
     * @inheritdoc
     */
    public function customTypeClassName(): string
    {
        return AuthenticatableId::class;
    }
}
