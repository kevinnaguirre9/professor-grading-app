<?php

namespace ProfessorGradingApp\Domain\CourseClass;

use ProfessorGradingApp\Domain\Common\BaseEntity;
use ProfessorGradingApp\Domain\Common\Entities\Schedule;
use ProfessorGradingApp\Domain\CourseClass\Exceptions\ProfessorAlreadyAssignedToClass;
use ProfessorGradingApp\Domain\CourseClass\ValueObjects\{
    AcademicPeriodId,
    ClassId,
    DegreeId,
    GradeId,
    ProfessorId,
    StudentId,
    SubjectId,
};

/**
 * Class CourseClass
 *
 * @package ProfessorGradingApp\Domain\CourseClass
 */
final class CourseClass extends BaseEntity
{
    /**
     * @param ClassId $id
     * @param string $groupSection
     * @param Schedule $Schedule
     * @param AcademicPeriodId $academicPeriodId
     * @param SubjectId $subjectId
     * @param ProfessorId $professorId
     * @param DegreeId[] $degreeIds
     * @param StudentId[] $studentIds
     * @param GradeId[] $gradeIds
     * @param \DateTimeImmutable $registeredAt
     */
    public function __construct(
        private readonly ClassId $id,
        private readonly string $groupSection,
        private Schedule $Schedule,
        private readonly AcademicPeriodId $academicPeriodId,
        private readonly SubjectId $subjectId,
        private ProfessorId $professorId,
        private array $degreeIds,
        private array $studentIds,
        private array $gradeIds,
        private readonly \DateTimeImmutable $registeredAt,
    ) {
    }

    /**
     * @param ClassId $id
     * @param string $groupSection
     * @param Schedule $Schedule
     * @param AcademicPeriodId $academicPeriodId
     * @param SubjectId $subjectId
     * @param ProfessorId $professorId
     * @param DegreeId[] $degreeIds
     * @param StudentId[] $studentIds
     * @param GradeId[] $gradeIds
     * @param \DateTimeImmutable $registeredAt
     * @return CourseClass
     */
    public static function create(
        ClassId $id,
        string $groupSection,
        Schedule $Schedule,
        AcademicPeriodId $academicPeriodId,
        SubjectId $subjectId,
        ProfessorId $professorId,
        array $degreeIds,
        array $studentIds = [],
        array $gradeIds = [],
        \DateTimeImmutable $registeredAt = new \DateTimeImmutable(),
    ): self {
        return new self(
            $id,
            $groupSection,
            $Schedule,
            $academicPeriodId,
            $subjectId,
            $professorId,
            $degreeIds,
            $studentIds,
            $gradeIds,
            $registeredAt,
        );
    }

    /**
     * @param StudentId $studentId
     * @return void
     */
    public function registerStudent(StudentId $studentId): void
    {
        foreach ($this->studentIds() as $student) {
            if($student->equals($studentId))
                return;
        }

        $this->studentIds[] = $studentId;
    }

    /**
     * @param ProfessorId $professorId
     * @return void
     * @throws ProfessorAlreadyAssignedToClass
     */
    public function reassignProfessor(ProfessorId $professorId): void
    {
        if($this->professorId()->equals($professorId))
            throw new ProfessorAlreadyAssignedToClass($this->classId, $professorId);

        $this->professorId = $professorId;
    }

    /**
     * @param GradeId $gradeId
     * @return void
     */
    public function registerGrade(GradeId $gradeId): void
    {
        foreach ($this->gradeIds() as $grade) {
            if($grade->equals($gradeId))
                return;
        }

        $this->gradeIds[] = $gradeId;
    }

    /**
     * @return bool
     */
    public function isInProgress(): bool
    {
        return $this->schedule()->isInProgress();
    }

    /**
     * @return ClassId
     */
    public function id(): ClassId
    {
        return $this->id;
    }

    /**
     * @return SubjectId
     */
    public function subjectId(): SubjectId
    {
        return $this->subjectId;
    }

    /**
     * @return ProfessorId
     */
    public function professorId(): ProfessorId
    {
        return $this->professorId;
    }

    /**
     * @return Schedule
     */
    public function schedule(): Schedule
    {
        return $this->Schedule;
    }

    /**
     * @return string
     */
    public function groupSection(): string
    {
        return $this->groupSection;
    }

    /**
     * @return AcademicPeriodId
     */
    public function academicPeriodId(): AcademicPeriodId
    {
        return $this->academicPeriodId;
    }

    /**
     * @return DegreeId[]
     */
    public function degreeIds(): array
    {
        return $this->degreeIds;
    }

    /**
     * @return GradeId[]
     */
    public function gradeIds(): array
    {
        return $this->gradeIds;
    }

    /**
     * @return StudentId[]
     */
    public function studentIds(): array
    {
        return $this->studentIds;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function registeredAt(): \DateTimeImmutable
    {
        return $this->registeredAt;
    }
}
