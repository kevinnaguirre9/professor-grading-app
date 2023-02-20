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
     * @param AdvisorId $advisorId
     * @param SubjectId $subjectId
     * @param AcademicPeriodId $academicPeriodId
     * @param \DateTimeImmutable $registeredAt
     * @param Schedule|null $schedule
     */
    public function __construct(
        private readonly TutorshipId $id,
        private readonly AdvisorId $advisorId,
        private readonly SubjectId $subjectId,
        private readonly AcademicPeriodId $academicPeriodId,
        private ?Schedule $schedule,
        private readonly \DateTimeImmutable $registeredAt,
    ) {
    }

    /**
     * @param TutorshipId $id
     * @param AdvisorId $advisorId
     * @param SubjectId $subjectId
     * @param AcademicPeriodId $academicPeriodId
     * @param \DateTimeImmutable $registeredAt
     * @param Schedule|null $schedule
     * @return self
     */
    public static function create(
        TutorshipId $id,
        AdvisorId $advisorId,
        SubjectId $subjectId,
        AcademicPeriodId $academicPeriodId,
        Schedule $schedule = null,
        \DateTimeImmutable $registeredAt = new \DateTimeImmutable(),
    ): self {
        return new self($id, $advisorId, $subjectId, $academicPeriodId, $schedule, $registeredAt);
    }

    /**
     * @return bool|null
     */
    public function isInProgress(): bool|null
    {
        return $this->schedule()?->isInProgress();
    }

    /**
     * @return TutorshipId
     */
    public function id(): TutorshipId
    {
        return $this->id;
    }

    /**
     * @return Schedule|null
     */
    public function schedule(): ?Schedule
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
