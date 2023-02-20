<?php

namespace Tests;

use Carbon\CarbonImmutable;
use ProfessorGradingApp\Domain\Common\Exceptions\InvalidDailyScheduleTimeRange;
use ProfessorGradingApp\Domain\Common\Exceptions\InvalidTime;
use ProfessorGradingApp\Domain\Common\ValueObjects\{DailySchedule, Time, Weekday};
use ProfessorGradingApp\Domain\Common\Exceptions\InvalidWeekdayValue;

/**
 * Class DailyScheduleTest
 *
 * @package Tests
 */
final class DailyScheduleTest extends TestCase
{
    /**
     * @return void
     * @throws InvalidDailyScheduleTimeRange
     * @throws InvalidTime
     * @throws InvalidWeekdayValue
     */
    public function testShouldThrowInvalidDailyScheduleTimeRangeException(): void
    {
        $this->expectException(InvalidDailyScheduleTimeRange::class);

        $now = CarbonImmutable::now();

        $nowTime = $now->toTimeString('minute');

        $nowTimePlusOneHour = $now
            ->addHour()
            ->toTimeString('minute');

        $weekday = Weekday::fromValue($now->dayOfWeekIso);

        new DailySchedule(
            new Time($nowTimePlusOneHour),
            new Time($nowTime),
            $weekday
        );
    }

    /**
     * @return void
     * @throws InvalidTime
     * @throws InvalidDailyScheduleTimeRange
     * @throws InvalidWeekdayValue
     */
    public function testDailyScheduleShouldBeInProgress(): void
    {
        $now = CarbonImmutable::now();

        $nowTime = $now->toTimeString('minute');

        $nowTimePlusOneHour = $now
            ->addHour()
            ->toTimeString('minute');

        $weekday = Weekday::fromValue($now->dayOfWeekIso);

        $DailySchedule = new DailySchedule(
            new Time($nowTime),
            new Time($nowTimePlusOneHour),
            $weekday
        );

        $this->assertTrue($DailySchedule->isInProgress());
    }

    /**
     * @return void
     * @throws InvalidDailyScheduleTimeRange
     * @throws InvalidTime
     * @throws InvalidWeekdayValue
     */
    public function testDailyScheduleShouldNotBeInProgress(): void
    {
        $now = CarbonImmutable::now();

        $nowTimePlusOneHour = $now
            ->addHour()
            ->toTimeString('minute');

        $nowTimePlusTwoHours = $now
            ->addHours(2)
            ->toTimeString('minute');

        $weekday = Weekday::fromValue($now->dayOfWeekIso);

        $DailySchedule = new DailySchedule(
            new Time($nowTimePlusOneHour),
            new Time($nowTimePlusTwoHours),
            $weekday
        );

        $this->assertFalse($DailySchedule->isInProgress());
    }
}
