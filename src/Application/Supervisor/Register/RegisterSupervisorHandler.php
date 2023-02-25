<?php

namespace ProfessorGradingApp\Application\Supervisor\Register;

use ProfessorGradingApp\Domain\Common\Exceptions\{InvalidEmailDomain, InvalidEmailFormat, InvalidUuid};
use ProfessorGradingApp\Domain\Common\ValueObjects\InstitutionalEmail;
use ProfessorGradingApp\Domain\Common\ValueObjects\User\UserId;
use ProfessorGradingApp\Domain\Supervisor\Repositories\SupervisorRepository;
use ProfessorGradingApp\Domain\Supervisor\Supervisor;
use ProfessorGradingApp\Domain\Supervisor\ValueObjects\SupervisorId;

/**
 * Class RegisterSupervisorHandler
 *
 * @package ProfessorGradingApp\Application\Supervisor\Register
 */
final class RegisterSupervisorHandler
{
    /**
     * @param SupervisorRepository $repository
     */
    public function __construct(private readonly SupervisorRepository $repository)
    {
    }

    /**
     * @param RegisterSupervisorCommand $command
     * @return void
     * @throws InvalidEmailDomain
     * @throws InvalidEmailFormat
     * @throws InvalidUuid
     */
    public function __invoke(RegisterSupervisorCommand $command) : void
    {
        $this->ensureSupervisorDoesNotExist(new InstitutionalEmail($command->institutionalEmail()));

        $Supervisor = Supervisor::create(
            new SupervisorId(),
            $command->fullName(),
            new InstitutionalEmail($command->institutionalEmail()),
            new UserId($command->userId())
        );

        $this->repository->save($Supervisor);
    }

    /**
     * @param InstitutionalEmail $institutionalEmail
     * @return void
     */
    private function ensureSupervisorDoesNotExist(InstitutionalEmail $institutionalEmail) : void
    {
        $supervisor = $this->repository->findByInstitutionalEmail($institutionalEmail);

        if ($supervisor !== null)
            throw new  ($institutionalEmail);
    }
}
