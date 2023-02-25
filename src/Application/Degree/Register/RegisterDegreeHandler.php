<?php

namespace ProfessorGradingApp\Application\Degree\Register;

use ProfessorGradingApp\Domain\Common\ValueObjects\Degree\DegreeId;
use ProfessorGradingApp\Domain\Common\ValueObjects\Subject\SubjectId;
use ProfessorGradingApp\Domain\Degree\Degree;
use ProfessorGradingApp\Domain\Degree\Repositories\DegreeRepository;

/**
 * Class RegisterDegreeHandler
 *
 * @package ProfessorGradingApp\Application\Degree\Register
 */
final class RegisterDegreeHandler
{
    /**
     * @param DegreeRepository $repository
     */
    public function __construct(private readonly DegreeRepository $repository)
    {
    }

    /**
     * @param RegisterDegreeCommand $command
     * @return void
     */
    public function __invoke(RegisterDegreeCommand $command) : void
    {
        $subjectIds = array_map($this->subjectIdBuilder(), $command->subjectIds());

        $Degree = Degree::create(
            new DegreeId(),
            $command->name(),
            $subjectIds,
        );

        $this->repository->save($Degree);
    }

    /**
     * @return \Closure
     */
    private function subjectIdBuilder(): \Closure
    {
        return fn(string $subjectId) => new SubjectId($subjectId);
    }

}
