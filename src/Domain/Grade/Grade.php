<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Grade;

use ProfessorGradingApp\Domain\Common\BaseEntity;
use ProfessorGradingApp\Domain\Grade\ValueObjects\{AcademicPeriodId, ClassId, GradeId, Rating, StudentId};

/**
 * Class Grade
 *
 * @package ProfessorGradingApp\Domain\Grade
 */
final class Grade extends BaseEntity
{
    /**
     * @param GradeId $id
     * @param AcademicPeriodId $academicPeriodId
     * @param ClassId $classId
     * @param StudentId $studentId
     * @param Rating $rating
     * @param string|null $comment
     * @param \DateTimeImmutable $gradedAt
     */
    public function __construct(
        private readonly GradeId $id,
        private readonly AcademicPeriodId $academicPeriodId,
        private readonly ClassId $classId,
        private readonly StudentId $studentId,
        private readonly Rating $rating,
        private readonly ?string $comment,
        private readonly \DateTimeImmutable $gradedAt
    ) {
    }

    /**
     * @param GradeId $id
     * @param AcademicPeriodId $academicPeriodId
     * @param ClassId $classId
     * @param StudentId $studentId
     * @param Rating $rating
     * @param string|null $comment
     * @return self
     */
    public static function create(
        GradeId $id,
        AcademicPeriodId $academicPeriodId,
        ClassId $classId,
        StudentId $studentId,
        Rating $rating,
        ?string $comment = null,
    ): self {
        return new self(
            $id,
            $academicPeriodId,
            $classId,
            $studentId,
            $rating,
            $comment,
            new \DateTimeImmutable()
        );
    }

    /**
     * @return GradeId
     */
    public function id(): GradeId
    {
        return $this->id;
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
     * @return Rating
     */
    public function rating(): Rating
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

    /**
     * @return \DateTimeImmutable
     */
    public function gradedAt(): \DateTimeImmutable
    {
        return $this->gradedAt;
    }
}
