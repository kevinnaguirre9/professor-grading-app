<?php

namespace ProfessorGradingApp\Application\Student\Register;

use ProfessorGradingApp\Domain\Common\Exceptions\{InvalidEmailFormat, InvalidEmailDomain, InvalidUuid};
use ProfessorGradingApp\Application\User\Register\CreateUserCommand;
use ProfessorGradingApp\Application\User\Register\CreateUserHandler;
use ProfessorGradingApp\Domain\Common\Events\EventBus;
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
     * @param EventBus $eventBus
     */
    public function __construct(
        private readonly StudentRepository $repository,
        private readonly EventBus $eventBus,
    ) {
    }

    /**
     * @param RegisterStudentCommand $command
     * @return Student
     * @throws InvalidEmailDomain
     * @throws InvalidEmailFormat
     * @throws InvalidUuid
     */
    public function __invoke(RegisterStudentCommand $command): Student
    {
        $institutionalEmail = new InstitutionalEmail($command->institutionalEmail());

        $nationalIdentificationNumber = new NationalIdentificationNumber(
            $command->nationalIdentificationNumber()
        );

        if($Student = $this->repository->findByInstitutionalEmail($institutionalEmail)) {

            $command->personalEmail() && $Student
                ->updatePersonalEmail(new PersonalEmail($command->personalEmail()));

            $command->mobileNumber() && $Student->updateMobileNumber($command->mobileNumber());

            $command->landlineNumber() && $Student->updateLandlineNumber($command->landlineNumber());

            $this->repository->save($Student);

            return $Student;
        }

        $Student = Student::create(
            id: new StudentId(),
            fullName: $command->fullName(),
            institutionalEmail: $institutionalEmail,
            nationalIdentificationNumber: $nationalIdentificationNumber,
            personalEmail: $command->personalEmail() ? new PersonalEmail($command->personalEmail()) : null,
            mobileNumber: $command->mobileNumber(),
            landlineNumber: $command->landlineNumber(),
        );

        $this->repository->save($Student);

        $this->eventBus->dispatch(...$Student->pullEvents());

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
