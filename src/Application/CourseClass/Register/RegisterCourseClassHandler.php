<?php

namespace ProfessorGradingApp\Application\CourseClass\Register;

use ProfessorGradingApp\Domain\Common\Entities\Schedule;
use ProfessorGradingApp\Domain\Common\Exceptions\InvalidUuid;
use ProfessorGradingApp\Domain\CourseClass\CourseClass;
use ProfessorGradingApp\Domain\CourseClass\Repositories\CourseClassRepository;
use ProfessorGradingApp\Domain\CourseClass\ValueObjects\{AcademicPeriodId, ClassId, DegreeId, ProfessorId, SubjectId};

/**
 * Class RegisterCourseClassHandler
 *
 * @package ProfessorGradingApp\Application\CourseClass\Register
 */
final class RegisterCourseClassHandler
{
    /**
     * @param CourseClassRepository $repository
     */
    public function __construct(private readonly CourseClassRepository $repository)
    {
    }

    /**
     * @param RegisterCourseClassCommand $command
     * @return void
     * @throws InvalidUuid
     */
    public function __invoke(RegisterCourseClassCommand $command): void
    {
        //TODO: validate Class doesn't exist (Academic period, subject, professor, group section)

        $degreesIds = array_map($this->degreeIdsBuilder(), $command->degreeIds());

        $Schedule = Schedule::fromPrimitives($command->dailySchedules());

        $CourseClass = CourseClass::create(
            new ClassId(),
            $command->groupSection(),
            $Schedule,
            new AcademicPeriodId($command->academicPeriodId()),
            new SubjectId($command->subjectId()),
            new ProfessorId($command->professorId()),
            $degreesIds,
        );

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