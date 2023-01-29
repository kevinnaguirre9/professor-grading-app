<?php

namespace ProfessorGradingApp\Application\Student\Register;

use ProfessorGradingApp\Domain\Common\Exceptions\InvalidEmail;
use ProfessorGradingApp\Domain\Common\ValueObjects\InstitutionalEmail;
use ProfessorGradingApp\Domain\Student\Repositories\StudentRepository;
use ProfessorGradingApp\Domain\Student\Student;
use ProfessorGradingApp\Domain\Student\ValueObjects\{
    NationalIdentificationNumber,
    PersonalEmail,
    StudentId};

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
    public function __construct(private StudentRepository $repository)
    {
    }

    /**
     * @param RegisterStudentCommand $command
     * @return void
     * @throws InvalidEmail
     */
    public function __invoke(RegisterStudentCommand $command): void
    {
        // TODO: check if student is already registered using institutional email

        $Student = Student::create(
            id: new StudentId(),
            fullName: $command->fullName(),
            personalEmail: new PersonalEmail($command->personalEmail()),
            institutionalEmail: new InstitutionalEmail($command->institutionalEmail()),
            nationalIdentificationNumber: new NationalIdentificationNumber($command->nationalIdentificationNumber()),
            mobileNumber: $command->mobileNumber(),
            landlineNumber: $command->landlineNumber(),
        );

        $this->repository->save($Student);
    }
}
