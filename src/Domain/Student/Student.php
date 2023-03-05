<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Student;

use ProfessorGradingApp\Domain\Common\BaseEntity;
use ProfessorGradingApp\Domain\Common\Exceptions\InvalidUuid;
use ProfessorGradingApp\Domain\Common\ValueObjects\Degree\DegreeId;
use ProfessorGradingApp\Domain\Common\ValueObjects\Enrollment\EnrollmentId;
use ProfessorGradingApp\Domain\Common\ValueObjects\Grade\GradeId;
use ProfessorGradingApp\Domain\Common\ValueObjects\InstitutionalEmail;
use ProfessorGradingApp\Domain\Student\ValueObjects\{
    NationalIdentificationNumber,
    PersonalEmail,
};
use ProfessorGradingApp\Domain\Common\ValueObjects\Student\StudentId;
use ProfessorGradingApp\Domain\Common\ValueObjects\User\UserId;
use ProfessorGradingApp\Domain\Student\Events\StudentRegistered;

/**
 * Class Student
 *
 * @package ProfessorGradingApp\Domain\Student
 */
final class Student extends BaseEntity
{
    /**
     * @param StudentId $id
     * @param string $fullName
     * @param InstitutionalEmail $institutionalEmail
     * @param NationalIdentificationNumber $nationalIdentificationNumber
     * @param array $degreeIds
     * @param array $enrollmentIds
     * @param array $gradeIds
     * @param \DateTimeImmutable $registeredAt
     * @param PersonalEmail|null $personalEmail
     * @param UserId|null $userId
     * @param string|null $mobileNumber
     * @param string|null $landlineNumber
     */
    public function __construct(
        private readonly StudentId $id,
        private string $fullName,
        private readonly InstitutionalEmail $institutionalEmail,
        private NationalIdentificationNumber $nationalIdentificationNumber,
        private array $degreeIds,
        private array $enrollmentIds,
        private array $gradeIds,
        private readonly \DateTimeImmutable $registeredAt,
        private ?PersonalEmail $personalEmail,
        private ?UserId $userId,
        private ?string $mobileNumber,
        private ?string $landlineNumber,
    ) {
    }

    /**
     * @param StudentId $id
     * @param string $fullName
     * @param PersonalEmail|null $personalEmail
     * @param InstitutionalEmail $institutionalEmail
     * @param NationalIdentificationNumber $nationalIdentificationNumber
     * @param array $degreeIds
     * @param array $enrollmentIds
     * @param array $gradeIds
     * @param UserId|null $userId
     * @param string|null $mobileNumber
     * @param string|null $landlineNumber
     * @param \DateTimeImmutable $registeredAt
     * @return self
     * @throws InvalidUuid
     */
    public static function create(
        StudentId $id,
        string $fullName,
        InstitutionalEmail $institutionalEmail,
        NationalIdentificationNumber $nationalIdentificationNumber,
        array $degreeIds = [],
        array $enrollmentIds = [],
        array $gradeIds = [],
        ?PersonalEmail $personalEmail = null,
        UserId $userId = null,
        ?string $mobileNumber = null,
        ?string $landlineNumber = null,
        \DateTimeImmutable $registeredAt = new \DateTimeImmutable(),
    ): self {
        $Student = new self(
            $id,
            $fullName,
            $institutionalEmail,
            $nationalIdentificationNumber,
            $degreeIds,
            $enrollmentIds,
            $gradeIds,
            $registeredAt,
            $personalEmail,
            $userId,
            $mobileNumber,
            $landlineNumber,
        );

        $Student->record(StudentRegistered::fromEntity($Student));

        return $Student;
    }

    /**
     * @param DegreeId $degreeId
     * @return void
     */
    public function registerInDegree(DegreeId $degreeId): void
    {
        $this->degreeIds[] = $degreeId;
    }

    /**
     * @param EnrollmentId $enrollmentId
     * @return void
     */
    public function enroll(EnrollmentId $enrollmentId): void
    {
        $this->enrollmentIds[] = $enrollmentId;
    }

    /**
     * @param GradeId $gradeId
     * @return void
     */
    public function gradeProfessorClass(GradeId $gradeId): void
    {
        $this->gradeIds[] = $gradeId;
    }

    /**
     * @param UserId $userId
     * @return void
     */
    public function updateUserId(UserId $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @param PersonalEmail $personalEmail
     * @return void
     */
    public function updatePersonalEmail(PersonalEmail $personalEmail): void
    {
        $this->personalEmail = $personalEmail;
    }

    /**
     * @param string $mobileNumber
     * @return void
     */
    public function updateMobileNumber(string $mobileNumber): void
    {
        $this->mobileNumber = $mobileNumber;
    }

    /**
     * @param string $landlineNumber
     * @return void
     */
    public function updateLandlineNumber(string $landlineNumber): void
    {
        $this->landlineNumber = $landlineNumber;
    }

    /**
     * @return StudentId
     */
    public function id(): StudentId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function fullName(): string
    {
        return $this->fullName;
    }

    /**
     * @return InstitutionalEmail
     */
    public function institutionalEmail(): InstitutionalEmail
    {
        return $this->institutionalEmail;
    }

    /**
     * @return PersonalEmail|null
     */
    public function personalEmail(): ?PersonalEmail
    {
        return $this->personalEmail;
    }

    /**
     * @return NationalIdentificationNumber
     */
    public function nationalIdentificationNumber(): NationalIdentificationNumber
    {
        return $this->nationalIdentificationNumber;
    }

    /**
     * @return UserId|null
     */
    public function userId(): ?UserId
    {
        return $this->userId;
    }

    /**
     * @return DegreeId[]
     */
    public function degreeIds(): array
    {
        return $this->degreeIds;
    }

    /**
     * @return EnrollmentId[]
     */
    public function enrollmentIds(): array
    {
        return $this->enrollmentIds;
    }

    /**
     * @return GradeId[]
     */
    public function gradeIds(): array
    {
        return $this->gradeIds;
    }

    /**
     * @return string|null
     */
    public function mobileNumber(): ?string
    {
        return $this->mobileNumber;
    }

    /**
     * @return string|null
     */
    public function landlineNumber(): ?string
    {
        return $this->landlineNumber;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function registrationDate(): \DateTimeImmutable
    {
        return $this->registeredAt;
    }

    /**
     * @return array
     */
    public function toPrimitives(): array
    {
        return [
            'id' => (string) $this->id(),
            'full_name' => $this->fullName(),
            'personal_email' => (string) $this->personalEmail(),
            'institutional_email' => (string) $this->institutionalEmail(),
            'national_identification_number' => $this->nationalIdentificationNumber(),
            'degree_ids' => array_map(
                fn(DegreeId $degreeId) => $degreeId->value(), $this->degreeIds()
            ),
            'enrollment_ids' => array_map(
                fn(EnrollmentId $enrollmentId) => $enrollmentId->value(), $this->enrollmentIds()
            ),
            'grade_ids' => array_map(
                fn(GradeId $gradeId) => $gradeId->value(), $this->gradeIds()
            ),
            'user_id' => (string) $this->userId(),
            'mobile_number' => $this->mobileNumber(),
            'landline_number' => $this->landlineNumber(),
            'registered_at' => $this->registrationDate()->format('Y-m-d H:i:s'),
        ];
    }
}
