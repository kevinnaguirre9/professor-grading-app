<?php

namespace ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\CourseClass;

use ProfessorGradingApp\Domain\Common\ValueObjects\CourseClass\ClassId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class ClassIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\CourseClass
 */
final class ClassIdDoctrineType  extends UuidType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'class_id';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return ClassId::class;
    }
}
