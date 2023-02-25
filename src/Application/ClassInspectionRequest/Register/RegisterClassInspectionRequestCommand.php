<?php

namespace ProfessorGradingApp\Application\ClassInspectionRequest\Register;

use ProfessorGradingApp\Domain\Common\Contracts\Bus\Command\Command;

/**
 * Class RegisterClassInspectionRequestCommand
 *
 * @package ProfessorGradingApp\Application\ClassInspectionRequest\Register
 */
final class RegisterClassInspectionRequestCommand implements Command
{
    /**
     * @param string $reason
     * @param string $description
     * @param string $classId
     * @param string $studentId
     */
    public function __construct(
        private readonly string $reason,
        private readonly string $description,
        private readonly string $classId,
        private readonly string $studentId,
    ) {
    }

    public function reason(): string
    {
        return $this->reason;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function classId(): string
    {
        return $this->classId;
    }

    public function studentId(): string
    {
        return $this->studentId;
    }
}
