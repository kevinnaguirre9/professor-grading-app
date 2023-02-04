<?php

namespace ProfessorGradingApp\Application\Professor\Register;

use ProfessorGradingApp\Domain\Professor\Professor;
use ProfessorGradingApp\Domain\Professor\Repositories\ProfessorRepository;
use ProfessorGradingApp\Domain\Professor\ValueObjects\ProfessorId;

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
        $Professor = Professor::create(
            new ProfessorId(),
            $command->fullName(),
            $command->classIds(),
            $command->degreeIds()
        );

        $this->professorRepository->save($Professor);
    }
}
