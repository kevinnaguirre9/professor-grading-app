<?php

namespace ProfessorGradingApp\Application\Enrollment\RegisterClass;

use ProfessorGradingApp\Domain\Common\Exceptions\InvalidUuid;
use ProfessorGradingApp\Domain\Enrollment\Exceptions\ClassAlreadyRegisteredInEnrollment;
use ProfessorGradingApp\Domain\Enrollment\Exceptions\EnrollmentNotFound;
use ProfessorGradingApp\Domain\Enrollment\Repositories\EnrollmentRepository;
use ProfessorGradingApp\Domain\Enrollment\ValueObjects\{ClassId, EnrollmentId};

/**
 * Class RegisterClassToEnrollmentHandler
 *
 * @package ProfessorGradingApp\Application\Enrollment\RegisterClass
 */
final class RegisterClassToEnrollmentHandler
{
    public function __construct(private readonly EnrollmentRepository $repository)
    {
    }

    /**
     * @param RegisterClassToEnrollmentCommand $command
     * @return void
     * @throws InvalidUuid
     * @throws ClassAlreadyRegisteredInEnrollment
     * @throws EnrollmentNotFound
     */
    public function __invoke(RegisterClassToEnrollmentCommand $command): void
    {
        $enrollmentId = new EnrollmentId($command->enrollmentId());

        $Enrollment = $this->repository->find($enrollmentId);

        if(!$Enrollment)
            throw new EnrollmentNotFound($enrollmentId);

        $Enrollment->registerClass(new ClassId($command->classId()));

        $this->repository->save($Enrollment);
    }
}
