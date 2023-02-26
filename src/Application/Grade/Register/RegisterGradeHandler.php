<?php

namespace ProfessorGradingApp\Application\Grade\Register;

use ProfessorGradingApp\Domain\AcademicPeriod\Exceptions\ActiveAcademicPeriodNotFound;
use ProfessorGradingApp\Domain\AcademicPeriod\Services\ActiveAcademicPeriodFinder;
use ProfessorGradingApp\Domain\Common\Exceptions\EmptyReportFilters;
use ProfessorGradingApp\Domain\Common\Exceptions\InvalidUuid;
use ProfessorGradingApp\Domain\Common\ValueObjects\CourseClass\ClassId;
use ProfessorGradingApp\Domain\Common\ValueObjects\Grade\GradeId;
use ProfessorGradingApp\Domain\Common\ValueObjects\Student\StudentId;
use ProfessorGradingApp\Domain\CourseClass\Exceptions\ClassNotFound;
use ProfessorGradingApp\Domain\CourseClass\Exceptions\ClassNotInProgress;
use ProfessorGradingApp\Domain\CourseClass\Services\ClassFinder;
use ProfessorGradingApp\Domain\Grade\Exceptions\InvalidRating;
use ProfessorGradingApp\Domain\Grade\Grade;
use ProfessorGradingApp\Domain\Grade\Repositories\GradeRepository;
use ProfessorGradingApp\Domain\Grade\ValueObjects\Rating;

/**
 * Class RegisterGradeHandler
 *
 * @package ProfessorGradingApp\Application\Grade\Register
 */
final class RegisterGradeHandler
{
    /**
     * @param GradeRepository $repository
     * @param ActiveAcademicPeriodFinder $academicPeriodFinder
     * @param ClassFinder $classFinder
     */
    public function __construct(
        private readonly GradeRepository $repository,
        private readonly ActiveAcademicPeriodFinder $academicPeriodFinder,
        private readonly ClassFinder $classFinder,
    ) {
    }

    /**
     * @param RegisterGradeCommand $command
     * @return void
     * @throws ActiveAcademicPeriodNotFound
     * @throws ClassNotFound
     * @throws ClassNotInProgress
     * @throws EmptyReportFilters
     * @throws InvalidRating
     * @throws InvalidUuid
     */
    public function __invoke(RegisterGradeCommand $command): void
    {
        $AcademicPeriod = $this->academicPeriodFinder->__invoke();

//        $classId = new ClassId($command->classId());
//
//        $Class = ($this->classFinder)($classId);
//
//        if(! $Class->isInProgress())
//            throw new ClassNotInProgress($classId);

        $Grade = Grade::create(
            new GradeId(),
            $AcademicPeriod->id(),
//            $classId,
            new ClassId($command->classId()),
            new StudentId($command->studentId()),
            Rating::fromValue($command->rating()),
            $command->comment()
        );

        $this->repository->save($Grade);
    }
}
