<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Tutorship;

use ProfessorGradingApp\Domain\Tutorship\ValueObjects\{AcademicPeriodId, AdvisorId, SubjectId, TutorshipId};
use ProfessorGradingApp\Domain\Common\Entities\Schedule;

/**
 * Class Tutorship
 *
 * @package ProfessorGradingApp\Domain\Tutorship
 */
final class Tutorship
{
    /**
     * @param TutorshipId $id
     * @param Schedule $schedule
     * @param AdvisorId $advisorId
     * @param SubjectId $subjectId
     * @param AcademicPeriodId $academicPeriodId
     * @param \DateTimeImmutable $registeredAt
     */
    public function __construct(
        private readonly TutorshipId $id,
        private Schedule $schedule,
        private readonly AdvisorId $advisorId,
        private readonly SubjectId $subjectId,
        private readonly AcademicPeriodId $academicPeriodId,
        private readonly \DateTimeImmutable $registeredAt,
    ) {
    }

    /**
     * @param TutorshipId $id
     * @param Schedule $schedule
     * @param AdvisorId $advisorId
     * @param SubjectId $subjectId
     * @param AcademicPeriodId $academicPeriodId
     * @param \DateTimeImmutable $registeredAt
     * @return self
     */
    public static function create(
        TutorshipId $id,
        Schedule $schedule,
        AdvisorId $advisorId,
        SubjectId $subjectId,
        AcademicPeriodId $academicPeriodId,
        \DateTimeImmutable $registeredAt,
    ): self {
        return new self($id, $schedule, $advisorId, $subjectId, $academicPeriodId, $registeredAt);
    }

    /**
     * @return TutorshipId
     */
    public function id(): TutorshipId
    {
        return $this->id;
    }

    /**
     * @return Schedule
     */
    public function schedule(): Schedule
    {
        return $this->schedule;
    }

    /**
     * @return AdvisorId
     */
    public function advisorId(): AdvisorId
    {
        return $this->advisorId;
    }

    /**
     * @return SubjectId
     */
    public function subjectId(): SubjectId
    {
        return $this->subjectId;
    }

    /**
     * @return AcademicPeriodId
     */
    public function academicPeriodId(): AcademicPeriodId
    {
        return $this->academicPeriodId;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function registeredAt(): \DateTimeImmutable
    {
        return $this->registeredAt;
    }
}
