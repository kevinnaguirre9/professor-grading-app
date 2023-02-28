<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Tutorship;

use ProfessorGradingApp\Domain\Tutorship\ValueObjects\{AdvisorId, TutorshipId};
use ProfessorGradingApp\Domain\Common\BaseEntity;
use ProfessorGradingApp\Domain\Common\Entities\Schedule;
use ProfessorGradingApp\Domain\Common\ValueObjects\AcademicPeriod\AcademicPeriodId;
use ProfessorGradingApp\Domain\Common\ValueObjects\Subject\SubjectId;

/**
 * Class Tutorship
 *
 * @package ProfessorGradingApp\Domain\Tutorship
 */
final class Tutorship extends BaseEntity
{
    /**
     * @param TutorshipId $id
     * @param AdvisorId $advisorId
     * @param SubjectId $subjectId
     * @param AcademicPeriodId $academicPeriodId
     * @param \DateTimeImmutable $registeredAt
     * @param Schedule|null $Schedule
     */
    public function __construct(
        private readonly TutorshipId $id,
        private readonly AdvisorId $advisorId,
        private readonly SubjectId $subjectId,
        private readonly AcademicPeriodId $academicPeriodId,
        private ?Schedule $Schedule,
        private readonly \DateTimeImmutable $registeredAt,
    ) {
    }

    /**
     * @param TutorshipId $id
     * @param AdvisorId $advisorId
     * @param SubjectId $subjectId
     * @param AcademicPeriodId $academicPeriodId
     * @param \DateTimeImmutable $registeredAt
     * @param Schedule|null $Schedule
     * @return self
     */
    public static function create(
        TutorshipId $id,
        AdvisorId $advisorId,
        SubjectId $subjectId,
        AcademicPeriodId $academicPeriodId,
        Schedule $Schedule = null,
        \DateTimeImmutable $registeredAt = new \DateTimeImmutable(),
    ): self {
        return new self($id, $advisorId, $subjectId, $academicPeriodId, $Schedule, $registeredAt);
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
        return $this->Schedule;
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

    public function toPrimitives(): array
    {
        return [
            'id' => (string) $this->id(),
            'advisor_id' => (string) $this->advisorId(),
            'subject_id' => (string) $this->subjectId(),
            'academic_period_id' => (string) $this->academicPeriodId(),
//            'schedule' => $this->schedule()?->toPrimitives(),
            'registered_at' => $this->registeredAt()->format('Y-m-d H:i:s'),
        ];
    }
}
