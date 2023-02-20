<?php

namespace ProfessorGradingApp\Application\Student\Register;

use ProfessorGradingApp\Domain\Common\Exceptions\{InvalidEmailFormat, InvalidEmailDomain, InvalidUuid};
use ProfessorGradingApp\Domain\Common\ValueObjects\InstitutionalEmail;
use ProfessorGradingApp\Domain\Student\Exceptions\{
    StudentInstitutionalEmailAlreadyRegistered,
    StudentNationalIdentificationNumberAlreadyRegistered};
use ProfessorGradingApp\Domain\Student\Repositories\StudentRepository;
use ProfessorGradingApp\Domain\Student\Student;
use ProfessorGradingApp\Domain\Student\ValueObjects\{NationalIdentificationNumber, PersonalEmail, StudentId, UserId};

/**
 * Class RegisterStudentHandler
 *
 * @package ProfessorGradingApp\Application\Student\Register
 */
final class RegisterStudentHandler
{
    /**
     * @param StudentRepository $repository
     */
    public function __construct(private readonly StudentRepository $repository)
    {
    }

    /**
     * @param RegisterStudentCommand $command
     * @return void
     * @throws InvalidEmailDomain
     * @throws InvalidEmailFormat
     * @throws InvalidUuid
     * @throws StudentInstitutionalEmailAlreadyRegistered
     * @throws StudentNationalIdentificationNumberAlreadyRegistered
     */
    public function __invoke(RegisterStudentCommand $command): void
    {
        $this->ensureInstitutionalEmailIsNotInUse(
            new InstitutionalEmail($command->institutionalEmail())
        );

        $this->ensureStudentNationalIdentificationNumberDoesNotExists(
            new NationalIdentificationNumber($command->nationalIdentificationNumber())
        );

        $Student = Student::create(
            id: new StudentId(),
            fullName: $command->fullName(),
            personalEmail: new PersonalEmail($command->personalEmail()),
            institutionalEmail: new InstitutionalEmail($command->institutionalEmail()),
            nationalIdentificationNumber: new NationalIdentificationNumber($command->nationalIdentificationNumber()),
            userId: new UserId($command->userId()),
            mobileNumber: $command->mobileNumber(),
            landlineNumber: $command->landlineNumber(),
        );

        $this->repository->save($Student);
    }

    /**
     * @param InstitutionalEmail $institutionalEmail
     * @return void
     * @throws StudentInstitutionalEmailAlreadyRegistered
     */
    private function ensureInstitutionalEmailIsNotInUse(InstitutionalEmail $institutionalEmail): void
    {
        if($this->repository->findByInstitutionalEmail($institutionalEmail))
            throw new StudentInstitutionalEmailAlreadyRegistered($institutionalEmail);
    }

    /**
     * @param NationalIdentificationNumber $identificationNumber
     * @return void
     * @throws StudentNationalIdentificationNumberAlreadyRegistered
     */
    private function ensureStudentNationalIdentificationNumberDoesNotExists(
        NationalIdentificationNumber $identificationNumber
    ): void {
        if($this->repository->findByNationalIdentificationNumber($identificationNumber))
            throw new StudentNationalIdentificationNumberAlreadyRegistered($identificationNumber);
    }
}
