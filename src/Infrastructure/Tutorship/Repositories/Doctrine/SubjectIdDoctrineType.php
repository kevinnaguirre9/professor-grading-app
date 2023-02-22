<?php

namespace ProfessorGradingApp\Infrastructure\Tutorship\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Tutorship\ValueObjects\SubjectId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class SubjectIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Tutorship\Repositories\Doctrine
 */
final class SubjectIdDoctrineType extends UuidType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'tutorship_subject_id';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return SubjectId::class;
    }
}
