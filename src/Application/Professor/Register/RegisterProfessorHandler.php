<?php

namespace ProfessorGradingApp\Application\Professor\Register;

use ProfessorGradingApp\Domain\Professor\Professor;
use ProfessorGradingApp\Domain\Professor\Repositories\ProfessorRepository;
use ProfessorGradingApp\Domain\Professor\ValueObjects\{ClassId, DegreeId, ProfessorId};

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
