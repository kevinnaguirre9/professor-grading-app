<?php

namespace ProfessorGradingApp\Application\Professor\Register;

use ProfessorGradingApp\Domain\Common\ValueObjects\CourseClass\ClassId;
use ProfessorGradingApp\Domain\Common\ValueObjects\Degree\DegreeId;
use ProfessorGradingApp\Domain\Common\ValueObjects\Professor\ProfessorId;
use ProfessorGradingApp\Domain\Professor\Professor;
use ProfessorGradingApp\Domain\Professor\Repositories\ProfessorRepository;

/**
 * Class RegisterProfessorHandler
 *
 * @package ProfessorGradingApp\Application\Professor\Register
 */
final class RegisterProfessorHandler
{
    /**
     * @param ProfessorRepository $professorRepository
     */
    public function __construct(private readonly ProfessorRepository $professorRepository)
    {
    }

    /**
     * @param RegisterProfessorCommand $command
     * @return void
     */
    public function __invoke(RegisterProfessorCommand $command): void
    {
        $classIds = array_map($this->classIdBuilder(), $command->classIds());

        $degreeIds = array_map($this->degreeIdBuilder(), $command->degreeIds());

        $Professor = Professor::create(
            new ProfessorId(),
            $command->fullName(),
            $classIds,
            $degreeIds
        );

        $this->professorRepository->save($Professor);
    }

    /**
     * @return \Closure
     */
    private function classIdBuilder(): \Closure
    {
        return fn (string $classId) => new ClassId($classId);
    }

    /**
     * @return \Closure
     */
    private function degreeIdBuilder(): \Closure
    {
        return fn (string $degreeId) => new DegreeId($degreeId);
    }
}
