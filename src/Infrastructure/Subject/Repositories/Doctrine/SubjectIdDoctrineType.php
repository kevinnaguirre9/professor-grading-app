<?php

namespace ProfessorGradingApp\Infrastructure\Subject\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Subject\ValueObjects\SubjectId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class SubjectIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Subject\Repositories\Doctrine
 */
final class SubjectIdDoctrineType extends UuidType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'subject_id';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return SubjectId::class;
    }
}
