<?php

namespace ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\Subject;

use ProfessorGradingApp\Domain\Common\ValueObjects\Subject\SubjectId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class SubjectIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\Subject
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
