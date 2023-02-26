<?php

namespace ProfessorGradingApp\Application\ClassInspectionRequest\Register;

use ProfessorGradingApp\Domain\AcademicPeriod\Exceptions\ActiveAcademicPeriodNotFound;
use ProfessorGradingApp\Domain\AcademicPeriod\Services\ActiveAcademicPeriodFinder;
use ProfessorGradingApp\Domain\ClassInspectionRequest\ClassInspectionRequest;
use ProfessorGradingApp\Domain\ClassInspectionRequest\Repositories\ClassInspectionRequestRepository;
use ProfessorGradingApp\Domain\ClassInspectionRequest\ValueObjects\ClassInspectionRequestId;
use ProfessorGradingApp\Domain\Common\Exceptions\EmptyReportFilters;
use ProfessorGradingApp\Domain\Common\Exceptions\InvalidUuid;
use ProfessorGradingApp\Domain\Common\ValueObjects\CourseClass\ClassId;
use ProfessorGradingApp\Domain\Common\ValueObjects\Student\StudentId;

/**
 * Class RegisterClassInspectionRequestHandler
 *
 * @package ProfessorGradingApp\Application\ClassInspectionRequest\Register
 */
final class RegisterClassInspectionRequestHandler
{
    /**
     * @param ClassInspectionRequestRepository $repository
     * @param ActiveAcademicPeriodFinder $activeAcademicPeriodFinder
     */
    public function __construct(
        private readonly ClassInspectionRequestRepository $repository,
        private readonly ActiveAcademicPeriodFinder $activeAcademicPeriodFinder,
    ) {
    }

    /**
     * @param RegisterClassInspectionRequestCommand $command
     * @return void
     * @throws ActiveAcademicPeriodNotFound
     * @throws EmptyReportFilters
     * @throws InvalidUuid
     */
    public function __invoke(RegisterClassInspectionRequestCommand $command): void
    {
        //TODO: validate student is enrolled in class

        //TODO: validate students has not more than two class inspection requests with inspected status for the class

        $AcademicPeriod = $this->activeAcademicPeriodFinder->__invoke();

        $ClassInspectionRequest = ClassInspectionRequest::create(
            new ClassInspectionRequestId(),
            $command->reason(),
            $command->description(),
            $AcademicPeriod->id(),
            new ClassId($command->classId()),
            new StudentId($command->studentId()),
        );

        $this->repository->save($ClassInspectionRequest);
    }
}
