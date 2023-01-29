<?php

namespace ProfessorGradingApp\Domain\Supervisor\Repositories;

use ProfessorGradingApp\Domain\Common\ValueObjects\InstitutionalEmail;
use ProfessorGradingApp\Domain\Supervisor\Supervisor;
use ProfessorGradingApp\Domain\Supervisor\ValueObjects\SupervisorId;

/**
 * Interface SupervisorRepository
 *
 * @package ProfessorGradingApp\Domain\Supervisor\Repositories
 */
interface SupervisorRepository
{
    /**
     * @param Supervisor $Supervisor
     * @return void
     */
    public function save(Supervisor $Supervisor): void;

    /**
     * @param SupervisorId $id
     * @return Supervisor|null
     */
    public function find(SupervisorId $id): ?Supervisor;

    /**
     * @param InstitutionalEmail $institutionalEmail
     * @return Supervisor|null
     */
    public function findByInstitutionalEmail(InstitutionalEmail $institutionalEmail): ?Supervisor;
}
