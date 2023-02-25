<?php

namespace ProfessorGradingApp\Infrastructure\Student\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Common\ValueObjects\Enrollment\EnrollmentId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidCollectionType;

/**
 * Class EnrollmentIdsDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Student\Repositories\Doctrine
 */
final class EnrollmentIdsDoctrineType extends UuidCollectionType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'enrollment_ids';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return EnrollmentId::class;
    }
}
