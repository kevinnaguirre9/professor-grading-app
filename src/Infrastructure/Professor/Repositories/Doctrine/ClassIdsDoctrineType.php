<?php

namespace ProfessorGradingApp\Infrastructure\Professor\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Professor\ValueObjects\ClassId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidCollectionType;

/**
 * Class ClassIdsDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Professor\Repositories\Doctrine
 */
final class ClassIdsDoctrineType extends UuidCollectionType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'professor_class_ids';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return ClassId::class;
    }
}
