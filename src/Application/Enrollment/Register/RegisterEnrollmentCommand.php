<?php

namespace ProfessorGradingApp\Application\Enrollment\Register;

/**
 * Class RegisterEnrollmentCommand
 *
 * @package ProfessorGradingApp\Application\Enrollment\Register
 */
final class RegisterEnrollmentCommand
{
    /**
     * @param string $studentId
     * @param string $academicPeriodId
     * @param string $degreeId
     * @param array $classIds
     */
    public function __construct(
        private readonly string $studentId,
        private readonly string $academicPeriodId,
        private readonly string $degreeId,
        private readonly array $classIds = [],
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
    public function academicPeriodId(): string
    {
        return $this->academicPeriodId;
    }

    /**
     * @return string
     */
    public function degreeId(): string
    {
        return $this->degreeId;
    }

    /**
     * @return array
     */
    public function classIds(): array
    {
        return $this->classIds;
    }
}
