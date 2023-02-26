<?php

namespace ProfessorGradingApp\Domain\Student\Events;

use ProfessorGradingApp\Domain\Common\Events\DomainEvent;
use ProfessorGradingApp\Domain\Common\Exceptions\InvalidUuid;
use ProfessorGradingApp\Domain\Student\Student;

/**
 * Class StudentRegistered
 *
 * @package ProfessorGradingApp\Domain\Student\Events
 */
final class StudentRegistered extends DomainEvent
{
    protected const NAME = 'student_registered';

    /**
     * @param string $id
     * @param string $fullName
     * @param string $personalEmail
     * @param string $institutionalEmail
     * @param string $nationalIdentificationNumber
     * @param string $mobileNumber
     * @param string $landlineNumber
     * @param string $registeredAt
     * @param string|null $eventId
     * @param string|null $firedAt
     * @throws InvalidUuid
     */
    public function __construct(
        private readonly string $id,
        private readonly string $fullName,
        private readonly string $personalEmail,
        private readonly string $institutionalEmail,
        private readonly string $nationalIdentificationNumber,
        private readonly string $mobileNumber,
        private readonly string $landlineNumber,
        private readonly string $registeredAt,
        ?string $eventId = null,
        ?string $firedAt = null,
    ) {

        parent::__construct($eventId, $firedAt);
    }

    /**
     * @param Student $student
     * @return static
     * @throws InvalidUuid
     */
    public static function fromEntity(Student $student): self
    {
        return new self(
            $student->id(),
            $student->fullName(),
            $student->personalEmail(),
            $student->institutionalEmail(),
            $student->nationalIdentificationNumber(),
            $student->mobileNumber(),
            $student->landlineNumber(),
            $student->registrationDate()->format('Y-m-d H:i:s'),
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->fullName,
            'personal_email' => $this->personalEmail,
            'institutional_email' => $this->institutionalEmail,
            'national_identification_number' => $this->nationalIdentificationNumber,
            'mobile_number' => $this->mobileNumber,
            'landline_number' => $this->landlineNumber,
            'registered_at' => $this->registeredAt,
        ];
    }
}
