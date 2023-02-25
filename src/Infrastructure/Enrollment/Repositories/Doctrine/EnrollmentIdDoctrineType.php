<?php

namespace ProfessorGradingApp\Infrastructure\Enrollment\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Common\ValueObjects\Enrollment\EnrollmentId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class EnrollmentIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Enrollment\Repositories\Doctrine
 */
final class EnrollmentIdDoctrineType extends UuidType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'enrollment_id';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return EnrollmentId::class;
    }
}
