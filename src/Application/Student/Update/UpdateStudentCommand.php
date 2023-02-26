<?php

namespace ProfessorGradingApp\Application\Student\Update;

use ProfessorGradingApp\Domain\Common\Contracts\Bus\Command\Command;

/**
 * Class UpdateStudentCommand
 *
 * @package ProfessorGradingApp\Application\Student\Update
 */
final class UpdateStudentCommand implements Command
{
    /**
     * @param string $studentId
     * @param string $userId
     */
    public function __construct(
        private readonly string $studentId,
        private readonly string $userId,
    ) {
    }

    /**
     * @return string
     */
    public function studentId(): string
    {
        return $this->studentId;
    }

    /**
     * @return string
     */
    public function userId(): string
    {
        return $this->userId;
    }
}
