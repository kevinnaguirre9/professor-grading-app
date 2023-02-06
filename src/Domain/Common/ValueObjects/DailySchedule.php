<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Common\ValueObjects;

use Carbon\CarbonImmutable;
use ProfessorGradingApp\Domain\Common\Exceptions\InvalidTime;

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
     */
    public function __construct(
        private readonly Time $startTime,
        private readonly Time $endTime,
        private readonly Weekday $weekday,
    ) {
    }

    /**
     * @param string $startTime
     * @param string $endTime
     * @param int $weekday
     * @return self
     * @throws InvalidTime
     */
    public static function fromPrimitives(string $startTime, string $endTime, int $weekday): self
    {
        return new self(
            new Time($startTime),
            new Time($endTime),
            Weekday::from($weekday)
        );
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
        $now = CarbonImmutable::now(getenv('APP_TIMEZONE'));

        $nowTime = $now->toTimeString('minute');

        return $now->dayOfWeekIso === $this->weekday()->value
            && $nowTime >= $this->startTime->value()
            && $nowTime <= $this->endTime->value();
    }

    public function equals(DailySchedule $other): bool
    {
        return $this->weekday()->value === $other->weekday()->value
            && $this->startTime()->equals($other->startTime())
            && $this->endTime()->equals($other->endTime());
    }
}
