<?php

namespace ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\CourseClass;

use ProfessorGradingApp\Domain\Common\ValueObjects\CourseClass\ClassId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidCollectionType;

/**
 * Class ClassIdsDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\CourseClass
 */
final class ClassIdsDoctrineType extends UuidCollectionType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'class_ids';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return ClassId::class;
    }
}
