<?php

namespace ProfessorGradingApp\Application\Enrollment\Register;

use ProfessorGradingApp\Domain\Common\Exceptions\InvalidUuid;
use ProfessorGradingApp\Domain\Enrollment\Enrollment;
use ProfessorGradingApp\Domain\Enrollment\Repositories\EnrollmentRepository;
use ProfessorGradingApp\Domain\Enrollment\ValueObjects\{
    AcademicPeriodId,
    ClassId,
    DegreeId,
    EnrollmentId,
    StudentId};

/**
 * Class RegisterEnrollmentHandler
 *
 * @package ProfessorGradingApp\Application\Enrollment\Register
 */
final class RegisterEnrollmentHandler
{
    /**
     * @param EnrollmentRepository $repository
     */
    public function __construct(private readonly EnrollmentRepository $repository)
    {
    }

    /**
     * @param RegisterEnrollmentCommand $command
     * @return void
     * @throws InvalidUuid
     */
    public function __invoke(RegisterEnrollmentCommand $command): void
    {
        $this->ensureEnrollmentDoesNotExist($command);

        $classIds = array_map($this->classIdBuilder(), $command->classIds());

        $Enrollment = Enrollment::create(
            new EnrollmentId(),
            new StudentId($command->studentId()),
            new AcademicPeriodId($command->academicPeriodId()),
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
