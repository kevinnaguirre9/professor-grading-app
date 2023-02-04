<?php

namespace ProfessorGradingApp\Application\Grade\Register;

/**
 * Class RegisterGradeCommand
 *
 * @package ProfessorGradingApp\Application\Grade\Register
 */
final class RegisterGradeCommand
{
    /**
     * @param string $academicPeriodId
     * @param string $classId
     * @param string $studentId
     * @param string $rating
     * @param string|null $comment
     */
    public function __construct(
        private readonly string $academicPeriodId,
        private readonly string $classId,
        private readonly string $studentId,
        private readonly string $rating,
        private readonly ?string $comment = null
    ) {
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
    public function classId(): string
    {
        return $this->classId;
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
    public function rating(): string
    {
        return $this->rating;
    }

    /**
     * @return string|null
     */
    public function comment(): ?string
    {
        return $this->comment;
    }
}
