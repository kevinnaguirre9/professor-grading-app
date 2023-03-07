<?php

namespace ProfessorGradingApp\Application\CourseClass\Register;

use ProfessorGradingApp\Domain\AcademicPeriod\Exceptions\ActiveAcademicPeriodNotFound;
use ProfessorGradingApp\Domain\AcademicPeriod\Services\ActiveAcademicPeriodFinder;
use ProfessorGradingApp\Domain\Common\Entities\Schedule;
use ProfessorGradingApp\Domain\Common\Exceptions\EmptyReportFilters;
use ProfessorGradingApp\Domain\Common\Exceptions\InvalidUuid;
use ProfessorGradingApp\Domain\Common\ValueObjects\AcademicPeriod\AcademicPeriodId;
use ProfessorGradingApp\Domain\Common\ValueObjects\CourseClass\ClassId;
use ProfessorGradingApp\Domain\Common\ValueObjects\Degree\DegreeId;
use ProfessorGradingApp\Domain\Common\ValueObjects\Professor\ProfessorId;
use ProfessorGradingApp\Domain\Common\ValueObjects\Subject\SubjectId;
use ProfessorGradingApp\Domain\CourseClass\CourseClass;
use ProfessorGradingApp\Domain\CourseClass\Repositories\ClassRepository;

/**
 * Class RegisterCourseClassHandler
 *
 * @package ProfessorGradingApp\Application\CourseClass\Register
 */
final class RegisterCourseClassHandler
{
    /**
     * @param ClassRepository $repository
     * @param ActiveAcademicPeriodFinder $activeAcademicPeriodFinder
     */
    public function __construct(
        private readonly ClassRepository $repository,
        private readonly ActiveAcademicPeriodFinder $activeAcademicPeriodFinder,
    ) {
    }

    /**
     * @param RegisterCourseClassCommand $command
     * @return void
     * @throws InvalidUuid
     * @throws ActiveAcademicPeriodNotFound
     * @throws EmptyReportFilters
     */
    public function __invoke(RegisterCourseClassCommand $command): void
    {
        //TODO: validate Class doesn't exist (Academic period, subject, professor, group section)

        $AcademicPeriod = ($this->activeAcademicPeriodFinder)();

        $degreesIds = array_map($this->degreeIdsBuilder(), $command->degreeIds());

        $Schedule = Schedule::fromPrimitives($command->dailySchedules());

        $CourseClass = CourseClass::create(
            new ClassId(),
            $command->groupSection(),
            $Schedule,
            $AcademicPeriod->id(),
            new SubjectId($command->subjectId()),
            new ProfessorId($command->professorId()),
            $degreesIds,
        );

        //TODO: dispatch event to update professor's assigned classes
        $this->repository->save($CourseClass);
    }


    /**
     * @return \Closure
     */
    private function degreeIdsBuilder(): \Closure
    {
        return fn (string $degreeId) => new DegreeId($degreeId);
    }
}
