<?php

namespace ProfessorGradingApp\Infrastructure\User\Repositories\Doctrine;

use Doctrine\ODM\MongoDB\Types\{ClosureToPHP, Type};
use ProfessorGradingApp\Domain\User\ValueObjects\UserEmail;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Contracts\DoctrineCustomType;

/**
 * Class UserEmailDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\User\Repositories\Doctrine
 */
final class UserEmailDoctrineType extends Type implements DoctrineCustomType
{
    use ClosureToPHP;

    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'user_email';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return UserEmail::class;
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
        return $value instanceof UserEmail ? $value->value() : $value;
    }
}
