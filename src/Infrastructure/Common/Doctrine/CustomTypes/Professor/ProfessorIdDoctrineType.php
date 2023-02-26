<?php

namespace ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\Professor;

use ProfessorGradingApp\Domain\Common\ValueObjects\Professor\ProfessorId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class ProfessorIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\Professor
 */
final class ProfessorIdDoctrineType extends UuidType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'professor_id';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return ProfessorId::class;
    }
}
