<?php

namespace ProfessorGradingApp\Infrastructure\ClassInspectionRequest\Repositories\Doctrine;

use ProfessorGradingApp\Domain\ClassInspectionRequest\ValueObjects\ClassInspectionRequestId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class ClassInspectionRequestIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\ClassInspectionRequest\Repositories\Doctrine
 */
final class ClassInspectionRequestIdDoctrineType extends UuidType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'class_inspection_request_id';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return ClassInspectionRequestId::class;
    }
}
