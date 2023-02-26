<?php

namespace ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes;

use ProfessorGradingApp\Domain\Common\ValueObjects\ScheduleId;

/**
 * Class ScheduleIdDoctrineType
 *
 * @package ProfessorGradingApp\Infrastructure\Common\Doctrine\CustomTypes
 */
final class ScheduleIdDoctrineType extends UuidType
{
    /**
     * @inheritDoc
     */
    public static function customTypeName(): string
    {
        return 'schedule_id';
    }

    /**
     * @inheritDoc
     */
    public function customTypeClassName(): string
    {
        return ScheduleId::class;
    }
}
