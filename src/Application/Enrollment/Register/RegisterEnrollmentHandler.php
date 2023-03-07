<?php

namespace ProfessorGradingApp\Application\Enrollment\Register;

use ProfessorGradingApp\Domain\AcademicPeriod\Exceptions\ActiveAcademicPeriodNotFound;
use ProfessorGradingApp\Domain\AcademicPeriod\Services\ActiveAcademicPeriodFinder;
use ProfessorGradingApp\Domain\Common\Exceptions\EmptyReportFilters;
use ProfessorGradingApp\Domain\Common\Exceptions\InvalidUuid;
use ProfessorGradingApp\Domain\Common\ValueObjects\AcademicPeriod\AcademicPeriodId;
use ProfessorGradingApp\Domain\Common\ValueObjects\CourseClass\ClassId;
use ProfessorGradingApp\Domain\Common\ValueObjects\Degree\DegreeId;
use ProfessorGradingApp\Domain\Common\ValueObjects\Enrollment\EnrollmentId;
use ProfessorGradingApp\Domain\Common\ValueObjects\Student\StudentId;
use ProfessorGradingApp\Domain\Enrollment\Enrollment;
use ProfessorGradingApp\Domain\Enrollment\Repositories\EnrollmentRepository;

/**
 * Class RegisterEnrollmentHandler
 *
 * @package ProfessorGradingApp\Application\Enrollment\Register
 */
final class RegisterEnrollmentHandler
{
    /**
     * @param EnrollmentRepository $repository
     * @param ActiveAcademicPeriodFinder $activeAcademicPeriodFinder
     */
    public function __construct(
        private readonly EnrollmentRepository $repository,
        private readonly ActiveAcademicPeriodFinder $activeAcademicPeriodFinder,
    ) {
    }

    /**
     * @param RegisterEnrollmentCommand $command
     * @return void
     * @throws InvalidUuid
     * @throws ActiveAcademicPeriodNotFound
     * @throws EmptyReportFilters
     */
    public function __invoke(RegisterEnrollmentCommand $command): void
    {
        $this->ensureEnrollmentDoesNotExist($command);

        $AcademicPeriod = ($this->activeAcademicPeriodFinder)();

        $classIds = array_map($this->classIdBuilder(), $command->classIds());

        $Enrollment = Enrollment::create(
            new EnrollmentId(),
            new StudentId($command->studentId()),
            $AcademicPeriod->id(),
            new DegreeId($command->degreeId()),
            $classIds,
        );

        $this->repository->save($Enrollment);
    }

    /**
     * @return \Closure
     */
    public function classIdBuilder(): \Closure
    {
        return fn(string $classId) => new ClassId($classId);
    }

    /**
     * @param RegisterEnrollmentCommand $command
     * @return void
     */
    private function ensureEnrollmentDoesNotExist(RegisterEnrollmentCommand $command): void
    {
        //TODO: ensure academic period is the current one

        //TODO: build criteria to search for an existing enrollment
    }
}
