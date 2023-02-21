<?php

namespace ProfessorGradingApp\Infrastructure\Student\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Student\ValueObjects\UserId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class UserIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Student\Repositories\Doctrine
 */
final class UserIdDoctrineType extends UuidType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'student_user_id';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return UserId::class;
    }
}
