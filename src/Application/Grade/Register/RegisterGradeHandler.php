<?php

namespace ProfessorGradingApp\Application\Grade\Register;

use ProfessorGradingApp\Domain\Common\Exceptions\InvalidUuid;
use ProfessorGradingApp\Domain\Grade\Exceptions\InvalidRating;
use ProfessorGradingApp\Domain\Grade\Grade;
use ProfessorGradingApp\Domain\Grade\Repositories\GradeRepository;
use ProfessorGradingApp\Domain\Grade\ValueObjects\{AcademicPeriodId, ClassId, GradeId, Rating, StudentId};

/**
 * Class RegisterGradeHandler
 *
 * @package ProfessorGradingApp\Application\Grade\Register
 */
final class RegisterGradeHandler
{
    /**
     * @param GradeRepository $repository
     */
    public function __construct(private readonly GradeRepository $repository)
    {
    }

    /**
     * @param RegisterGradeCommand $command
     * @return void
     * @throws InvalidUuid
     * @throws InvalidRating
     */
    public function __invoke(RegisterGradeCommand $command) : void
    {
        //TODO: Domain service for validating class date and current date

        $Grade = Grade::create(
            new GradeId(),
            new AcademicPeriodId($command->academicPeriodId()),
            new ClassId($command->classId()),
            new StudentId($command->studentId()),
            Rating::fromValue($command->rating()),
            $command->comment()
        );

        $this->repository->save($Grade);
    }
}
