<?php

namespace ProfessorGradingApp\Application\Enrollment\RegisterClass;

/**
 * Class RegisterClassToEnrollmentCommand
 *
 * @package ProfessorGradingApp\Application\Enrollment\RegisterClass
 */
final class RegisterClassToEnrollmentCommand
{
    /**
     * @param string $enrollmentId
     * @param string $classId
     */
    public function __construct(
        private readonly string $enrollmentId,
        private readonly string $classId,
    ) {
    }

    /**
     * @return string
     */
    public function enrollmentId(): string
    {
        return $this->enrollmentId;
    }

    /**
     * @return string
     */
    public function classId(): string
    {
        return $this->classId;
    }
}
