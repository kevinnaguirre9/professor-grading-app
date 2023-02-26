<?php

namespace ProfessorGradingApp\Domain\ClassInspectionRequest;

use ProfessorGradingApp\Domain\ClassInspectionRequest\Exceptions\ClassInspectionRequestAlreadyInspected;
use ProfessorGradingApp\Domain\ClassInspectionRequest\Exceptions\ClassInspectionRequestNotApproved;
use ProfessorGradingApp\Domain\ClassInspectionRequest\ValueObjects\ClassInspectionRequestId;
use ProfessorGradingApp\Domain\ClassInspectionRequest\ValueObjects\ClassInspectionRequestStatus;
use ProfessorGradingApp\Domain\Common\BaseEntity;
use ProfessorGradingApp\Domain\Common\ValueObjects\AcademicPeriod\AcademicPeriodId;
use ProfessorGradingApp\Domain\Common\ValueObjects\CourseClass\ClassId;
use ProfessorGradingApp\Domain\Common\ValueObjects\Student\StudentId;

/**
 * Class ClassInspectionRequest
 *
 * @package ProfessorGradingApp\Domain\ClassInspectionRequest
 */
final class ClassInspectionRequest extends BaseEntity
{
    /**
     * @param ClassInspectionRequestId $id
     * @param string $reason
     * @param string $description
     * @param AcademicPeriodId $academicPeriodId
     * @param ClassInspectionRequestStatus $status
     * @param ClassId $classId
     * @param StudentId $studentId
     * @param \DateTimeImmutable $requestedAt
     */
    public function __construct(
        private readonly ClassInspectionRequestId $id,
        private readonly string $reason,
        private readonly string $description,
        private readonly AcademicPeriodId $academicPeriodId,
        private ClassInspectionRequestStatus $status,
        private readonly ClassId $classId,
        private readonly StudentId $studentId,
        private readonly \DateTimeImmutable $requestedAt,
    ) {
    }

    /**
     * @param ClassInspectionRequestId $id
     * @param string $reason
     * @param string $description
     * @param AcademicPeriodId $academicPeriodId
     * @param ClassId $classId
     * @param StudentId $studentId
     * @param \DateTimeImmutable $requestedAt
     * @return self
     */
    public static function create(
        ClassInspectionRequestId $id,
        string $reason,
        string $description,
        AcademicPeriodId $academicPeriodId,
        ClassId $classId,
        StudentId $studentId,
        \DateTimeImmutable $requestedAt = new \DateTimeImmutable(),
    ): self {
        return new self(
            $id,
            $reason,
            $description,
            $academicPeriodId,
            ClassInspectionRequestStatus::PENDING,
            $classId,
            $studentId,
            $requestedAt,
        );
    }

    /**
     * @return void
     * @throws ClassInspectionRequestAlreadyInspected
     */
    public function approve(): void
    {
        if ($this->isInspected()) {
            throw new ClassInspectionRequestAlreadyInspected(
                ClassInspectionRequestStatus::APPROVED
            );
        }

        $this->status = ClassInspectionRequestStatus::APPROVED;
    }

    /**
     * @return void
     * @throws ClassInspectionRequestAlreadyInspected
     */
    public function reject(): void
    {
        if ($this->isInspected()) {
            throw new ClassInspectionRequestAlreadyInspected(
                ClassInspectionRequestStatus::REJECTED
            );
        }

        $this->status = ClassInspectionRequestStatus::REJECTED;
    }

    /**
     * @return void
     * @throws ClassInspectionRequestNotApproved
     */
    public function inspect(): void
    {
        if(! $this->isApproved()) {
            throw new ClassInspectionRequestNotApproved($this->status());
        }

        $this->status = ClassInspectionRequestStatus::INSPECTED;
    }

    /**
     * @return bool
     */
    public function isPending(): bool
    {
        return $this->status->isPending();
    }

    /**
     * @return bool
     */
    public function isApproved(): bool
    {
        return $this->status->isApproved();
    }

    /**
     * @return bool
     */
    public function isRejected(): bool
    {
        return $this->status->isRejected();
    }

    /**
     * @return bool
     */
    public function isInspected(): bool
    {
        return $this->status->isInspected();
    }

    /**
     * @return ClassInspectionRequestStatus
     */
    public function status(): ClassInspectionRequestStatus
    {
        return $this->status;
    }

    /**
     * @return ClassInspectionRequestId
     */
    public function id(): ClassInspectionRequestId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function reason(): string
    {
        return $this->reason;
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return $this->description;
    }

    /**
     * @return AcademicPeriodId
     */
    public function academicPeriodId(): AcademicPeriodId
    {
        return $this->academicPeriodId;
    }

    /**
     * @return ClassId
     */
    public function classId(): ClassId
    {
        return $this->classId;
    }

    /**
     * @return StudentId
     */
    public function studentId(): StudentId
    {
        return $this->studentId;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function requestedAt(): \DateTimeImmutable
    {
        return $this->requestedAt;
    }
}
