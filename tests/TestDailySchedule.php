<?php

namespace Tests;

use Carbon\CarbonImmutable;
use ProfessorGradingApp\Domain\Common\Exceptions\InvalidTime;
use ProfessorGradingApp\Domain\Common\ValueObjects\{DailySchedule, Time, Weekday};

/**
 * Class TestDailySchedule
 *
 * @package Tests
 */
final class TestDailySchedule extends TestCase
{
    /**
     * @return void
     * @throws InvalidTime
     */
    public function testDailyScheduleShouldBeInProgress(): void
    {
        $timezone = env('APP_TIMEZONE');

        $now = CarbonImmutable::now($timezone);

        $nowTime = $now
            ->toTimeString('minute');

        $nowTimePlusOneHour = $now
            ->addHour()
            ->toTimeString('minute');

        $weekday = Weekday::from($now->dayOfWeekIso);

        $DailySchedule = new DailySchedule(
            new Time($nowTime),
            new Time($nowTimePlusOneHour),
            $weekday
        );

        $this->assertTrue($DailySchedule->isInProgress());
    }

    /**
     * @return void
     * @throws InvalidTime
     */
    public function testDailyScheduleShouldNotBeInProgress(): void
    {
        $timezone = env('APP_TIMEZONE');

        $now = CarbonImmutable::now($timezone);

        $nowTimePlusOneHour = $now
            ->addHour()
            ->toTimeString('minute');

        $nowTimePlusTwoHours = $now
            ->addHours(2)
            ->toTimeString('minute');

        $weekday = Weekday::from($now->dayOfWeekIso);

        $DailySchedule = new DailySchedule(
            new Time($nowTimePlusOneHour),
            new Time($nowTimePlusTwoHours),
            $weekday
        );

        $this->assertFalse($DailySchedule->isInProgress());
    }
}
