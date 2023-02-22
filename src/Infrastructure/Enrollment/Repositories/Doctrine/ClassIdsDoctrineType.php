<?php

namespace ProfessorGradingApp\Infrastructure\Enrollment\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Enrollment\ValueObjects\ClassId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidCollectionType;

/**
 * Class ClassIdsDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Enrollment\Repositories\Doctrine
 */
final class ClassIdsDoctrineType extends UuidCollectionType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'enrollment_class_ids';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return ClassId::class;
    }
}
