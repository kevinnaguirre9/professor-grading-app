<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Common\ValueObjects;

use Carbon\CarbonImmutable;
use ProfessorGradingApp\Domain\Common\Exceptions\InvalidDailyScheduleTimeRange;
use ProfessorGradingApp\Domain\Common\Exceptions\InvalidTime;
use ProfessorGradingApp\Domain\Common\Exceptions\InvalidWeekdayValue;

/**
 * Class DailySchedule
 *
 * @package ProfessorGradingApp\Domain\Common\ValueObjects
 */
final class DailySchedule
{
    /**
     * @param Time $startTime
     * @param Time $endTime
     * @param Weekday $weekday
     * @throws InvalidDailyScheduleTimeRange
     */
    public function __construct(
        private readonly Time $startTime,
        private readonly Time $endTime,
        private readonly Weekday $weekday,
    ) {
        $this->validateTimeRange();
    }

    /**
     * @param string $startTime
     * @param string $endTime
     * @param int $weekday
     * @return static
     * @throws InvalidDailyScheduleTimeRange
     * @throws InvalidTime
     * @throws InvalidWeekdayValue
     */
    public static function fromPrimitives(string $startTime, string $endTime, int $weekday): self
    {
        return new self(
            new Time($startTime),
            new Time($endTime),
            Weekday::fromValue($weekday)
        );
    }

    /**
     * @return void
     * @throws InvalidDailyScheduleTimeRange
     */
    private function validateTimeRange(): void
    {
        if ($this->startTime->value() >= $this->endTime->value())
            throw new InvalidDailyScheduleTimeRange($this->startTime, $this->endTime);
    }

    /**
     * @return Time
     */
    public function startTime(): Time
    {
        return $this->startTime;
    }

    /**
     * @return Time
     */
    public function endTime(): Time
    {
        return $this->endTime;
    }

    /**
     * @return Weekday
     */
    public function weekday(): Weekday
    {
        return $this->weekday;
    }

    /**
     * @return bool
     */
    public function isInProgress(): bool
    {
        $now = CarbonImmutable::now();

        $nowTime = $now->toTimeString('minute');

        return $now->dayOfWeekIso === $this->weekday()->value
            && $nowTime >= $this->startTime->value()
            && $nowTime <= $this->endTime->value(); //probably should be < instead of <=
    }

    /**
     * @param DailySchedule $other
     * @return bool
     */
    public function equals(DailySchedule $other): bool
    {
        return $this->weekday()->equals($other->weekday())
            && $this->startTime()->equals($other->startTime())
            && $this->endTime()->equals($other->endTime());
    }

    /**
     * @return array
     */
    public function toPrimitives(): array
    {
        return [
            'weekday' => $this->weekday()->value(),
            'start_time' => $this->startTime()->value(),
            'end_time' => $this->endTime()->value(),
        ];
    }
}
