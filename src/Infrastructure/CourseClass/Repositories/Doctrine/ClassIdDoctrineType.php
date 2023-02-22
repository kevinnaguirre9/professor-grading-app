<?php

namespace ProfessorGradingApp\Infrastructure\CourseClass\Repositories\Doctrine;

use ProfessorGradingApp\Domain\CourseClass\ValueObjects\ClassId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class ClassIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\CourseClass\Repositories\Doctrine
 */
final class ClassIdDoctrineType extends UuidType
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
