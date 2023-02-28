<?php

namespace ProfessorGradingApp\Application\Tutorship\Register;

use ProfessorGradingApp\Domain\Common\Contracts\Bus\Command\Command;

/**
 * Class RegisterTutorshipCommand
 *
 * @package ProfessorGradingApp\Application\Tutorship\Register
 */
final class RegisterTutorshipCommand implements Command
{
    /**
     * @param string $advisorId
     * @param string $subjectId
     * @param array $dailySchedules
     */
    public function __construct(
        private readonly string $advisorId,
        private readonly string $subjectId,
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
     * @return array
     */
    public function dailySchedules(): array
    {
        return $this->dailySchedules;
    }
}
