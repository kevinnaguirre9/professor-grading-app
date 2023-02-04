<?php

declare(strict_types=1);

namespace ProfessorGradingApp\Domain\Student;

use ProfessorGradingApp\Domain\Common\BaseEntity;
use ProfessorGradingApp\Domain\Common\ValueObjects\InstitutionalEmail;
use ProfessorGradingApp\Domain\Student\ValueObjects\{DegreeId,
    StudentId,
    EnrollmentId,
    GradeId,
    NationalIdentificationNumber,
    PersonalEmail,
    UserId};

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
     * @param PersonalEmail $personalEmail
     * @param InstitutionalEmail $institutionalEmail
     * @param NationalIdentificationNumber $nationalIdentificationNumber
     * @param UserId $userId
     * @param DegreeId[] $degreeIds
     * @param EnrollmentId[] $enrollmentIds
     * @param GradeId[] $gradeIds
     * @param \DateTimeImmutable $registeredAt
     * @param string|null $mobileNumber
     * @param string|null $landlineNumber
     */
    public function __construct(
        private readonly StudentId $id,
        private string $fullName,
        private PersonalEmail $personalEmail,
        private readonly InstitutionalEmail $institutionalEmail,
        private NationalIdentificationNumber $nationalIdentificationNumber,
        private readonly UserId $userId,
        private array $degreeIds,
        private array $enrollmentIds,
        private array $gradeIds,
        private readonly \DateTimeImmutable $registeredAt,
        private ?string $mobileNumber,
        private ?string $landlineNumber,
    ) {
    }

    /**
     * @param StudentId $id
     * @param string $fullName
     * @param PersonalEmail $personalEmail
     * @param InstitutionalEmail $institutionalEmail
     * @param NationalIdentificationNumber $nationalIdentificationNumber
     * @param UserId $userId
     * @param DegreeId[] $degreeIds
     * @param EnrollmentId[] $enrollmentIds
     * @param GradeId[] $gradeIds
     * @param \DateTimeImmutable $registeredAt
     * @param string|null $mobileNumber
     * @param string|null $landlineNumber
     * @return self
     */
    public static function create(
        StudentId $id,
        string $fullName,
        PersonalEmail $personalEmail,
        InstitutionalEmail $institutionalEmail,
        NationalIdentificationNumber $nationalIdentificationNumber,
        UserId $userId,
        array $degreeIds = [],
        array $enrollmentIds = [],
        array $gradeIds = [],
        \DateTimeImmutable $registeredAt = new \DateTimeImmutable(),
        ?string $mobileNumber = null,
        ?string $landlineNumber = null,
    ): self {
        return new self(
            $id,
            $fullName,
            $personalEmail,
            $institutionalEmail,
            $nationalIdentificationNumber,
            $userId,
            $degreeIds,
            $enrollmentIds,
            $gradeIds,
            $registeredAt,
            $mobileNumber,
            $landlineNumber,
        );
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
    public function institutionEmail(): InstitutionalEmail
    {
        return $this->institutionalEmail;
    }

    /**
     * @return PersonalEmail
     */
    public function personalEmail(): PersonalEmail
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
     * @return UserId
     */
    public function userId(): UserId
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
}
