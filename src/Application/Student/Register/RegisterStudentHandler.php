<?php

namespace ProfessorGradingApp\Application\Student\Register;

use ProfessorGradingApp\Domain\Common\Exceptions\{InvalidEmailFormat, InvalidEmailDomain, InvalidUuid};
use ProfessorGradingApp\Application\User\Register\CreateUserCommand;
use ProfessorGradingApp\Application\User\Register\CreateUserHandler;
use ProfessorGradingApp\Domain\Common\ValueObjects\InstitutionalEmail;
use ProfessorGradingApp\Domain\Common\ValueObjects\Student\StudentId;
use ProfessorGradingApp\Domain\Common\ValueObjects\User\UserId;
use ProfessorGradingApp\Domain\User\Exceptions\UserWithGivenEmailAlreadyRegistered;
use ProfessorGradingApp\Domain\User\ValueObjects\Role;
use ProfessorGradingApp\Domain\Student\Exceptions\{
    StudentInstitutionalEmailAlreadyRegistered,
    StudentNationalIdentificationNumberAlreadyRegistered};
use ProfessorGradingApp\Domain\Student\Repositories\StudentRepository;
use ProfessorGradingApp\Domain\Student\Student;
use ProfessorGradingApp\Domain\Student\ValueObjects\{NationalIdentificationNumber, PersonalEmail};

/**
 * Class RegisterStudentHandler
 *
 * @package ProfessorGradingApp\Application\Student\Register
 */
final class RegisterStudentHandler
{
    /**
     * @param StudentRepository $repository
     * @param CreateUserHandler $userCreator
     */
    public function __construct(
        private readonly StudentRepository $repository,
        private readonly CreateUserHandler $userCreator,
    ) {
    }

    /**
     * @param RegisterStudentCommand $command
     * @return Student
     * @throws InvalidEmailDomain
     * @throws InvalidEmailFormat
     * @throws InvalidUuid
     * @throws StudentInstitutionalEmailAlreadyRegistered
     * @throws StudentNationalIdentificationNumberAlreadyRegistered
     * @throws UserWithGivenEmailAlreadyRegistered
     */
    public function __invoke(RegisterStudentCommand $command): Student
    {
        $institutionalEmail = new InstitutionalEmail($command->institutionalEmail());

        $nationalIdentificationNumber = new NationalIdentificationNumber(
            $command->nationalIdentificationNumber()
        );

        $this->ensureInstitutionalEmailIsNotInUse($institutionalEmail);

        $this->ensureStudentNationalIdentificationNumberDoesNotExists($nationalIdentificationNumber);

        $createUserCommand = new CreateUserCommand(
            $command->institutionalEmail(),
            $command->nationalIdentificationNumber(),
            Role::STUDENT->value()
        );

        $User = $this->userCreator->__invoke($createUserCommand);

        $Student = Student::create(
            id: new StudentId(),
            fullName: $command->fullName(),
            personalEmail: new PersonalEmail($command->personalEmail()),
            institutionalEmail: $institutionalEmail,
            nationalIdentificationNumber: $nationalIdentificationNumber,
            userId: new UserId($User->id()),
            mobileNumber: $command->mobileNumber(),
            landlineNumber: $command->landlineNumber(),
        );

        $this->repository->save($Student);

        return $Student;
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
