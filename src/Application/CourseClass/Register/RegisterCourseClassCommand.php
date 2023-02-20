<?php

namespace ProfessorGradingApp\Application\CourseClass\Register;

/**
 * Class RegisterCourseClassCommand
 *
 * @package ProfessorGradingApp\Application\CourseClass\Register
 */
final class RegisterCourseClassCommand
{
    /**
     * @param string $groupSection
     * @param array $dailySchedules
     * @param string $academicPeriodId
     * @param string $subjectId
     * @param string $professorId
     * @param array $degreeIds
     * @param array $studentIds
     * @param array $gradeIds
     */
    public function __construct(
        private readonly string $groupSection,
        private readonly array $dailySchedules,
        private readonly string $academicPeriodId,
        private readonly string $subjectId,
        private readonly string $professorId,
        private readonly array $degreeIds,
        private readonly array $studentIds = [],
        private readonly array $gradeIds = [],
    ) {
    }

    /**
     * @return string
     */
    public function groupSection(): string
    {
        return $this->groupSection;
    }

    /**
     * @return array
     */
    public function dailySchedules(): array
    {
        return $this->dailySchedules;
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
    public function subjectId(): string
    {
        return $this->subjectId;
    }

    /**
     * @return string
     */
    public function professorId(): string
    {
        return $this->professorId;
    }

    /**
     * @return array
     */
    public function degreeIds(): array
    {
        return $this->degreeIds;
    }

    /**
     * @return array
     */
    public function studentIds(): array
    {
        return $this->studentIds;
    }

    /**
     * @return array
     */
    public function gradeIds(): array
    {
        return $this->gradeIds;
    }
}
