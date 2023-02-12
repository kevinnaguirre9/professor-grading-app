<?php

namespace ProfessorGradingApp\Domain\Common\Exceptions;

use ProfessorGradingApp\Domain\Common\ValueObjects\Time;

/**
 * Class InvalidDailyScheduleTimeRange
 *
 * @package ProfessorGradingApp\Domain\Common\Exceptions
 */
final class InvalidDailyScheduleTimeRange extends AbstractCoreException
{
    protected const ERROR_TYPE = 'invalid_daily_schedule_time_range';

    private string $errorDetail;

    /**
     * @param Time $startTime
     * @param Time $endTime
     */
    public function __construct(Time $startTime, Time $endTime)
    {
        $this->errorDetail = sprintf(
            'Start time %s must be before end time %s',
            $startTime->value(),
            $endTime->value(),
        );

        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        return 'Cannot create daily schedule';
    }

    /**
     * @inheritDoc
     */
    public function detail(): string
    {
        return $this->errorDetail;
    }
}
