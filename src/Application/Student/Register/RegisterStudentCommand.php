<?php

namespace ProfessorGradingApp\Application\Student\Register;

use ProfessorGradingApp\Domain\Common\Contracts\Bus\Command\Command;

/**
 * Class RegisterStudentCommand
 *
 * @package ProfessorGradingApp\Application\Student\Register
 */
final class RegisterStudentCommand implements Command
{
    /**
     * @param string $fullName
     * @param string|null $personalEmail
     * @param string $institutionalEmail
     * @param string $nationalIdentificationNumber
     * @param array $degreeIds
     * @param array $enrollmentIds
     * @param array $gradeIds
     * @param string|null $mobileNumber
     * @param string|null $landlineNumber
     */
    public function __construct(
        private string $fullName,
        private string $institutionalEmail,
        private string $nationalIdentificationNumber,
        private ?string $personalEmail = null,
        private array $degreeIds = [],
        private array $enrollmentIds = [],
        private array $gradeIds = [],
        private ?string $mobileNumber = null,
        private ?string $landlineNumber = null,
    ) {
    }

    /**
     * @return string
     */
    public function fullName(): string
    {
        return $this->fullName;
    }

    /**
     * @return string|null
     */
    public function personalEmail(): ?string
    {
        return $this->personalEmail;
    }

    /**
     * @return string
     */
    public function institutionalEmail(): string
    {
        return $this->institutionalEmail;
    }

    /**
     * @return string
     */
    public function nationalIdentificationNumber(): string
    {
        return $this->nationalIdentificationNumber;
    }

    /**
     * @return array
     */
    public function degreeIds(): array
    {
        return $this->degreeIds;
    }

    /**
     * @return array
     */
    public function enrollmentIds(): array
    {
        return $this->enrollmentIds;
    }

    /**
     * @return array
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
}
