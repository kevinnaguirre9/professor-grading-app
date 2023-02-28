<?php

namespace ProfessorGradingApp\Infrastructure\Tutorship\Repositories\Doctrine;

use ProfessorGradingApp\Domain\Tutorship\ValueObjects\TutorshipId;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes\UuidType;

/**
 * Class TutorshipIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Tutorship\Repositories\Doctrine
 */
final class TutorshipIdDoctrineType extends UuidType
{
    /**
     * @inheritdoc
     */
    public static function customTypeName(): string
    {
        return 'tutorship_id';
    }

    /**
     * @inheritdoc
     */
    public function customTypeClassName(): string
    {
        return TutorshipId::class;
    }
}
