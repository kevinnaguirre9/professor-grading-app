<?php

namespace ProfessorGradingApp\Infrastructure\User\Repositories\Doctrine;

use Doctrine\ODM\MongoDB\Types\{ClosureToPHP, Type};
use ProfessorGradingApp\Domain\User\Exceptions\InvalidRole;
use ProfessorGradingApp\Domain\User\ValueObjects\Role;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Contracts\DoctrineCustomType;

/**
 * Class RoleDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\User\Repositories\Doctrine
 */
final class RoleDoctrineType extends Type implements DoctrineCustomType
{
    use ClosureToPHP;

    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'user_role';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return Role::class;
    }

    /**
     * @inheritDoc
     * @throws InvalidRole
     */
    public function convertToPHPValue($value)
    {
        return Role::fromValue($value);
    }

    /**
     * @inheritDoc
     */
    public function convertToDatabaseValue($value)
    {
        return $value instanceof Role ? $value->value() : $value;
    }
}
