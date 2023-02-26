<?php

namespace ProfessorGradingApp\Infrastructure\Tutorship\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Tutorship\ValueObjects\AdvisorId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class AdvisorIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Tutorship\Repositories\Doctrine
 */
final class AdvisorIdDoctrineType extends UuidType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'tutorship_advisor_id';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return AdvisorId::class;
    }
}
