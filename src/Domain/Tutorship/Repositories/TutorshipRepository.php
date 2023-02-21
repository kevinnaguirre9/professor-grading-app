<?php

namespace ProfessorGradingApp\Domain\Tutorship\Repositories;

use ProfessorGradingApp\Domain\Tutorship\Tutorship;
use ProfessorGradingApp\Domain\Tutorship\ValueObjects\TutorshipId;

/**
 * Interface TutorshipRepository
 *
 * @package ProfessorGradingApp\Domain\Tutorship\Repositories
 */
interface TutorshipRepository
{
    /**
     * @param Tutorship $tutorship
     * @return void
     */
    public function save(Tutorship $tutorship): void;

    /**
     * @param TutorshipId $id
     * @return Tutorship|null
     */
    public function find(TutorshipId $id): ?Tutorship;

    /**
     * @return Tutorship[]
     */
    public function search(): array;
}