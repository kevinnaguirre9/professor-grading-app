<?php

namespace ProfessorGradingApp\Infrastructure\User\Repositories\Doctrine;

use Doctrine\ODM\MongoDB\Types\{ClosureToPHP, Type};
use ProfessorGradingApp\Domain\User\ValueObjects\UserPassword;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Contracts\DoctrineCustomType;

/**
 * Class UserPasswordDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\User\Repositories\Doctrine
 */
final class UserPasswordDoctrineType extends Type implements DoctrineCustomType
{
    use ClosureToPHP;

    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'user_password';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return UserPassword::class;
    }

    /**
     * @inheritDoc
     */
    public function convertToPHPValue($value)
    {
        $classname = $this->customTypeClassName();

        return new $classname($value);
    }

    /**
     * @inheritDoc
     */
    public function convertToDatabaseValue($value)
    {
        return $value instanceof UserPassword ? $value->value() : $value;
    }
}
