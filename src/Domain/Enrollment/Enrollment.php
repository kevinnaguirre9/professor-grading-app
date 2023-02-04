<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Enrollment;

use ProfessorGradingApp\Domain\Enrollment\ValueObjects\{AcademicPeriodId, ClassId, DegreeId, EnrollmentId, StudentId};

/**
 * Class Enrollment
 *
 * @package ProfessorGradingApp\Domain\Enrollment
 */
final class Enrollment
{
    /**
     * @param EnrollmentId $id
     * @param StudentId $studentId
     * @param AcademicPeriodId $academicPeriodId
     * @param ClassId[] $classIds
     * @param DegreeId $degreeId
     * @param \DateTimeImmutable $enrolledAt
     */
    public function __construct(
        private readonly EnrollmentId $id,
        private readonly StudentId $studentId,
        private readonly AcademicPeriodId $academicPeriodId,
        private array $classIds,
        private readonly DegreeId $degreeId,
        private readonly \DateTimeImmutable $enrolledAt,
    ) {
    }

    /**
     * @param EnrollmentId $id
     * @param StudentId $studentId
     * @param AcademicPeriodId $academicPeriodId
     * @param DegreeId $degreeId
     * @param ClassId[] $classIds
     * @param \DateTimeImmutable $enrolledAt
     * @return self
     */
    public static function create(
        EnrollmentId $id,
        StudentId $studentId,
        AcademicPeriodId $academicPeriodId,
        DegreeId $degreeId,
        array $classIds = [],
        \DateTimeImmutable $enrolledAt = new \DateTimeImmutable(),
    ): self {
        return new self($id, $studentId, $academicPeriodId, $classIds, $degreeId, $enrolledAt);
    }

    /**
     * @param ClassId $classId
     * @return void
     */
    public function registerClass(ClassId $classId): void
    {
        $this->classIds[] = $classId;
    }

    /**
     * @return EnrollmentId
     */
    public function id(): EnrollmentId
    {
        return $this->id;
    }

    /**
     * @return StudentId
     */
    public function studentId(): StudentId
    {
        return $this->studentId;
    }

    /**
     * @return AcademicPeriodId
     */
    public function academicPeriodId(): AcademicPeriodId
    {
        return $this->academicPeriodId;
    }

    /**
     * @return ClassId[]
     */
    public function classIds(): array
    {
        return $this->classIds;
    }

    /**
     * @return DegreeId
     */
    public function degreeId(): DegreeId
    {
        return $this->degreeId;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function enrolledAt(): \DateTimeImmutable
    {
        return $this->enrolledAt;
    }
}
