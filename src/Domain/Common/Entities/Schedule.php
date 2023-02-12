<?php

namespace ProfessorGradingApp\Domain\Common\Entities;

use ProfessorGradingApp\Domain\Common\ValueObjects\{DailySchedule, ScheduleId};

/**
 * Class Schedule
 *
 * @package ProfessorGradingApp\Domain\Common\Entities
 */
final class Schedule
{
    /**
     * @param ScheduleId $id
     * @param DailySchedule[] $dailySchedules
     */
    public function __construct(
        private readonly ScheduleId $id,
        private array $dailySchedules
    ) {
    }

    /**
     * @param array $dailySchedules
     * @return static
     */
    public static function fromPrimitives(array $dailySchedules): self
    {
        return new self(
            new ScheduleId(),
            array_map(self::dailyScheduleBuilder(), array_unique($dailySchedules, SORT_REGULAR))
        );
    }

    /**
     * @return bool
     */
    public function isInProgress(): bool
    {
        foreach ($this->dailySchedules as $dailySchedule) {
            if ($dailySchedule->isInProgress())
                return true;
        }

        return false;
    }

    /**
     * @param DailySchedule $dailySchedule
     * @return void
     */
    public function addDailySchedule(DailySchedule $dailySchedule): void
    {
        //TODO: check if the daily schedule is already in the list

        $this->dailySchedules[] = $dailySchedule;
    }

    /**
     * @return ScheduleId
     */
    public function id(): ScheduleId
    {
        return $this->id;
    }

    /**
     * @return DailySchedule[]
     */
    public function getDailySchedules(): array
    {
        return $this->dailySchedules;
    }

    /**
     * @return \Closure
     */
    public static function dailyScheduleBuilder(): \Closure
    {
        return fn(array $dailySchedule): DailySchedule => DailySchedule::fromPrimitives(
            $dailySchedule['start_time'],
            $dailySchedule['end_time'],
            $dailySchedule['weekday']
        );
    }
}
