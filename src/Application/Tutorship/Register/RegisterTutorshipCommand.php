<?php

namespace ProfessorGradingApp\Application\Tutorship\Register;

/**
 * Class RegisterTutorshipCommand
 *
 * @package ProfessorGradingApp\Application\Tutorship\Register
 */
final class RegisterTutorshipCommand
{
    /**
     * @param string $advisorId
     * @param string $subjectId
     * @param string $academicPeriodId
     * @param array $dailySchedules
     */
    public function __construct(
        private readonly string $advisorId,
        private readonly string $subjectId,
        private readonly string $academicPeriodId,
        private readonly array $dailySchedules = [],
    ) {
    }

    /**
     * @return string
     */
    public function advisorId(): string
    {
        return $this->advisorId;
    }

    /**
     * @return string
     */
    public function subjectId(): string
    {
        return $this->subjectId;
    }

    /**
     * @return string
     */
    public function academicPeriodId(): string
    {
        return $this->academicPeriodId;
    }

    /**
     * @return array
     */
    public function dailySchedules(): array
    {
        return $this->dailySchedules;
    }
}
