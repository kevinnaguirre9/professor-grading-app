<?php

namespace ProfessorGradingApp\Infrastructure\Professor\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Professor\ValueObjects\ProfessorId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class ProfessorIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Professor\Repositories\Doctrine
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
