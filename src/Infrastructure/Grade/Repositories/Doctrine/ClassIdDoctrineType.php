<?php

namespace ProfessorGradingApp\Infrastructure\Grade\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Grade\ValueObjects\ClassId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class ClassIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Grade\Repositories\Doctrine
 */
final class ClassIdDoctrineType extends UuidType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'grade_class_id';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return ClassId::class;
    }
}
